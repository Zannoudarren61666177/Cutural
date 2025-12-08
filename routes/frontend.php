<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PaymentController;

// -------------------- Visiteurs (non connectés) --------------------
Route::view('/apropos', 'frontend.apropos')->name('apropos');
Route::view('/contact', 'frontend.contact')->name('contact');

// -------------------- Utilisateurs connectés --------------------
Route::middleware(['auth'])->group(function () {

    // Dashboard (à la racine)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profil utilisateur
    Route::view('/mon-profil', 'frontend.mon-profil')->name('profil');

    // Demande devenir contributeur
    Route::post('/devenir-contributeur', [FrontendController::class, 'devenirContributeur'])
        ->name('devenir-contributeur');

    // Contenus
    Route::get('/contenus', [FrontendController::class, 'contenus'])
        ->name('contenus.index');
    Route::get('/contenus/{contenu}', [FrontendController::class, 'contenusShow'])
        ->name('contenus.show');

    // Médias
    Route::get('/medias', [FrontendController::class, 'medias'])
        ->name('medias.index');
    Route::get('/medias/{media}', [FrontendController::class, 'mediasShow'])
        ->name('medias.show');

    // Régions
    Route::get('/regions', [FrontendController::class, 'regions'])
        ->name('regions.index');
    Route::get('/regions/{region}', [FrontendController::class, 'regionsShow'])
        ->name('regions.show');

    // Langues
    Route::get('/langues', [FrontendController::class, 'langues'])
        ->name('langues.index');
    Route::get('/langues/{langue}', [FrontendController::class, 'languesShow'])
        ->name('langues.show');

    // Événements
    Route::get('/evenements', [FrontendController::class, 'evenements'])
        ->name('evenements.index');
    Route::get('/evenements/{evenement}', [FrontendController::class, 'evenementsShow'])
        ->name('evenements.show');
});

// -------------------- Contributeurs (accès spécial) --------------------
Route::middleware(['auth', 'role:contributeur'])->group(function () {

    // Tableau de bord contributeur
    Route::get('/contributeurs', [FrontendController::class, 'contributeursIndex'])
        ->name('contributeurs.index');

    // Ajouter du contenu
    Route::get('/contributeurs/ajouter', [FrontendController::class, 'contributeursAjouter'])
        ->name('contributeurs.ajouter');

    // Soumission du contenu
    Route::post('/contributeurs/ajouter', [FrontendController::class, 'contributeursStore'])
        ->name('contributeurs.store');

    // ⚠️ Voir une contribution spécifique
    // Doit être placé **en dernier** pour éviter de capturer 'ajouter' comme {contenu}
    Route::get('/contributeurs/{contenu}', [FrontendController::class, 'contributeursShow'])
        ->name('contributeurs.show');
});




// -------------------- Paiement FedaPay --------------------
Route::middleware(['auth'])->group(function () {
    // Afficher le formulaire de paiement pour un contenu premium
    Route::get('/contenus/{contenu}/pay', [PaymentController::class, 'showPaymentForm'])
        ->name('payments.form');

    // Traiter le paiement et rediriger vers FedaPay
    Route::post('/contenus/{contenu}/pay', [PaymentController::class, 'processPayment'])
        ->name('payments.process');

    // Callback après paiement (FedaPay redirige ici)
    Route::get('/payments/callback/{commande}', [PaymentController::class, 'handleCallback'])
        ->name('payments.callback');
});

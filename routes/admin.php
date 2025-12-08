<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguesController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\TypeContenuController;
use App\Http\Controllers\TypeMediaController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

// --- Toutes les routes Admin seront préfixées par /admin ---
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Users
        Route::resource('users', UserController::class);

        // Langues
        Route::resource('langues', LanguesController::class);

        // Régions
        Route::resource('regions', RegionController::class);

        // Types de contenus
        Route::resource('type_contenus', TypeContenuController::class);

        // Types de médias
        Route::resource('type_medias', TypeMediaController::class);

        // Contenus
        Route::resource('contenus', ContenuController::class);

        // Médias
        Route::resource('medias', MediaController::class);

        // Roles
        Route::resource('roles', RoleController::class);

        // Commentaires
        Route::post('contenus/{contenu}/commentaires', [CommentaireController::class, 'store'])
            ->name('commentaires.store');

        Route::delete('commentaires/{commentaire}', [CommentaireController::class, 'destroy'])
            ->name('commentaires.destroy');
});

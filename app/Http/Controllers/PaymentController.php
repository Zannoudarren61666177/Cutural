<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contenu;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;
use FedaPay\FedaPay;
use FedaPay\Transaction;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Initialisation FedaPay
        // Remplace par tes clés réelles !
        FedaPay::setApiKey(env('FEDAPAY_SECRET_KEY'));
        FedaPay::setEnvironment(env('FEDAPAY_ENV', 'sandbox')); 
    }

    /**
     * Affiche la page de paiement
     */
    public function showPaymentForm(Contenu $contenu)
    {
        if (!$contenu->is_premium) {
            return redirect()
                ->route('contenus.show', $contenu->id_contenu)
                ->with('success', 'Ce contenu est gratuit.');
        }

        return view('payments.checkout', compact('contenu'));
    }

    /**
     * Création de la commande + transaction
     */
    public function processPayment(Request $request, Contenu $contenu)
    {
        $user = Auth::user();

        // Création de la commande locale
        $commande = Commande::create([
            'user_id' => $user->id_user,
            'contenu_id' => $contenu->id_contenu,
            'montant' => $contenu->prix,
            'statut' => 'en_attente',
        ]);

        try {
            // Création de la transaction FedaPay
            $transaction = Transaction::create([
                'description' => "Paiement du contenu : {$contenu->titre}",
                'amount' => $contenu->prix,
                'currency' => ['iso' => 'XOF'],   // OBLIGATOIRE
                'callback_url' => route('payments.callback', $commande->id),
            ]);

            // Sauvegarde de l'ID transaction
            $commande->update([
                'fedapay_token' => $transaction->id,
            ]);

            // URL de redirection vers la caisse FedaPay
            $checkoutUrl = $transaction->generateCheckoutUrl();

            return redirect($checkoutUrl);

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erreur de paiement : ' . $e->getMessage());
        }
    }

    /**
     * Callback FedaPay après paiement
     */
    public function handleCallback($commandeId)
    {
        $commande = Commande::findOrFail($commandeId);

        try {
            // Récupération de la transaction FedaPay
            $transaction = Transaction::retrieve($commande->fedapay_token);

            if ($transaction->status === 'approved') {
                $commande->update(['statut' => 'payé']);

                return redirect()
                    ->route('contenus.show', $commande->contenu_id)
                    ->with('success', 'Paiement réussi ! Vous pouvez lire le contenu complet.');
            }

            // Paiement échoué
            $commande->update(['statut' => 'échoué']);

            return redirect()
                ->route('contenus.show', $commande->contenu_id)
                ->with('error', 'Le paiement a échoué. Veuillez réessayer.');

        } catch (\Exception $e) {
            return redirect()
                ->route('contenus.show', $commande->contenu_id)
                ->with('error', 'Erreur callback : ' . $e->getMessage());
        }
    }
}

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
        // Configuration FedaPay
        FedaPay::setApiKey(env('FEDAPAY_SECRET_KEY'));
        FedaPay::setEnvironment(env('FEDAPAY_ENV', 'sandbox')); // sandbox ou live
    }

    /**
     * Page de choix du paiement
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
     * Création commande + transaction FedaPay
     */
    public function processPayment(Request $request, Contenu $contenu)
    {
        $user = Auth::user();

        // Création commande en base
        $commande = Commande::create([
            'user_id'       => $user->id_user,
            'contenu_id'    => $contenu->id_contenu,
            'montant'       => $contenu->prix,
            'statut'        => 'en_attente',
        ]);

        try {
            // Transaction FedaPay
            $transaction = Transaction::create([
                'description'   => "Paiement du contenu : {$contenu->titre}",
                'amount'        => $contenu->prix,
                'currency'      => ['iso' => 'XOF'],
                'callback_url'  => route('payments.callback', $commande->id),
                'success_url'   => route('contenus.show', $contenu->id_contenu),
                'cancel_url'    => url()->previous(),
            ]);

            // Sauvegarder l’id transaction FedaPay
            $commande->update([
                'fedapay_token' => $transaction->id
            ]);

            // Checkout URL (nouveau SDK)
            $checkout = $transaction->checkout();

            return redirect()->away($checkout->url);

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erreur de paiement : '.$e->getMessage());
        }
    }

    /**
     * Retour FedaPay → callback
     */
    public function handleCallback($commandeId)
    {
        $commande = Commande::findOrFail($commandeId);

        try {
            // Récupérer la transaction réelle
            $transaction = Transaction::retrieve($commande->fedapay_token);

            if ($transaction->status === 'approved') {
                $commande->update(['statut' => 'payé']);

                return redirect()
                    ->route('contenus.show', $commande->contenu_id)
                    ->with('success', 'Paiement réussi ! Vous pouvez accéder au contenu.');
            }

            // Si refusé
            $commande->update(['statut' => 'échoué']);

            return redirect()
                ->route('contenus.show', $commande->contenu_id)
                ->with('error', 'Le paiement a échoué.');
        } 
        catch (\Exception $e) {
            return redirect()
                ->route('contenus.show', $commande->contenu_id)
                ->with('error', 'Callback error: '.$e->getMessage());
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Contenu;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';

    // Champs autorisés à la création massive
    protected $fillable = [
        'user_id',
        'contenu_id',
        'montant',
        'statut',
        'transaction_id',
        'fedapay_token',
    ];

    /**
     * Un utilisateur qui a passé la commande
     */
    public function user()
    {
        // Ici id_user si ton utilisateur utilise id_user comme clé primaire
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    /**
     * Le contenu acheté dans cette commande
     */
    public function contenu()
    {
        // Ici id_contenu si ton contenu utilise id_contenu comme clé primaire
        return $this->belongsTo(Contenu::class, 'contenu_id', 'id_contenu');
    }
}

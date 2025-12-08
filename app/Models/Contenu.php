<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenu extends Model
{
    use HasFactory;

    protected $table = 'contenus';
    protected $primaryKey = 'id_contenu';

    protected $fillable = [
        'titre',
        'texte',
        'statut',
        'parent_id',
        'id_region',
        'id_langue',
        'id_type_contenu',
        'id_auteur',
        'id_moderateur',
        'date_validation',
        'is_premium',  // indique si le contenu est premium
        'prix',        // prix du contenu
        'image',       // si tu stockes une image principale
    ];

    // Relations vers les utilisateurs
    public function auteur() {
        return $this->belongsTo(User::class, 'id_auteur', 'id_user'); 
    }

    public function moderateur() {
        return $this->belongsTo(User::class, 'id_moderateur', 'id_user'); 
    }

    // Relations vers autres tables
    public function region() {
        return $this->belongsTo(Region::class, 'id_region'); 
    }

    public function langue() {
        return $this->belongsTo(Langues::class, 'id_langue'); 
    }

    public function typeContenu() {
        return $this->belongsTo(TypeContenu::class, 'id_type_contenu'); 
    }

    // Relations vers médias et commentaires
    public function medias() {
        return $this->hasMany(Media::class, 'id_contenu');
    }

    public function commentaires() {
        return $this->hasMany(Commentaire::class, 'id_contenu');
    }

    // Relations parent/enfants (traductions)
    public function parent() {
        return $this->belongsTo(Contenu::class, 'parent_id');
    }

    public function traductions() {
        return $this->hasMany(Contenu::class, 'parent_id');
    }

    // Relation avec les commandes/payements
    public function commandes() {
        return $this->hasMany(Commande::class, 'contenu_id', 'id_contenu');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $table = 'commentaires';
    protected $primaryKey = 'id_commentaire';
    protected $fillable = ['texte', 'note', 'id_utilisateur', 'id_contenu'];

    // Relation vers l'utilisateur
    public function user() {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    // Relation vers le contenu associé
    public function contenu() {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }
}

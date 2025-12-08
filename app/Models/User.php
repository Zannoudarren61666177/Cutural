<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nom',
        'email',
        'password',
        'role',        // admin | moderateur | auteur | contributeur
        'langue_id',   // clé étrangère vers langues
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Hash automatique du mot de passe
     */
    public function setPasswordAttribute($value)
    {
        if (empty($value)) {
            return; // aucun mot de passe fourni
        }

        // Si le mot de passe n'est pas encore hashé
        if (!password_get_info($value)['algo']) {
            $this->attributes['password'] = Hash::make($value);
        } else {
            $this->attributes['password'] = $value;
        }
    }

    /**
     * Relation avec la langue
     */
    public function langue()
    {
        return $this->belongsTo(Langues::class, 'langue_id', 'id_langue');
    }

    /**
     * Vérifier un rôle
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Vérifier plusieurs rôles
     */
    public function hasAnyRole($roles)
    {
        return in_array($this->role, $roles);
    }

    /**
     * Contenus créés par l'utilisateur
     */
    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_auteur', 'id_user');
    }

    /**
     * Commandes effectuées par l'utilisateur
     */
    public function commandes()
    {
        return $this->hasMany(Commande::class, 'user_id', 'id_user');
    }
}

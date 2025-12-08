<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Langues extends Model
{
    use HasFactory;

    protected $table = 'langues';
    protected $primaryKey = 'id_langue';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'libelle',
        'code_langue',
        'description'
    ];

    // Relation avec utilisateurs
    public function users()
    {
        return $this->hasMany(User::class, 'langue_id', 'id_langue');
    }

    // Relation pivot avec régions : table parler
    public function regions()
    {
        return $this->belongsToMany(
            Region::class,
            'parler',
            'id_langue',   // clé langue dans pivot
            'id_region'    // clé région dans pivot
        );
    }
}

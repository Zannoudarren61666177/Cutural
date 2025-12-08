<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_region';

    protected $fillable = [
        'nom_region',
        'population',
        'superficie',
        'localisation'
    ];

    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'region_id', 'id_region');
    }

    public function langues()
    {
        return $this->belongsToMany(
            Langues::class,
            'parler',
            'id_region',
            'id_langue'
        );
    }
}

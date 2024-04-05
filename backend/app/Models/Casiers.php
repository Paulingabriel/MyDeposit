<?php

namespace App\Models;

use App\Models\Bouteilles;
use App\Models\Fournisseurs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Casiers extends Model
{
    use HasFactory;

    protected $fillable = [
        'capacite',
        'bouteille_id',
        'prix_achat',
        'intitule',
        'fournisseur_id',
    ];



    public function fournisseur(): BelongsTo
    {
        return $this->belongsTo(Fournisseurs::class);
    }



    public function bouteille(): BelongsTo
    {
        return $this->belongsTo(Bouteilles::class);
    }
}

<?php

namespace App\Models;

use App\Models\CategoriesBoissons;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Boissons extends Model
{
    use HasFactory;

    protected $fillable = [

        'fournisseur_id',
        'bouteille_id',
        'categories_boisson_id',
        'image',
        'nom',
        'prix'
    ];


    public function fournisseur(): BelongsTo
    {
        return $this->belongsTo(Fournisseurs::class);
    }

    public function bouteille(): BelongsTo
    {
        return $this->belongsTo(Bouteilles::class);
    }

    public function categories_boisson(): BelongsTo
    {
        return $this->belongsTo(CategoriesBoissons::class);
    }

}

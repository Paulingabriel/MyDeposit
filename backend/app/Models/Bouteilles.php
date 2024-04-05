<?php

namespace App\Models;

use App\Models\Casiers;
use App\Models\Boissons;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bouteilles extends Model
{
    use HasFactory;

    protected $fillable = [
        'volume',
        'prix'
    ];


    public function casiers(): HasMany
    {
        return $this->hasMany(Casiers::class, 'bouteille_id', 'id');
    }

    public function boissons(): HasMany
    {
        return $this->hasMany(Boissons::class, 'bouteille_id', 'id');
    }

}

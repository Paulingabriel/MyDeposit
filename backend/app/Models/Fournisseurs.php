<?php

namespace App\Models;

use App\Models\Casiers;
use App\Models\Boissons;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fournisseurs extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        'adresse',
        'telephone1',
        'telephone2'
    ];

    public function casiers(): BelongsTo
    {
        return $this->belongsTo(Casiers::class, 'fournisseur_id', 'id');
    }

    public function boissons(): HasMany
    {
        return $this->hasMany(Boissons::class, 'fournisseur_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriesBoissons extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function boissons(): HasMany
    {
        return $this->hasMany(Boissons::class, 'categories_boisson_id', 'id');
    }
}

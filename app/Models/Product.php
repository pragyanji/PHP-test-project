<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
    ];

    /**
     * Get the sales logged for this product.
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'quantity',
        'price_at_sale',
        'total_price',
    ];

    /**
     * Get the product that was sold.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

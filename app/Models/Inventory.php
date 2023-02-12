<?php

namespace App\Models;

use Database\Factories\InventoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', //only allowing this to be fillable for the csv import
        'product_id',
        'quantity',
        'color',
        'size',
        'weight',
        'price_cents',
        'sale_price_cents',
        'cost_cents',
        'sku',
        'length',
        'width',
        'height',
        'note',
    ];

    /**
     * The product that this inventory belongs to.
     *
     * @return BelongsTo<Product>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Return the factory for the model.
     *
     * @return InventoryFactory
     */
    protected static function newFactory()
    {
        return InventoryFactory::new();
    }
}

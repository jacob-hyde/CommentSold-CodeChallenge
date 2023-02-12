<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', //only allowing this to be fillable for the csv import
        'product_name',
        'description',
        'style',
        'brand',
        'url',
        'product_type',
        'shipping_price',
        'note',
        'admin_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'url',
        'admin_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The admin that owns the product relationship.
     *
     * @return BelongsTo<User>
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The inventory that owns the product relationship.
     *
     * @return BelongsTo<Inventory>
     */
    public function inventory(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    protected function shippingPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => convertCentsToDollars($value),
        );
    }

    /**
     * The "booted" method of the model.
     * We could use an Observer or Model Events here, but for time sake I'm using the booted method.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function (Product $product) {
            $product->admin_id = auth()->id();
        });

        static::created(function (Product $product) {
            $product->url = route('products.show', $product->id);
            $product->save();
        });
    }

    /**
     * Return the factory for the model.
     *
     * @return UserFactory
     */
    protected static function newFactory()
    {
        return ProductFactory::new();
    }
}

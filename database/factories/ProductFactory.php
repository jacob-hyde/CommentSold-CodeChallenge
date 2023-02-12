<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $product->url = '/products/' . $product->id;
            $product->save();
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->name,
            'description' => $this->faker->text,
            'style' => $this->faker->text,
            'brand' => $this->faker->text,
            'product_type' => $this->faker->text,
            'shipping_price' => $this->faker->numberBetween(0, 100000),
            'note' => $this->faker->text,
            'admin_id' => null
        ];
    }
}

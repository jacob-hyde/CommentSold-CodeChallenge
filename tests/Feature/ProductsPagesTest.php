<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutEvents;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ProductsPageTest extends TestCase
{
    use RefreshDatabase, WithoutEvents;

    /**
     * Test the products index page.
     *
     * @return void
     */
    public function test_products_index_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard/products');

        $response->assertStatus(200);

        Product::factory(10)->create([
            'admin_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get('/dashboard/products');

        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert->component('Products/Index'));
    }

    /**
     * Test the products create page.
     *
     * @return void
     */
    public function test_product_show_page(): void
    {
        $user = User::factory()->create();

        $product = Product::factory()->create([
            'admin_id' => $user->id,
        ]);

        $this
            ->actingAs($user)
            ->get('/dashboard/products/' . $product->id)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Products/Form')
                ->has('product')
        );
    }
}

<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Carbon;

class ExampleTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test the model creates.
     *
     * @return void
     */
    public function test_user_model_creates(): void
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * Test the model updates.
     *
     * @return void
     */
    public function test_user_model_updates(): void
    {
        $user = User::factory()->create();
        $user->update(['name' => 'Test']);
        $this->assertEquals('Test', $user->name);
    }

    /**
     * Test the model deletes.
     *
     * @return void
     */
    public function test_user_model_deletes(): void
    {
        $user = User::factory()->create();
        $user->delete();
        $this->assertNotNull($user->deleted_at);
    }

    /**
     * Test the model casts.
     *
     * @return void
     */
    public function test_user_model_casts(): void
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(Carbon::class, $user->email_verified_at);
        $this->assertInstanceOf(Carbon::class, $user->trial_starts_at);
        $this->assertInstanceOf(Carbon::class, $user->trial_ends_at);
    }
}

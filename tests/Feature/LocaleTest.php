<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_locale_switching_works_for_authenticated_user(): void
    {
        $user = User::factory()->create(['locale' => 'en']);

        $response = $this->actingAs($user)
            ->postJson('/locale/switch', ['locale' => 'ar']);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'locale' => 'ar',
                'direction' => 'rtl'
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'locale' => 'ar'
        ]);
    }

    public function test_locale_switching_works_for_guest_user(): void
    {
        $response = $this->postJson('/locale/switch', ['locale' => 'ar']);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'locale' => 'ar',
                'direction' => 'rtl'
            ]);
    }

    public function test_invalid_locale_returns_error(): void
    {
        $response = $this->postJson('/locale/switch', ['locale' => 'invalid']);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['locale']);
    }

    public function test_locale_detection_from_url(): void
    {
        $response = $this->get('/ar/dashboard');

        $response->assertStatus(302); // Redirect to login
    }

    public function test_locale_detection_from_user_preference(): void
    {
        $user = User::factory()->create(['locale' => 'ar']);

        $response = $this->actingAs($user)
            ->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_locale_api_endpoints(): void
    {
        $response = $this->getJson('/locale/current');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'current',
                'supported',
                'direction'
            ]);

        $response = $this->getJson('/locale/supported');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'locales',
                'default'
            ]);
    }
}
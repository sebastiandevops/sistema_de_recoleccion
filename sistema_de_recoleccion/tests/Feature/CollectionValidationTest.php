<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CollectionValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_frequency_is_required()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->from(route('collections.create'))
            ->post(route('collections.store'), [
                'type' => 'organic',
                'mode' => 'programada',
                // 'frequency' omitted
                'scheduled_at' => now()->addDay()->format('Y-m-d\TH:i'),
                'notes' => 'Prueba',
            ]);

        $response->assertRedirect(route('collections.create'));
        $response->assertSessionHasErrors('frequency');
    }

    public function test_scheduled_at_is_required()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->from(route('collections.create'))
            ->post(route('collections.store'), [
                'type' => 'organic',
                'mode' => 'programada',
                'frequency' => 2,
                // 'scheduled_at' omitted
                'notes' => 'Prueba',
            ]);

        $response->assertRedirect(route('collections.create'));
        $response->assertSessionHasErrors('scheduled_at');
    }

    public function test_both_frequency_and_scheduled_at_are_required()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->from(route('collections.create'))
            ->post(route('collections.store'), [
                'type' => 'organic',
                'mode' => 'programada',
                // both omitted
                'notes' => 'Prueba',
            ]);

        $response->assertRedirect(route('collections.create'));
        $response->assertSessionHasErrors(['frequency', 'scheduled_at']);
    }
}

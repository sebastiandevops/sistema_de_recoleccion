<?php

namespace Tests\Feature;

use App\Models\Collection;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CancelCollectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_cancel_scheduled_collection()
    {
        $user = User::factory()->create();
        $collection = Collection::factory()->create([
            'user_id' => $user->id,
            'status' => 'scheduled',
        ]);

        $response = $this->actingAs($user)->patch(route('collections.cancel', $collection));

        $response->assertRedirect(route('collections.index'));
        $this->assertSame('cancelled', $collection->fresh()->status);
    }

    public function test_non_owner_cannot_cancel_collection()
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $collection = Collection::factory()->create([
            'user_id' => $other->id,
            'status' => 'scheduled',
        ]);

        $response = $this->actingAs($user)->patch(route('collections.cancel', $collection));

        $response->assertStatus(403);
        $this->assertSame('scheduled', $collection->fresh()->status);
    }

    public function test_cannot_cancel_non_scheduled_collection()
    {
        $user = User::factory()->create();
        $collection = Collection::factory()->create([
            'user_id' => $user->id,
            'status' => 'completed',
        ]);

        $response = $this->actingAs($user)->patch(route('collections.cancel', $collection));

        $response->assertRedirect(route('collections.index'));
        $response->assertSessionHas('error');
        $this->assertSame('completed', $collection->fresh()->status);
    }
}

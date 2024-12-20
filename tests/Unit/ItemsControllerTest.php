<?php

namespace Tests\Unit;

use App\Models\Item;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ItemsControllerTest extends TestCase
{
    public function testListItems()
    {
        $user = User::factory()->create();

        $user = Sanctum::actingAs($user);

        $response = $this->get(route('api.items.index'));

        $response->assertStatus(200);
    }

    public function testCreateItem()
    {
        $user = User::factory()->create();

        $user = Sanctum::actingAs($user);

        $response = $this->post(route('api.items.store'), [
            'name' => 'Item 1',
            'code' => '123456',
            'description' => 'Description of item 1',
            'status' => 'Active',
        ]);

        $response->assertStatus(201);
    }

    public function testUpdateItem()
    {
        $user = User::factory()->create();

        $user = Sanctum::actingAs($user);

        $item = Item::factory()->create();

        $response = $this->put(route('api.items.update', $item->id), [
            'name' => 'Item 1',
            'code' => '123456',
            'description' => 'Description of item 1',
            'status' => 'Active',
        ]);

        $response->assertStatus(200);
    }

    public function testDeleteItem()
    {
        $user = User::factory()->create();

        $user = Sanctum::actingAs($user);

        $item = Item::factory()->create();

        $response = $this->delete(route('api.items.destroy', $item->id));

        $response->assertStatus(204);
    }
}

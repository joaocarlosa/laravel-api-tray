<?php

namespace Tests\Feature;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SellerControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testIndex()
    {
        $sellers = Seller::factory()->count(3)->create();

        $this->actingAs($this->user)
            ->get('/sellers')
            ->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function testShow()
    {
        $seller = Seller::factory()->create();

        $this->actingAs($this->user)
            ->get("/sellers/{$seller->id}")
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $seller->id,
                'name' => $seller->name,
                'email' => $seller->email,
            ]);
    }

    public function testStore()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ];

        $this->actingAs($this->user)
            ->post('/sellers', $data)
            ->assertStatus(201);

        $this->assertDatabaseHas('sellers', $data);
    }

    public function testUpdate()
    {
        $seller = Seller::factory()->create();

        $data = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ];

        $this->actingAs($this->user)
            ->put("/sellers/{$seller->id}", $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('sellers', $data);
    }

    public function testDestroy()
    {
        $seller = Seller::factory()->create();

        $this->actingAs($this->user)
            ->delete("/sellers/{$seller->id}")
            ->assertStatus(200)
            ->assertJson(['message' => 'Deleted successfully']);

        $this->assertDatabaseMissing('sellers', ['id' => $seller->id]);
    }
}

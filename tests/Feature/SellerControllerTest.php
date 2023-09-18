<?php
namespace Tests\Feature;

use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SellerControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $sellers = Seller::factory()->count(3)->create();
        $response = $this->get('/sellers');
        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }

    public function testShow()
    {
        $seller = Seller::factory()->create();
        $response = $this->get("/sellers/{$seller->id}");
        $response->assertStatus(200);
        $response->assertJsonFragment([
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

        $response = $this->post('/sellers', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('sellers', $data);
    }

    public function testUpdate()
    {
        $seller = Seller::factory()->create();

        $data = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ];

        $response = $this->put("/sellers/{$seller->id}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('sellers', $data);
    }

    public function testDestroy()
    {
        $seller = Seller::factory()->create();
        $response = $this->delete("/sellers/{$seller->id}");

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Deleted successfully']);
        $this->assertDatabaseMissing('sellers', ['id' => $seller->id]);
    }
}

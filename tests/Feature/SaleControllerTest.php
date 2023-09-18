<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Sale;
use App\Models\Seller;
use App\Models\User;

class SaleControllerTest extends TestCase
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
        Sale::factory()->count(3)->create();

        $this->actingAs($this->user)
            ->get('/sales')
            ->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function testStore()
    {
        $seller = Seller::factory()->create();
        $saleData = [
            'seller_id' => $seller->id,
            'value' => 100,
            'sale_date' => now()->toDateString(),
        ];

        $this->actingAs($this->user)
            ->post('/sales', $saleData)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'commission' => 8.5
                ]
            ]);
    }

    public function testShow()
    {
        $sale = Sale::factory()->create();

        $this->actingAs($this->user)
            ->get('/sales/'.$sale->id)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $sale->id
                ]
            ]);
    }

    public function testUpdate()
    {
        $sale = Sale::factory()->create(['value' => 100]);
        $updatedData = [
            'value' => 200
        ];

        $this->actingAs($this->user)
            ->put('/sales/'.$sale->id, $updatedData)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'commission' => 17
                ]
            ]);
    }

    public function testDestroy()
    {
        $sale = Sale::factory()->create();

        $this->actingAs($this->user)
            ->delete('/sales/'.$sale->id)
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Deleted successfully'
            ]);
    }
}

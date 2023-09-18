<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Sale;
use App\Models\Seller;



class SaleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        Sale::factory()->count(3)->create();
        $response = $this->get('/sales');
        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }

    public function testStore()
    {
        $seller = Seller::factory()->create();
        $saleData = [
            'seller_id' => $seller->id,
            'value' => 100,
            'sale_date' => now()->toDateString(),
        ];
        $response = $this->post('/sales', $saleData);
        $response->assertStatus(201);
        $response->assertJson([
            'data' => [
                'commission' => 8.5
            ]
        ]);
    }


    public function testShow()
    {
        $sale = Sale::factory()->create();
        $response = $this->get('/sales/'.$sale->id);
        $response->assertStatus(200);
        $response->assertJson([
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
        $response = $this->put('/sales/'.$sale->id, $updatedData);
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'commission' => 17
            ]
        ]);
    }

    public function testDestroy()
    {
        $sale = Sale::factory()->create();
        $response = $this->delete('/sales/'.$sale->id);
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Deleted successfully'
        ]);
    }


}

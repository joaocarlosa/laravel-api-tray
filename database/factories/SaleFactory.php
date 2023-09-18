<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition()
    {
        return [
            'seller_id' => Seller::factory(),
            'value' => $this->faker->randomFloat(2, 100, 1000),
            'commission' => $this->faker->randomFloat(2, 10, 100),
            'sale_date' => $this->faker->date,
        ];
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;

class SellerSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        Seller::factory()->count(10)->create();
    }
}

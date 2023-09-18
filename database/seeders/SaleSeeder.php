<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;

class SaleSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $this->call(SaleSeeder::class);
    }
}


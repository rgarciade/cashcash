<?php

namespace Database\Seeders;

use App\Models\Sales;
use Illuminate\Database\Seeder;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sales::truncate();

        Sales::insert([
            [
                'price' => 133.6
            ],
            [
                'price' => 200
            ],
            [
                'price' => 24
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Facturations;
use Illuminate\Database\Seeder;

class FacturationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Facturations::truncate();

        Facturations::insert([
            [
                'company_id' => 2,
                'price' => 133.6
            ],
            [
                'company_id' => 0,
                'price' => 200
            ],
            [
                'company_id' => 0,
                'price' => 24
            ]
        ]);
    }
}

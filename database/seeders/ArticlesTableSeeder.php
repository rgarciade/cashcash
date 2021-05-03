<?php

namespace Database\Seeders;

use App\Models\Articles;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Articles::truncate();

        Articles::insert([
            [
                'productid' => '1231',
                'description' => 'pantalla',
                'units' => '2',
                'purchase_price' => '22',
                'public_price' => '44'
            ],
            [
                'productid' => '12333',
                'description' => 'raton',
                'units' => '22',
                'purchase_price' => '12',
                'public_price' => '33'
            ],
            [
                'productid' => '12317',
                'description' => 'raton apple',
                'units' => '4',
                'purchase_price' => '88',
                'public_price' => '99'
            ],
            [
                'productid' => '12638',
                'description' => 'mpantalla alargada',
                'units' => '5',
                'purchase_price' => '134',
                'public_price' => '155'
            ],
            [
                'productid' => '12314',
                'description' => 'raton logitec',
                'units' => '4',
                'purchase_price' => '66',
                'public_price' => '77'
            ],
            [
                'productid' => '12633',
                'description' => 'mpantalla lg',
                'units' => '2',
                'purchase_price' => '13',
                'public_price' => '34'
            ],
            [
                'productid' => '12683',
                'description' => 'cable hdmi',
                'units' => '42',
                'purchase_price' => '13',
                'public_price' => '34'
            ]
        ]);
    }
}

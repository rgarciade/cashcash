<?php

namespace Database\Seeders;

use App\Models\SalesArticles;
use Illuminate\Database\Seeder;

class SalesArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SalesArticles::truncate();

        SalesArticles::insert([
            [
                'sales_id' => 1,
                'articleId' => 1,
                'description' => 'raton',
                'article_price' => 22.4,
                'units' => 1
            ],
            [
                'sales_id' => 2,
                'articleId' => 2,
                'description' => 'teclado',
                'article_price' => 44.1,
                'units' => 2
            ],
            [
                'sales_id' => 1,
                'articleId' => 3,
                'description' => 'pantalla',
                'article_price' => 55.6,
                'units' => 2
            ]
        ]);
    }
}

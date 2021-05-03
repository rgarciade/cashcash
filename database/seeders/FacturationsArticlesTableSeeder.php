<?php

namespace Database\Seeders;

use App\Models\FacturationsArticles;
use Illuminate\Database\Seeder;

class FacturationsArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        FacturationsArticles::truncate();

        FacturationsArticles::insert([
            [
                'facturation_id' => 1,
                'articleId' => 1,
                'article_price' => 22.4,
                'units' => 1
            ],
            [
                'facturation_id' => 2,
                'articleId' => 2,
                'article_price' => 44.1,
                'units' => 2
            ],
            [
                'facturation_id' => 1,
                'articleId' => 3,
                'article_price' => 55.6,
                'units' => 2
            ]
        ]);
    }
}

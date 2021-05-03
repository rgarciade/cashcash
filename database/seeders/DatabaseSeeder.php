<?php

namespace Database\Seeders;

use ArticlesTable;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ArticlesTableSeeder::class);
        $this->call(CompanysTableSeeder::class);
        $this->call(ConfigurationTableSeeder::class);
        $this->call(ContactTableSeeder::class);
        $this->call(FacturationsTableSeeder::class);
        $this->call(FacturationsArticlesTableSeeder::class);
    }
}

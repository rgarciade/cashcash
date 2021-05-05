<?php

namespace Database\Seeders;

use App\Models\MoneyBox;
use Illuminate\Database\Seeder;

class MoneyBoxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MoneyBox::insert([
            [
                'creation_date' => "2021-01-01 00:00:00",
                'money' => 120,
                'remove_to_box' => 12
            ],
        ]);
    }
}

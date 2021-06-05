<?php

namespace Database\Seeders;

use App\Models\Contacts;
use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contacts::truncate();

        Contacts::insert([
            [
                'companys_id' => 2,
                'email' => 'caca@#g',
                'name' => 'luis',
                'location' => 'apartaa',
                'telephone' => 'NULL',
                'facturacion' => '1421241',
            ],
            [
                'companys_id' => 3,
                'email' => 'awawaw@wwg.com',
                'name' => 'pepon',
                'location' => 'callejuela',
                'telephone' => 888888888,
                'facturacion' => '14241',
            ]
        ]);
    }
}

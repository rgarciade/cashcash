<?php

namespace Database\Seeders;

use App\Models\Companys;
use Illuminate\Database\Seeder;

class CompanysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Companys::truncate();

        Companys::insert([
            [
                'cif' => '0000000',
                'name' => 'Varios',
                'contact' => 'Varios',
                'location' => '',
                'telephone' => '',
                'email' => '',
                'street' => '',
                'city' => '',
                'province' => '',
                'state' => '',
                'postalcode' => '',
                'banck' => '',
                'mobile' => '',
                'notas' => ''
            ],
            [
                'cif' => '53619624t',
                'name' => 'empresiña',
                'contact' => 'luis',
                'location' => 'fff',
                'telephone' => '656543456',
                'email' => 'rgarcia@mm.com',
                'street' => 'calleee',
                'city' => 'madrid',
                'province' => 'madrid',
                'state' => 'madrid',
                'postalcode' => '28231',
                'banck' => 'BN12414',
                'mobile' => '45454545454',
                'notas' => 'sadasdasdasd'
            ],
            [
                'cif' => '33619622t',
                'name' => 'LA Empresa',
                'contact' => 'jose',
                'location' => 'ggg',
                'telephone' => '656511156',
                'email' => 'eso@mm.com',
                'street' => 'calleee1',
                'city' => 'madrid',
                'province' => 'madrid',
                'state' => 'madrid',
                'postalcode' => '28231',
                'banck' => 'BN12411',
                'mobile' => '45454545454',
                'notas' => 'fafsafa'
            ],
            [
                'cif' => '23619612t',
                'name' => 'Tu Empresa',
                'contact' => 'ana',
                'location' => 'ggg',
                'telephone' => '656511156',
                'email' => 'fff@mm.com',
                'street' => 'calleee2',
                'city' => 'madrid',
                'province' => 'madrid',
                'state' => 'madrid',
                'postalcode' => '28231',
                'banck' => 'BN12413',
                'mobile' => '45454545454',
                'notas' => 'fafsafa'
            ]
        ]);
    }
}

<?php

use App\Models\Articles;
use App\Models\Contacts;
use App\Models\Facturations;
use App\Models\FacturationsArticles;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    try {

        //dd(Articles::where('productid',12317)->get());
        $contact = FacturationsArticles::where('facturation_id',1);

        $contact->company;
        dd($contact);
        dd('holii');
    } catch (\Exception $e) {
        dd("Could not connect to the database.  Please check your configuration. error:" . $e );
    }
    return view('welcome');
});

<?php
namespace App\Http\Controllers\database;

use App\Models\Contacts;

class ContactsBbdd extends commonBbdd {
    protected static $model = Contacts::class;
}

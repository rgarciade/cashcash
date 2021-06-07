<?php
namespace App\Http\Controllers\database;

use App\Models\Contacts;

class ContactsBbdd extends commonBbdd {
    function __construct() {
        $this->model = new Contacts();
    }
}

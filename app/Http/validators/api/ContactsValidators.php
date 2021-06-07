<?php
namespace App\Http\validators\api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ContactsValidators extends Validator {
    public static function verifyCreateContact(Request $request){
        return Validator::make($request->all(), [
            'companys_id' => 'required|min:1|max:45',
            'email' => 'min:1|max:45',
            'name' => 'required|min:1|max:45',
            'location' => 'min:1|max:45',
            'telephone' => 'min:1|max:45',
            'facturacion' => 'min:1|max:45'
        ]);
    }
}

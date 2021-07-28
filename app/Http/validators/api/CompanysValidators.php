<?php
namespace App\Http\validators\api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CompanysValidators extends Validator {
    public static function verifyCreateCompany(Request $request){
        return Validator::make($request->all(), [
            'cif' => 'required|min:1|max:45',
            'name' => 'required|min:1|max:45',
            'contact' => 'max:45',
            'location' => 'max:45',
            'telephone' => 'max:45',
            'email' => 'max:45',
            'street' => 'max:45',
            'city' => 'max:45',
            'province' => 'max:45',
            'cta' => 'max:45',
            'state' => 'max:45',
            'postalcode' => 'max:45',
            'banck' => 'max:45',
            'mobile' => 'max:45',
            'notas' => 'max:45',
        ]);
    }
    public static function verifyUpdateACompany(Request $request){
        return Validator::make($request->all(), [
            'cif' => 'min:1|max:45',
            'name' => 'min:1|max:45',
            'contact' => 'min:1|max:45',
            'location' => 'min:1|max:45',
            'telephone' => 'min:1|max:45',
            'email' => 'min:1|max:45',
            'street' => 'min:1|max:45',
            'city' => 'min:1|max:45',
            'province' => 'min:1|max:45',
            'cta' => 'min:1|max:45',
            'state' => 'min:1|max:45',
            'postalcode' => 'min:1|max:45',
            'banck' => 'min:1|max:45',
            'mobile' => 'min:1|max:45',
            'notas' => 'min:1|max:45',
        ]);


    }
}

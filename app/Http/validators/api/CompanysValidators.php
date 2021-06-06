<?php
namespace App\Http\validators\api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CompanysValidators extends Validator {
    public static function verifyCreateCompany(Request $request){
        return Validator::make($request->all(), [
            'cif' => 'required|min:1|max:45',
            'name' => 'required|min:1|max:45',
            'contact' => 'required|min:1|max:45',
            'location' => 'required|min:1|max:45',
            'telephone' => 'required|min:1|max:45',
            'email' => 'required|min:1|max:45',
            'street' => 'required|min:1|max:45',
            'city' => 'required|min:1|max:45',
            'province' => 'required|min:1|max:45',
            'cta' => 'required|min:1|max:45',
            'state' => 'required|min:1|max:45',
            'postalcode' => 'required|min:1|max:45',
            'banck' => 'required|min:1|max:45',
            'mobile' => 'required|min:1|max:45',
            'notas' => 'required|min:1|max:45',
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

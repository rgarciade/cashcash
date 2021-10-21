<?php
namespace App\Http\validators\api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ArticlesValidators extends Validator {
    public static function verifyCreateArticles(Request $request){
        return Validator::make($request->all(), [
            'productid' => 'required|min:1|max:20',
            'description' => 'required|min:5|max:255',
            'units' => 'required|min:1|max:20',
            'public_price' => 'required|min:1|max:10',
            'purchase_price' => 'required|min:1|max:10'
        ]);
    }
    public static function verifyUpdateArticles(Request $request){
        return Validator::make($request->all(), [
            'productid' => 'min:1|max:20',
            'description' => 'min:5|max:255',
            'units' => 'min:1|max:20',
            'purchase_price' => 'min:1|max:10',
            'public_price' => 'min:1|max:10'
        ]);
    }
}

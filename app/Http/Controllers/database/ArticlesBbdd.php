<?php
namespace App\Http\Controllers\database;

use App\Models\Articles;

class ArticlesBbdd extends commonBbdd {

    protected static $model = Articles::class;
    
    public static function findArticlesByAllFields($string,$paginate) : array {
        return static::$model::where('productid','Like',"%$string%")
        ->orWhere('description','Like',"%$string%")
        ->orWhere('id','Like',"%$string%")
        ->paginate($paginate)->toarray();
    }
}

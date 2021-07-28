<?php
namespace App\Http\Controllers\database;

use App\Models\Articles;

class ArticlesBbdd extends commonBbdd {

    protected static string $model = Articles::class;

    public static function findArticlesByAllFields($string) : array {
        return static::$model::where('productid','Like',"%$string%")
        ->orWhere('description','Like',"%$string%")
        ->orWhere('id','Like',"%$string%")
        ->get()->toarray();
    }
    public static function findArticlesByAllFieldsPaginate($string,$paginate) : array {
        return static::$model::where('productid','Like',"%$string%")
        ->orWhere('description','Like',"%$string%")
        ->orWhere('id','Like',"%$string%")
        ->paginate($paginate)->toarray();
    }
}

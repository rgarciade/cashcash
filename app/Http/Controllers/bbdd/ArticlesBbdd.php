<?php
namespace App\Http\Controllers\bbdd;

use App\Models\Articles;

class ArticlesBbdd extends commonBbdd {
    protected static $model = Articles::class;
}

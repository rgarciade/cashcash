<?php
namespace App\Http\Controllers\database;

use App\Models\Articles;

class ArticlesBbdd extends commonBbdd {
    protected static $model = Articles::class;
}

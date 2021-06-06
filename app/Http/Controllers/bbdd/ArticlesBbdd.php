<?php
namespace App\Http\Controllers\bbdd;

use App\Models\Articles;

class ArticlesBbdd extends commonBbdd {
    function __construct() {
        $this->model = new Articles();
    }
}

<?php

use App\Http\Controllers\api\ArticlesController;
use App\Http\Controllers\api\CompanysController;
use App\Http\Requests\UpdateArticlesRequest;
use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/facturation/{id}', function (Request $request) {
    return $request->user();
});
*/

//articles
Route::get('articles', [ArticlesController::class, 'allArticles']);
Route::get('articles/{id}', [ArticlesController::class, 'getArticle']);
Route::post('articles', [ArticlesController::class, 'newArticle']);
Route::match(array('PUT', 'PATCH'), "articles/{id}", function(Request $request, $id){
    $articlesController = new ArticlesController();
    return $articlesController->updateArticle($request,$id);
});

Route::delete('articles/{id}', [ArticlesController::class, 'deleteArticleFromId']);
Route::delete('articles/delete_from_productid/{id}', [ArticlesController::class, 'deleteArticleFromProductId']);


//companys
Route::get('companys', [CompanysController::class, 'allCompanys']);
Route::get('companys/{id}', [CompanysController::class, 'getCompany']);

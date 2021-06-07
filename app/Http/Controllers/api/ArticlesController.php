<?php

namespace App\Http\Controllers\api;

use App\Http\validators\api\ArticlesValidators;
use App\Http\Controllers\database\ArticlesBbdd;
use App\Http\Controllers\ApiResponseController;
use Illuminate\Http\Request;


class ArticlesController extends ApiResponseController {
    public function allArticles(){
        return $this->successResponse(ArticlesBbdd::getAllPaginator(20),200);
    }
    public function getArticle($id){

        $article = ArticlesBbdd::getFromId($id);
        if(count($article) == 0){
            return $this->errorResponse('',500,"article don't exist");
        }
        return $this->successResponse($article[0],200);
    }
    public function newArticle(Request $req){

        $validator = Articlesvalidators::verifyCreateArticles($req);
        if ($validator->fails()) return $this->errorResponse($validator->errors()->messages(),500,'error when create article');

        try {
            $article = ArticlesBbdd::insert([
                'productid' => $req->productid,
                'description' => $req->description,
                'units' => $req->units,
                'purchase_price' => $req->purchase_price,
                'public_price' => $req->public_price
            ]);
        } catch (\Throwable $th) {
            return $this->errorResponse(null,500,'sql insert Error, chech values');
        }
        if(!$article) $this->errorResponse(null,500,'sql insert Error, chech values');
        return $this->successResponse(null,200,'articulo insertado correctamente');
    }
    public function updateArticle(Request $request, $articleID){
        try {
            $validator = Articlesvalidators::verifyUpdateArticles($request);
            if ($validator->fails()) return $this->errorResponse($validator->errors()->messages(),500,'error when update article');
            $newArticle = ArticlesBbdd::updateValue($request->all(),$articleID);
            if(!count($newArticle->getChanges()))  return $this->errorResponse('',500,"any data to update");
        }
        catch (\Throwable $th) {
            return $this->errorResponse('',500,"error where update article");
        }


        return $this->successResponse(null,200,'update article');
    }
    public function deleteArticleFromProductId($pId){
        try {
            ArticlesBbdd::deleteFromColumAndValue('productid',$pId);
        } catch (\Throwable $th) {
            return $this->errorResponse(null,500,'sql delete Error, chech ProductId');
        }
        return $this->successResponse(null,200,'articulo borrado correctamente');
    }
    public function deleteArticleFromId($id){
        try {
            ArticlesBbdd::deleteFromId($id);
        } catch (\Throwable $th) {
            return $this->errorResponse(null,500,'sql delete Error, chech id');
        }
        return $this->successResponse(null,200,'articulo borrado correctamente');
    }
}

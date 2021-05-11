<?php

namespace App\Http\Controllers\api;

use App\Http\validators\api\Articlesvalidators;
use App\Http\Controllers\ApiResponseController;
use App\Models\Articles;
use Illuminate\Http\Request;


class ArticlesController extends ApiResponseController {
    public function allArticles(){
        return $this->successResponse(Articles::paginate(20),200);
    }
    public function getArticle($id){
        return $this->successResponse(Articles::where('id',$id)->firstOrFail());
    }
    public function newArticle(Request $req){

        $validator = Articlesvalidators::verifyCreateArticles($req);
        if ($validator->fails()) return $this->errorResponse($validator->errors()->messages(),500,'error when create article');

        try {
            $article = Articles::insert([
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
        return $this->successResponse(null,null,'articulo insertado correctamente');
    }
    public function updateArticle(Request $request, Articles $article){


        $validator = Articlesvalidators::verifyUpdateArticles($request);
        if ($validator->fails()) return $this->errorResponse($validator->errors()->messages(),500,'error when update article');

        $article->update($request->all());
        return $this->successResponse(null,null,'update article');
    }
    public function deleteArticleFromProductId($pId){
        try {
            $article = Articles::where('productid',$pId)->firstOrFail();;
            $article->delete();
        } catch (\Throwable $th) {
            return $this->errorResponse(null,500,'sql delete Error, chech ProductId');
        }
        return $this->successResponse(null,null,'articulo borrado correctamente');
    }
    public function deleteArticleFromId($id){
        try {
            //check exist
            $article = Articles::where('id',$id)->firstOrFail();
            //delete
            $article->delete();
        } catch (\Throwable $th) {
            return $this->errorResponse(null,500,'sql delete Error, chech id');
        }
        return $this->successResponse(null,null,'articulo borrado correctamente');
    }

    //TODO::creear metodo para el delete
}
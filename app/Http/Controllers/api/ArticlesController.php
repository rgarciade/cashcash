<?php

namespace App\Http\Controllers\api;

use App\Models\Articles;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiResponseController;

class ArticlesController extends ApiResponseController {
    public function allArticles(){
        return $this->successResponse(Articles::paginate(20),200);
    }
    public function getArticle($id){
        return $this->successResponse(Articles::where('id',$id)->firstOrFail());
    }
    public function newArticle(Request $req){
        try {
            $article = Articles::insert([
                'productid' => $req->productid,
                'description' => $req->description,
                'units' => $req->units,
                'purchase_price' => $req->purchase_price,
                'public_price' => $req->public_price
            ]);
        } catch (\Throwable $th) {
            return $this->errorResponse('sql insert Error, chech values');
        }
        if(!$article) $this->errorResponse('sql insert Error, chech values');
        return $this->successResponse(null,null,'articulo insertado correctamente');
    }
    public function updateArticle(Request $request, Articles $article){
        $article->update($request->all());
        return $this->successResponse(null,null,'update article');
    }
    //TODO::creear metodo para el delete
    //TODO::revisar metodo de update, checkear parametros que le llegan
}

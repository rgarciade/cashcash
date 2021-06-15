<?php

namespace Tests\Feature\api;

use App\Http\Controllers\database\ArticlesBbdd;
use App\Models\Articles;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\AssertableJson;

class ArticlesControllerTest extends TestCase {

    /**
     * @test
     */
    public function get_articles_status200(){
        $response = $this->get('/api/articles');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function get_articles_paginate_json(){

        $response = $this->get('/api/articles/paginate=20');
        $jsonArticles = file_get_contents(__DIR__."/testJsons/getAllArticlesPaginate.json");
        $expectedResponse = json_decode($jsonArticles,true);

        $response->assertExactJson($expectedResponse);
    }
    /**
     * @test
     */
    public function get_articles_json(){

        $response = $this->get('/api/articles');
        $jsonArticles = file_get_contents(__DIR__."/testJsons/getAllArticles.json");
        $expectedResponse = json_decode($jsonArticles,true);

        $response->assertExactJson($expectedResponse);
    }

    /**
     * @test
    */
    public function get_article_json(){
        $response = $this->get('/api/articles/1');
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->where('msg',"")
            ->where('code',200)
            ->has('data', function ($json) {
                $json->where('id', 1)
                ->where("id", 1)
                ->where("productid", "1231")
                ->where("description", "pantalla")
                ->where("units", 2)
                ->where("purchase_price", 22)
                ->where("public_price", 44);
            });
        });
    }
    /**
     * @test
    */
    public function get_article_json_error(){
        $articleId = 12;
        $response = $this->get("/api/articles/{$articleId}");
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('data')
            ->has('code')
            ->where('msg','article don\'t exist')
            ->where('code',500)
            ->where('data',"");
        });
    }
    /**
     * @test
    */
    public function post_insert_article_json(){
        DB::beginTransaction();
        $response = $this->post('/api/articles',[
            "productid" => 1231412,
            "description" => 'artículo nuevo',
            "units" => 12,
            "purchase_price" => 10,
            "public_price" => 20,
        ]);
        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->where('msg',"articulo insertado correctamente")
            ->where('code',200);
        });
        $responseNewData = $this->get('/api/articles/8');

        $responseNewData->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->where('msg',"")
            ->where('code',200)
            ->has('data', function ($json) {
                $json
                ->where("id", 8)
                ->where("productid", "1231412")
                ->where("description", "artículo nuevo")
                ->where("units", 12)
                ->where("purchase_price", 10)
                ->where("public_price", 20);
            });
        });
        DB::rollBack();
    }
    /**
     * @test
    */
    public function post_insert_article_json_error(){
        DB::beginTransaction();
        $response = $this->post('/api/articles',[]);
        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('code')
            ->has('data')
            ->where('msg',"error when create article")
            ->where('code',500)
            ->has('data', function ($json) {
                $json
                ->where("productid", ["The productid field is required."])
                ->where("description", ["The description field is required."])
                ->where("units", ["The units field is required."])
                ->where("purchase_price", ["The purchase price field is required."])
                ->where("public_price", ["The public price field is required."]);
            });
        });
        DB::rollBack();
    }
    /**
     * @test
    */
    public function path_update_article_json(){
        DB::beginTransaction();
        $response = $this->patch('/api/articles/1',[
            "description"=>"pantalla",
            "units"=>12
        ]);
        DB::rollBack();
        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->where('msg',"update article")
            ->where('code',200);
        });
    }
    /**
     * @test
    */
    public function path_update_article_json_error(){
        DB::beginTransaction();
        $articleId = 1;
        $responseUpdateFirst = $this->patch("/api/articles/{$articleId}",[]);
        $responseUpdateSecond = $this->patch("/api/articles/{$articleId}",[
            "description"=>"pantalla",
            "units"=>"eee"
        ]);

        $responseUpdateFirst->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('data')
            ->has('code')
            ->where('msg',"any data to update")
            ->where('code',500)
            ->where('data',"");
        });
        $responseUpdateSecond->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('data')
            ->has('code')
            ->where('msg',"error where update article")
            ->where('code',500)
            ->where('data',"");
        });
        DB::rollBack();
    }
     /**
     * @test
    */
    public function delete_article_from_producid_json(){
        DB::beginTransaction();
        $productid = 12633;
        $this->assertEquals(1,count(Articles::where('productid',$productid)->get()));
        $responseDelete = $this->delete("/api/articles/delete_from_productid/${productid}");
        $responseDelete->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('code')
            ->where('msg',"articulo borrado correctamente")
            ->where('code',200);
        });
        $this->assertEquals(0,count(Articles::where('productid',$productid)->get()));

        DB::rollBack();
    }
    /**
     * @test
    */
    public function delete_article_from_id_json(){
        DB::beginTransaction();
        $id = 1;
        $this->assertEquals(1,count(Articles::where('id',$id)->get()));
        $responseDelete = $this->delete("/api/articles/{$id}");
        $responseDelete->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('code')
            ->where('msg',"articulo borrado correctamente")
            ->where('code',200);
        });
        $this->assertEquals(0,count(Articles::where('id',$id)->get()));

        DB::rollBack();
    }
    /**
     * @test
    */
    public function delete_article_from_id_json_error(){
        DB::beginTransaction();
        $id = 123141235;
        $this->assertEquals(0,count(Articles::where('id',$id)->get()));
        $responseDeleteFirst = $this->delete("/api/articles/{$id}");
        $responseDeleteSecond = $this->delete("/api/articles/delete_from_productid/${id}");
        $responseDeleteFirst->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('code')
            ->has('data')
            ->where('msg',"sql delete Error, chech id")
            ->where('code',500)
            ->where('data',null);
        });
        $responseDeleteSecond->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('code')
            ->has('data')
            ->where('msg',"sql delete Error, chech ProductId")
            ->where('code',500)
            ->where('data',null);
        });
        DB::rollBack();
    }
     /**
     * @test
    */
    public function findArticlesByAllFields(){
        $articlesTocompare = [
            0 =>  [
              "id" => 1,
              "productid" => "1231",
              "description" => "pantalla",
              "units" => 2.0,
              "purchase_price" => 22.0,
              "public_price" => 44.0,
            ],
            1 =>  [
              "id" => 4,
              "productid" => "12638",
              "description" => "mpantalla alargada",
              "units" => 5.0,
              "purchase_price" => 134.0,
              "public_price" => 155.0,
            ],
            2 =>  [
              "id" => 6,
              "productid" => "12633",
              "description" => "mpantalla lg",
              "units" => 2.0,
              "purchase_price" => 13.0,
              "public_price" => 34.0
            ]
        ];
        $this->assertEquals($articlesTocompare,ArticlesBbdd::findArticlesByAllFields('al'));
    }
}

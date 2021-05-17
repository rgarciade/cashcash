<?php

namespace Tests\Feature\api;

use App\Models\Articles;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\AssertableJson;

class ArticlesControllerTest extends TestCase
{

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
    public function get_articles_json()
    {
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
    public function post_insert_article_json(){
        DB::beginTransaction();
        $response = $this->post('/api/articles',[
            "productid" => 1231412,
            "description" => 'artículo nuevo',
            "units" => 12,
            "purchase_price" => 10,
            "public_price" => 20,
        ]);
        $responseNewData = $this->get('/api/articles/8');
        DB::rollBack();
        $responseNewData->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->where('msg',"")
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


        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('code')
            ->where('msg',"articulo insertado correctamente")
            ->where('code',200);
        });
    }
    /**
     * @test
    */
    public function post_update_article_json(){
        DB::beginTransaction();
        $response = $this->post('/api/articles/1',[
            "description"=>"pantalla",
            "units"=>12
        ]);
        DB::rollBack();
        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('code')
            ->where('msg',"update article")
            ->where('code',200);
        });
    }
}

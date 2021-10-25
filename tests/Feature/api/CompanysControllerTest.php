<?php

namespace Tests\Feature\api;

use App\Http\Controllers\api\ArticlesController;
use App\Http\Controllers\api\CompanysController;
use App\Http\Controllers\database\CompanysBbdd;
use App\Models\Companys;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CompanysControllerTest extends TestCase {
    /**
     * @test
     */
    public function get_companys_status200(){
        $response = $this->getCallapi('/api/companys');

        $response->assertStatus(200);
    }
    /**
     * @test
     */
    public function get_companys_json(){

        $response = $this->getCallapi('/api/companys');
        $jsonArticles = file_get_contents(__DIR__."/testJsons/getAllCompanys.json");
        $expectedResponse = json_decode($jsonArticles,true);

        $response->assertExactJson($expectedResponse);
    }

    /**
     * @test
    */
    public function get_company_json(){
        $response = $this->getCallapi('/api/companys/3');
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->where('msg',"")
            ->where('code',200)
            ->has('data', function ($json) {
                $json->where('id', 3)
                ->where('cif','33619622t')
                ->where('name','LA Empresa')
                ->where('contact','jose')
                ->where('location','ggg')
                ->where('telephone','656511156')
                ->where('email','eso@mm.com')
                ->where('street','calleee1')
                ->where('city','madrid')
                ->where('province','madrid')
                ->where('cta',null)
                ->where('state','madrid')
                ->where('postalcode','28231')
                ->where('banck','BN12411')
                ->where('mobile','45454545454')
                ->where('notas','fafsafa')
                ->has('contacts.0',function ($jsonContacts) {
                    $jsonContacts->where("id", 2)
                    ->where("companys_id", 3)
                    ->where("email", "awawaw@wwg.com")
                    ->where("name", "pepon")
                    ->where("location", "callejuela")
                    ->where("telephone", "888888888")
                    ->where("facturacion", 14241);
                });
            });
        });
    }
    /**
     * @test
    */
    public function get_company_fom_name_json(){
        $response = $this->getCallapi('/api/companys/someField/Empresa');
        $jsonArticles = file_get_contents(__DIR__."/testJsons/getCompanyPaginated.json");
        $expectedResponse = json_decode($jsonArticles,true);
        $response->assertExactJson($expectedResponse);
    }
    /**
     * @test
    */
    public function get_company_json_error(){
        DB::beginTransaction();
        $companyId = 12;
        $response = $this->getCallapi("/api/companys/{$companyId}");
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('data')
            ->has('code')
            ->where('msg','Company don\'t exist')
            ->where('code',500)
            ->where('data',"");
        });
        DB::rollBack();
    }
    /**
     * @test
    */
    public function post_insert_company_json(){
        DB::beginTransaction();
        $response = $this->postCall('/api/companys',[
            'cif' => 'cifTest',
            'name' => 'nameTest',
            'contact' => 'contactTest',
            'location' => 'locationTest',
            'telephone' => 'telephoneTest',
            'email' => 'emailTest',
            'street' => 'streetTest',
            'city' => 'cityTest',
            'province' => 'provinceTest',
            'cta' => 'ctaTest',
            'state' => 'stateTest',
            'postalcode' => 'postalcodeTest',
            'banck' => 'banckTest',
            'mobile' => 'mobileTest',
            'notas' => 'notasTest',
        ]);
        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('code')
            ->where('msg',"Company insertada correctamente")
            ->where('code',200);
        });
        $responseNewData = $this->getCallapi('/api/companys/4');

        $responseNewData->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->where('msg',"")
            ->where('code',200)
            ->has('data', function ($json) {
                $json
                ->where('id', 4)
                ->where('cif', '23619612t')
                ->where('name', 'Tu Empresa')
                ->where('contact', 'ana')
                ->where('location', 'ggg')
                ->where('telephone', '656511156')
                ->where('email', 'fff@mm.com')
                ->where('street', 'calleee2')
                ->where('city', 'madrid')
                ->where('province', 'madrid')
                ->where('cta', null)
                ->where('state', 'madrid')
                ->where('postalcode', '28231')
                ->where('banck', 'BN12413')
                ->where('mobile', '45454545454')
                ->where('notas', 'fafsafa')
                ->where('notas', 'fafsafa')
                ->where('contacts',[]);
            });
        });
        DB::rollBack();
    }
    /**
     * @test
    */
    public function post_insert_company_json_error(){
        DB::beginTransaction();
        $response = $this->postCall('/api/companys',[]);
        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('code')
            ->has('data')
            ->where('msg',"error when create company")
            ->where('code',500)
            ->has('data', function ($json) {
                $json
                ->where("cif", ["The cif field is required."])
                ->where("name", ["The name field is required."]);
            });
        });
        DB::rollBack();
    }
   /**
     * @test
    */
    public function path_update_company_json(){
        DB::beginTransaction();
        $response = $this->patchCall('/api/companys/1',[
            "name"=>"empresaUpdated",
            "notas"=>'ssssss'
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
    /**
     * @test
    */
    public function path_update_article_json_error(){
        DB::beginTransaction();
        $articleId = 1;
        $responseUpdateFirst = $this->patchCall("/api/companys/{$articleId}",[]);
        $responseUpdateSecond = $this->patchCall("/api/companys/{$articleId}",[
            "name"=>""
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
            ->where('msg',"error when update Company")
            ->where('code',500);
        });
        DB::rollBack();
    }
    /**
     * @test
    */
    public function delete_company_from_id_json(){
        DB::beginTransaction();
        $id = 3;
        $this->assertEquals(1,count(CompanysBbdd::selectFromColumAndValue('id',$id)));
        $responseDelete = $this->deleteCall("/api/companys/${id}");
        $responseDelete->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('code')
            ->where('msg',"Compañia borrada correctamente")
            ->where('code',200);
        });
        $this->assertEquals(0,count(CompanysBbdd::selectFromColumAndValue('id',$id)));

        DB::rollBack();
    }
    /**
     * @test
    */
    public function delete_company_from_id_json_error(){
        DB::beginTransaction();
        $id = 33;
        $this->assertEquals(0,count(CompanysBbdd::selectFromColumAndValue('id',$id)));
        $responseDeleteFirst = $this->deleteCall("/api/companys/{$id}");
        $responseDeleteFirst->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('code')
            ->has('data')
            ->where('msg',"sql delete Error, chech id")
            ->where('code',500)
            ->where('data',null);
        });
        DB::rollBack();
    }
}

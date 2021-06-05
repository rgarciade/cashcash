<?php

namespace Tests\Feature\api;

use App\Http\Controllers\api\ArticlesController;
use App\Http\Controllers\api\CompanysController;
use App\Models\Companys;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CompanysControllerTest extends TestCase {
    use DatabaseMigrations;

    public function setUp(): void{
        parent::setUp();
        $this->seed();
    }
    /**
     * @test
     */
    public function get_companys_status200(){
        $response = $this->get('/api/companys');

        $response->assertStatus(200);
    }
    /**
     * @test
     */
    public function get_companys_json(){

        $response = $this->get('/api/companys');
        $jsonArticles = file_get_contents(__DIR__."/testJsons/getAllCompanys.json");
        $expectedResponse = json_decode($jsonArticles,true);

        $response->assertExactJson($expectedResponse);
    }

    /**
     * @test
    */
    public function get_company_json(){
        $response = $this->get('/api/companys/3');
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->where('msg',"")
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
     * @atest
    */
    public function get_company_json_error(){
        DB::beginTransaction();
        $articleId = 12;
        $response = $this->get("/api/articles/{$articleId}");
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('data')
            ->has('code')
            ->where('msg','company don\'t exist')
            ->where('code',500)
            ->where('data',"");
        });
    }
    /**
     * @atest
    */
    public function post_insert_company_json(){
        DB::beginTransaction();
        $response = $this->post('/api/company',[
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
            ->where('msg',"contacto insertado correctamente")
            ->where('code',200);
        });
        $responseNewData = $this->get('/api/company/8');

        $responseNewData->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->where('msg',"")
            ->has('data', function ($json) {
                $json
                ->where('id', 8)
                ->where('cif', 'cifTest')
                ->where('name', 'nameTest')
                ->where('contact', 'contactTest')
                ->where('location', 'locationTest')
                ->where('telephone', 'telephoneTest')
                ->where('email', 'emailTest')
                ->where('street', 'streetTest')
                ->where('city', 'cityTest')
                ->where('province', 'provinceTest')
                ->where('cta', 'ctaTest')
                ->where('state', 'stateTest')
                ->where('postalcode', 'postalcodeTest')
                ->where('banck', 'banckTest')
                ->where('mobile', 'mobileTest')
                ->where('notas', 'notasTest');
            });
        });
        DB::rollBack();
    }
    /**
     * @atest
    */
    public function post_insert_company_json_error(){
        DB::beginTransaction();
        $response = $this->post('/api/company',[]);
        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('code')
            ->has('data')
            ->where('msg',"error when create company")
            ->where('code',500)
            ->has('data', function ($json) {
                $json
                ->where("id", ["The id field is required."])
                ->where("cif", ["The cif field is required."])
                ->where("name", ["The name field is required."])
                ->where("contact", ["The contact field is required."])
                ->where("location", ["The location field is required."])
                ->where("telephone", ["The telephone field is required."])
                ->where("email", ["The email field is required."])
                ->where("street", ["The street field is required."])
                ->where("city", ["The city field is required."])
                ->where("province", ["The province field is required."])
                ->where("cta", ["The cta field is required."])
                ->where("state", ["The state field is required."])
                ->where("postalcode", ["The postalcode field is required."])
                ->where("banck", ["The banck field is required."])
                ->where("mobile", ["The mobile field is required."])
                ->where("notas", ["The notas field is required."]);
            });
        });
        DB::rollBack();
    }
    /**
     * @atest
    */
    public function delete_company_from_id_json(){
        DB::beginTransaction();
        $id = 3;
        $this->assertEquals(1,count(Companys::where('id',$id)->get()));
        $responseDelete = $this->delete("/api/companys/${id}");
        $responseDelete->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('code')
            ->where('msg',"compañia borrada correctamente")
            ->where('code',200);
        });
        $this->assertEquals(0,count(Companys::where('id',$id)->get()));

        DB::rollBack();
    }
    /**
     * @atest
    */
    public function delete_company_from_id_json_error(){
        $id = 3;
        $this->assertEquals(0,count(Companys::where('id',$id)->get()));
        $responseDeleteFirst = $this->delete("/api/companys/{$id}");
        $responseDeleteFirst->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('code')
            ->has('data')
            ->where('msg',"sql delete Error, chech id")
            ->where('code',500)
            ->where('data',null);
        });
    }
}

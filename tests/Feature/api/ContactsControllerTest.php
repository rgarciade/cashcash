<?php

namespace Tests\Feature\api;

use App\Http\Controllers\database\ContactsBbdd;
use App\Models\Contacts;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ContactsControllerTest extends TestCase {

    /**
     * @test
     */
    public function get_contacts_from_company_id(){
        DB::beginTransaction();
        $companyId = 3;
        $response = $this->get("/api/contacs/{$companyId}");
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('data')
            ->has('code')
            ->where('msg','')
            ->where('code',200)
            ->has('data.0',function ($jsonContacts) {
                $jsonContacts->where("id", 2)
                ->where("companys_id", 3)
                ->where("email", "awawaw@wwg.com")
                ->where("name", "pepon")
                ->where("location", "callejuela")
                ->where("telephone", "888888888")
                ->where("facturacion", 14241);
            });
        });
        DB::rollBack();
    }
    /**
     * @test
     */
    public function get_contacts_from__id(){
        DB::beginTransaction();
        $id = 2;
        $response = $this->get("/api/contac/{$id}");
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('data')
            ->has('code')
            ->where('msg','')
            ->where('code',200)
            ->has('data.0',function ($jsonContacts) {
                $jsonContacts->where("id", 2)
                ->where("companys_id", 3)
                ->where("email", "awawaw@wwg.com")
                ->where("name", "pepon")
                ->where("location", "callejuela")
                ->where("telephone", "888888888")
                ->where("facturacion", 14241);
            });
        });
        DB::rollBack();
    }
    /**
     * @test
    */
    public function post_insert_contact_json(){
        DB::beginTransaction();
        $response = $this->post('/api/contacs',[
            "companys_id" => 1,
            "email" => "asaas@wwg.com",
            "name" => "peponoo",
            "location" => "callejuela",
            "telephone" => "888888888",
            "facturacion" => 14241
        ]);
        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->where('msg',"Contac insertado correctamente")
            ->where('code',200);
        });
    }
    /**
     * @test
    */
    public function post_insert_contact_json_error(){
        DB::beginTransaction();
        $response = $this->post('/api/contacs',[
            "companys_id" => 'faafsa'
        ]);
        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) {
            $json->where('msg','error when create contac')
            ->where('code',500)
            ->has('data');
        });
        $response = $this->post('/api/contacs',[
            "companys_id" => 'faafsa',
            "email" => 'asfafsa',
            "name" => 'asfafa'
        ]);
        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) {
            $json->where('msg',"sql insert Error, chech values")
            ->where('code',500)
            ->has('data');
        });

        DB::rollBack();
    }
    /**
     * @test
    */
    public function delete_contact_from_contact_id_json(){
        DB::beginTransaction();
        $id = 2;
        $this->assertEquals(1,count(ContactsBbdd::getFromId($id)));
        $responseDelete = $this->delete("/api/contacs/${id}");
        $responseDelete->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->where('msg',"Contact borrado correctamente")
            ->where('code',200);
        });
        $this->assertEquals(0,count(Contacts::where('id',$id)->get()));

        DB::rollBack();
    }
    /**
     * @test
    */
    public function delete_contact_from_contact_id_json_error(){
        DB::beginTransaction();
        $id = 200;
        $this->assertEquals(0,count(ContactsBbdd::getFromId($id)));
        $responseDelete = $this->delete("/api/contacs/${id}");
        $responseDelete->assertJson(function (AssertableJson $json) {
            $json->where('msg','sql delete Error, chech id')
            ->where('code',500)
            ->has('data');
        });

        DB::rollBack();
    }
}

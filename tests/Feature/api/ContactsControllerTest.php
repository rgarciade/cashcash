<?php

namespace Tests\Feature\api;

use App\Http\Controllers\database\ContactsBbdd;
use App\Models\Contacts;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ContactsControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void{
        parent::setUp();
        $this->seed();
    }
    /**
     * @atest
     */
    public function get_contacts_from_company_id(){
        DB::beginTransaction();
        $companyId = 3;
        $response = $this->get("/api/contacts/{$companyId}");
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
     * @atest
    */
    public function post_insert_contact_json(){
        DB::beginTransaction();
        $response = $this->post('/api/contacts',[
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
            ->has('code')
            ->where('msg',"Contac insertado correctamente")
            ->where('code',200);
        });
    }
    /**
     * @atest
    */
    public function delete_contact_from_contact_id_json(){
        DB::beginTransaction();
        $id = 3;
        $contacts = new ContactsBbdd();
        $this->assertEquals(1,count($contacts->getFromId($id)));
        $responseDelete = $this->delete("/api/contacts/${id}");
        $responseDelete->assertJson(function (AssertableJson $json) {
            $json->has('msg')
            ->has('code')
            ->where('msg',"Contacto borrado correctamente")
            ->where('code',200);
        });
        $this->assertEquals(0,count(Contacts::where('id',$id)->get()));

        DB::rollBack();
    }
}

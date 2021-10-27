<?php

namespace Tests\Feature\api;

use App\Http\Controllers\database\ContactsBbdd;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class authControllerTest extends TestCase
{
    private $email = "testtt@testt.com";
    private $password = "caca";

    /**
     * @test
     */
    public function singup()
    {
        print_r($this->email);
        $response = $this->json('POST', "/api/auth/signup", [
            "name" => $this->email,
            "email" => $this->email,
            "password" => $this->password
        ]);
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
                ->has('code')
                ->where('msg', "Successfully created user!")
                ->where('code', 201);
        });
    }

    /**
     * @test
     */
    public function login()
    {
        $response = $this->json('POST', "/api/auth/login", [
            "email" => $this->email,
            "password" => $this->password
        ]);
        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
                ->has('data')
                ->has('code')
                ->where('msg', "Successfully loging!")
                ->where('code', 200)
                ->has('data', function ($jsonContacts) {
                    $jsonContacts->where("token_type", "Bearer")
                        ->has('expires_at')
                        ->has('access_token');
                });
        });
    }
    /**
     * @test
     */
    public function user()
    {

        $response = $this->json('POST', "/api/auth/login", [
            "email" => $this->email,
            "password" => $this->password
        ]);
        $AuthTokenTests = $response->original['data']['access_token'];


        $response = $this->withHeaders(
            ['Authorization' => 'Bearer ' . $AuthTokenTests]
        )->json('GET', "/api/auth/user");

        $response->assertJson(function (AssertableJson $json) {
            $json->has('msg')
                ->has('data')
                ->has('code')
                ->where('msg', "user data")
                ->where('code', 200)
                ->has('data', function ($jsonContacts) {
                    $jsonContacts
                        ->has('id')
                        ->has('name')
                        ->has('email')
                        ->has('email_verified_at')
                        ->has('created_at')
                        ->has('updated_at');
                });
        });
    }
    /**
     * @test
     */
    public function unauthenticated()
    {
        $response = $this->withHeaders(
            ['Authorization' => 'Bearer ' . '--']
        )->json('GET', "/api/auth/user");

        $response->assertJson(function (AssertableJson $json) {
            $json->has('errors', function ($jsonContacts) {
                $jsonContacts
                    ->where('status', 401)
                    ->where('message', 'Unauthenticated');
            });
        });
    }
}

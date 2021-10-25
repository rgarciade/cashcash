<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    const AuthToken = '';
    public function setUp(): void
    {
        parent::setUp();
        $random = random_int(1, 99999);
        User::create([
            'name' => 'testUser' . $random,
            'email' => "testUser$random@email.com",
            'password' => bcrypt(12345)
        ]);
        Auth::attempt([
            'email' => "testUser$random@email.com",
            'password' => 12345,
        ]);
        $user_login_token = Auth::user()->createToken('Personal Access Token');
        $this->AuthToken = $user_login_token->accessToken;
    }
    public function getHeaders()
    {
        return [
            'Content-Type:application/json',
            'Authorization:Bearer ' . $this->AuthToken
        ];
    }
    public function getCallapi($url)
    {
        return $this->withHeaders(['Authorization' => 'Bearer ' . $this->AuthToken])
            ->json('GET', $url);
    }
    public function deleteCall($url)
    {
        return $this->withHeaders(['Authorization' => 'Bearer ' . $this->AuthToken])
            ->json("DELETE", $url);
    }
    public function postCall(string $url, array $params)
    {
        return $this->withHeaders(['Authorization' => 'Bearer ' . $this->AuthToken])
            ->json('POST', $url, $params);
    }
    public function patchCall(string $url, array $params)
    {
        return $this->withHeaders(['Authorization' => 'Bearer ' . $this->AuthToken])
            ->json('PATCH', $url, $params);
    }
}

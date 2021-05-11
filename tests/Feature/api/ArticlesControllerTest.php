<?php

namespace Tests\Feature\api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticlesControllerTest extends TestCase
{

    /**
     * @test
     */
    public function get_articles()
    {
        $response = $this->get('/api/articles');

        $response->assertStatus(200);
        $jsonArticles = file_get_contents(__DIR__."/testJsons/getAllArticles.json");
        $expectedResponse = json_decode($jsonArticles,true);

        $response->assertExactJson($expectedResponse);
    }
}
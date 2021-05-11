<?php

namespace Tests\Feature\api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticlesControllerTest extends TestCase
{
    /**
     * @test
     */
    public function get_articles()
    {
        $response = $this->get('/api/articles');

        $response->assertStatus(200);
        $expectedResponse = json_decode('{"data":{"current_page":1,"data":[{"description":"pantalla","id":1,"productid":"1231","public_price":44,"purchase_price":22,"units":12},{"description":"raton","id":2,"productid":"12333","public_price":33,"purchase_price":12,"units":22},{"description":"raton apple","id":3,"productid":"12317","public_price":99,"purchase_price":88,"units":4},{"description":"mpantalla alargada","id":4,"productid":"12638","public_price":155,"purchase_price":134,"units":5},{"description":"raton logitec","id":5,"productid":"12314","public_price":77,"purchase_price":66,"units":4},{"description":"mpantalla lg","id":6,"productid":"12633","public_price":34,"purchase_price":13,"units":2},{"description":"cable hdmi","id":7,"productid":"12683","public_price":34,"purchase_price":13,"units":42},{"description":"art\u00edculo nuevo","id":11,"productid":"123141","public_price":20,"purchase_price":10,"units":12}],"first_page_url":"http:\/\/cashcash.test\/api\/articles?page=1","from":1,"last_page":1,"last_page_url":"http:\/\/cashcash.test\/api\/articles?page=1","links":[{"active":false,"label":"&laquo; Previous","url":null},{"active":true,"label":"1","url":"http:\/\/cashcash.test\/api\/articles?page=1"},{"active":false,"label":"Next &raquo;","url":null}],"next_page_url":null,"path":"http:\/\/cashcash.test\/api\/articles","per_page":20,"prev_page_url":null,"to":8,"total":8},"msg":""}',true);

        $response->assertExactJson($expectedResponse);
    }
}

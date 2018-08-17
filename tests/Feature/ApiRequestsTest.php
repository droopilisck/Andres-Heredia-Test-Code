<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Provider\Uuid;
use Illuminate\Support\Str;
use App\Article;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ApiRequestsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A test class for the use of the API resource,
     * this is accesed by the controllers using
     * GET, PUT, POST adn DELETE requests
     * 
     * @return void
     * @test
     */
    public function testGetRequest()
    {
        $faker = Faker::create('App\Article');
        $statusArray = array("active", "inactive");
        
        //using faker and random numbers to generate dummy data
        DB::table('articles')->insert([
            'id' => '503bee2e-f068-45e4-8e4f-7ca13bcff533',
            'name' => 'Test Name',
            'description' => 'Test Description',
            'code' => "" . random_int(10, 99),
            'status' => $statusArray[(random_int(0, 1))],
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $response = $this->call('GET', 'api/articles');
        $this->assertContains("Test Name", $response->getContent());
    }

    /** @test*/
    public function testPutRequest()
    {
        $faker = Faker::create('App\Article');
        $statusArray = array("active", "inactive");

        //using faker and random numbers to generate dummy data
        DB::table('articles')->insert([
            'id' => '503bee2e-f068-45e4-8e4f-7ca13bcff533',
            'name' => 'Test Name',
            'description' => 'Test Description',
            'code' => "" . random_int(10, 99),
            'status' => $statusArray[(random_int(0, 1))],
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $parameters = [
            "article_id" => "503bee2e-f068-45e4-8e4f-7ca13bcff533",
            "name" => "Updated Test Name",
            "description" => "Updated Test Description",
            "status" => "inactive"
        ];

        $response = $this->call('PUT', 'api/article', $parameters);
        $this->assertContains("Updated Test Name", 
        $response->getContent());
    }

    /** @test*/
    public function tesPostRequest()
    {
        $parameters = [
            "name" => "Updated Test Name",
            "description" => "Updated Test Description",
            "status" => "inactive"
        ];

        $response = $this->call('POST', 'api/article', $parameters);
        $this->assertContains("Test Name", $response->getContent());
    }

    /** @test*/
    public function test_delete_request()
    {
        $faker = Faker::create('App\Article');
        $statusArray = array("active", "inactive");

        //using faker and random numbers to generate dummy data
        DB::table('articles')->insert([
            'id' => '503bee2e-f068-45e4-8e4f-7ca13bcff533',
            'name' => 'Test Name',
            'description' => 'Test Description',
            'code' => "" . random_int(10, 99),
            'status' => $statusArray[(random_int(0, 1))],
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $response = $this->call('DELETE', 
        "api/article/503bee2e-f068-45e4-8e4f-7ca13bcff533");
        $this->assertContains("Test Name", $response->getContent());
    } 
}

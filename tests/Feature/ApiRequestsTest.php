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

class ApiRequestsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_method()
    {
        $faker = Faker::create('App\Article');
        $status= array("active","inactive");
            //using faker and random numbers to generate dummy data
            DB::table('articles')->insert([
                'id' => '503bee2e-f068-45e4-8e4f-7ca13bcff533',
                'name' => 'Test Name',
                'description' => 'Test Description',
                'code' => "" . random_int(10, 99),
                'status'=>$status[(random_int(0, 1))],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        $response = $this->call('GET', 'api/articles');

        $response = $this->call($method, $uri, $parameters, $files, $server, $content);

        $this->assertEquals('Test Name', $response->getContent());
    }
}

<?php

//namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Provider\Uuid;
use Illuminate\Support\Str;
use App\Article;
use App\User;



class ArticleTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function test_articles_can_be_created()
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
        
        $found_article = Article::find('503bee2e-f068-45e4-8e4f-7ca13bcff533');
        $this->assertEquals($found_article->name,'Test Name');
        $this->assertEquals($found_article->description,'Test Description');

        DB::table('articles')->where('id', '==', '503bee2e-f068-45e4-8e4f-7ca13bcff533')->delete();

    }

    


    

}

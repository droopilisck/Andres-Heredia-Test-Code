<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Faker\Provider\Uuid;
use Illuminate\Support\Str;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //calling a Faker instance
        $faker = Faker::create('App\Article');
        $status= array("active","inactive");
        for ($i = 1; $i <= 30; $i++) {
            //using faker and random numbers to generate dummy data
            DB::table('articles')->insert([
                'uuid' => (string)Str::uuid(),
                'name' => $faker->sentence(),
                'description' => implode($faker->paragraphs(5)),
                'code' => "" . random_int(10, 99),
                'status'=>$status[(random_int(0, 1))],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

    }
}

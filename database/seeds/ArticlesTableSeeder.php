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
     * The class uses a Faker instance that generate dummy data.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('App\Article');
        $statusArray= array("active","inactive");
        for ($i = 1; $i <= 30; $i++) {
            DB::table('articles')->insert([
                'id' => (string)Str::uuid(),
                'name' => $faker->sentence(),
                'description' => implode($faker->paragraphs(5)),
                'code' => "" . random_int(10, 99),
                'status'=>$statusArray[(random_int(0, 1))],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}

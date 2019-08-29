<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            DB::table('products')->insert([
                'owner_id' => 1,
                'name' => ucfirst($faker->word),
                'proteins' => $faker->numberBetween(1, 100),
                'fats' => $faker->numberBetween(1, 100),
                'carbs' => $faker->numberBetween(1, 100),
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s')
            ]);
        }
    }
}

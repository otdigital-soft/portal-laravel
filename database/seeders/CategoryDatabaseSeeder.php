<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Create some parent categories
        $categories = [];
        for ($i = 1; $i <= 5; $i++) {
            $categories[] = [
                'id' => $i,
                'name' => $faker->word,
                'slug' => $faker->unique()->slug,
                'description' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insert the parent categories
        DB::table('categories')->insert($categories);

        // Create some subcategories for each parent category
        $subcategories = [];
        foreach ($categories as $category) {
            for ($i = 1; $i <= 3; $i++) {
                $subcategories[] = [
                    'name' => $faker->word,
                    'slug' => $faker->unique()->slug,
                    'description' => $faker->sentence,
                    'category_id' => $category['id'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        // Insert the subcategories
        DB::table('subcategories')->insert($subcategories);
    }
}

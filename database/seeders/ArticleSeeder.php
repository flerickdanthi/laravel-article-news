<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Assuming you have an 'articles' table with columns: title, content, category, source, published_at
        for ($i = 0; $i < 50; $i++) {
            DB::table('articles')->insert([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'category' => $faker->word,
                'source' => $faker->word,
                'published_at' => $faker->dateTimeThisYear,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

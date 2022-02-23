<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder {

    public function run(Faker $faker) {
        for($i = 0; $i < 10; $i++) {
            DB::table('books')->insert([
                'name' =>  $faker->title,
                'author' => $faker->name,
                'isbn'=> $faker->ssn,
                'editorial' => $faker->company,
                'category' => $faker->cityPrefix,
                'image' => $faker->imageUrl(),
                'url_pdf'=> '/images/pdf.png',
            ]);
        }
    }
}

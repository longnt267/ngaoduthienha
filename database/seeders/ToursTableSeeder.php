<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ToursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 30; $i++) {
            $tour = new Tour();
            $tour->title =  $faker->sentence($nbWords = 6, $variableNbWords = true);
            $tour->slug = Str::slug($tour->title);
            $tour->destination_id = rand(1, 5);
            $dir = public_path('storage/upload');
            $tour->image = $faker->image($dir, 400, 300, 'cats', false);
            $tour->type_tour_id = rand(1, 3);
            $tour->duration = rand(1, 10);
            $tour->price = rand(100, 500);
            $tour->save();
        }
    }
}

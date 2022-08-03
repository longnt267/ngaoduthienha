<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeTour;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class TypeToursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $titles = [
            'Tham quan',
            'Văn hóa',
            'Ẩm thực'
        ];

        foreach ($titles as $title) {
            $typeTour = new TypeTour();
            $typeTour->title = $title;
            $typeTour->slug = Str::slug($title);
            $typeTour->status = 1;
            $typeTour->save();
        }
    }
}

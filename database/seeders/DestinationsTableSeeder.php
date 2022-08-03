<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class DestinationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $titles = [
            'Sapa, Laocai',
            'Hoian, Quangnam',
            'Ba Na Hill, Danang',
            'Muine, Binhthuan',
            'Hoankiem, Hanoi'
        ];

        foreach ($titles as $title) {
            $destination = new Destination();
            $destination->title = $title;
            $destination->slug = Str::slug($title);
            $dir = public_path('storage/upload');
            $destination->image = $faker->image($dir, 400, 300, '', false);
            $destination->status = 1;
            $destination->save();
        }
    }
}

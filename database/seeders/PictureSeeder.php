<?php

namespace Database\Seeders;

use App\Models\Picture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class PictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pictures = config('bnb.pictures');


            Picture::truncate();

        foreach ($pictures as  $picture) {

            $newPicture = new Picture();
            $newPicture->apartment_id = $picture['apartment_id'];
            $newPicture->img_url = $picture['img_url'];
            $newPicture->save();
        };
    }
}

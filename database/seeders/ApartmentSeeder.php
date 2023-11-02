<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;


class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Apartment::truncate();
        });

        $apartments = config('bnb.apartments');

        foreach ($apartments as  $apartment) {


            $newApartment = new Apartment();
            $newApartment->user_id = $apartment['user_id'];
            $newApartment->title = $apartment['title'];
            $newApartment->slug = $apartment['slug'];
            $newApartment->price_per_night = $apartment['price_per_night'];
            $newApartment->rooms_number = $apartment['rooms_number'];
            $newApartment->beds_number = $apartment['beds_number'];
            $newApartment->bathrooms_number = $apartment['bathrooms_number'];
            $newApartment->square_meters = $apartment['square_meters'];
            $newApartment->address = $apartment['address'];
            $newApartment->latitude = $apartment['latitude'];
            $newApartment->longitude = $apartment['longitude'];
            $newApartment->cover_img = $apartment['cover_img'];
            $newApartment->description = $apartment['description'];
            $newApartment->visible = $apartment['visible'];
            
            $newApartment->save();
        };
    }
}

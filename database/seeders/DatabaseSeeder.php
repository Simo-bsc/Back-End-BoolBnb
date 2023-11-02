<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            ApartmentSeeder::class, // La Relazione "Apartment" Deve rimanere in alto(sotto l'User) ( motivazione: SVALVOLA ZI)
            ViewSeeder::class,
            MessageSeeder::class,
            SponsorshipSeeder::class,
            PictureSeeder::class,
            ServiceSeeder::class,
        ]);
    }
}

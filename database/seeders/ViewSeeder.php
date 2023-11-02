<?php

namespace Database\Seeders;

use App\Models\View;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Models
use App\Models\Apartment;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        View::truncate();

        $apartments = Apartment::all();

        foreach ($apartments as $apartment) {
            for ($i = 0; $i < 12; $i++) { // Genera dati per ogni mese
                $views = rand(300, 1000); // Genera un numero casuale tra 1 e 1000
                for ($j = 0; $j < $views; $j++) { // Genera un numero casuale di visualizzazioni per mese
                    $newView = new View();
                    $newView->apartment_id = $apartment->id;
                    $newView->day = now()->startOfMonth()->subMonths(12 - $i)->toDateString();
                    $newView->address_ip = fake()->ipv4();
                    $newView->save();
                }
            }
        }
    }
}



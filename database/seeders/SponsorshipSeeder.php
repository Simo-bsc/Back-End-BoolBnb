<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//Helps
use Illuminate\Support\Facades\Schema;
use App\Models\Sponsorship;
use App\Models\Apartment;
class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsorships = [
            [
                'name' => 'Bronzo',
                'price' => 2.99,
                'duration' => 24,
            ],
            [
                'name' => 'Argento',
                'price' => 5.99,
                'duration' => 72,
            ],
            [
                'name' => 'Oro',
                'price' => 9.99,
                'duration' => 144,
            ],
        ];

        Schema::withoutForeignKeyConstraints(function () {
        Sponsorship::truncate();
        });

        foreach ($sponsorships as $sponsorship) {
           $newSponsorship = new Sponsorship();
           $newSponsorship->name = $sponsorship['name'];
           $newSponsorship->price = $sponsorship['price'];
           $newSponsorship->duration = $sponsorship['duration'];
           $newSponsorship->save();
       }

        foreach (config('bnb.apartments_sponsorships') as $apartment_sponsorship) {

            foreach (Sponsorship::all() as $sponsorship) {

                foreach (Apartment::all() as $apartment) {

                    if ($apartment['id'] == $apartment_sponsorship['apartment_id'] && $sponsorship['id'] == $apartment_sponsorship['sponsorship_id']) {
                        $duration = $sponsorship['duration'];
                        $apartment_sponsorship['end_date'] = date('Y-m-d H:i:s', strtotime($apartment_sponsorship['start_date']. ' + '.$duration.' hours'));
                        $sponsorship->apartments()->attach($apartment->id, array("start_date"=>$apartment_sponsorship["start_date"], "end_date"=>$apartment_sponsorship["end_date"]));

                    }
                }

                $sponsorship->save();
            }
        
        }
    }
























        // $apartments_sponsorships = config('bnb.apartments_sponsorships');

       
        
        // foreach ($apartments_sponsorships as $apartment_sponsorship) {
        //     $apartment = Apartment::find($apartment_sponsorship['apartment_id']);
            
        //     if ($apartment) {
        //         $apartment->sponsorships()->attach($apartment_sponsorship['sponsorship_id']);
        //     }
        // }

    }


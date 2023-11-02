<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {

        foreach (config('bnb.services') as $service) {
            Service::create($service);
        }

        foreach (config('bnb.apartments_services') as $apartment_service) {

            foreach (Service::all() as $service) {

                foreach (Apartment::all() as $apartment) {

                    if ($apartment['id'] == $apartment_service['apartment_id'] && $service['id'] == $apartment_service['service_id']) {
                        $service->apartments()->attach($apartment->id);
                    }
                }

                $service->save();
            }
        }
    }
}
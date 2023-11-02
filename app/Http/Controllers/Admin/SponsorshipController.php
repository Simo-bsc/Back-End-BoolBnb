<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsorship;
use Illuminate\Http\Request;

//Controller
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activeLink = 'sponsorizzazione';

        $user = Auth::user();

        $apartments = $user->apartments;

        $sponsorships = Sponsorship::all();

        return view('admin.sponsorships.index',compact('activeLink','user','apartments','sponsorships'));

    }

    public function store(Request $request)
    {   
        
        $activeLink = 'sponsorizzazione';
        $user = Auth::user();
        $formData = $request->all();

    if (isset($formData['apartment_id']) && isset($formData['sponsorship_id'])) {
        $apartment = Apartment::find($formData['apartment_id']);
        $sponsorship = Sponsorship::find($formData['sponsorship_id']);

        if ($apartment && $sponsorship) {

            // Trova l'ultima sponsorizzazione attiva per l'appartamento
            $lastSponsorship = $apartment->existingSponsorships()
                ->where('end_date', '>', now())
                ->orderBy('end_date', 'desc')
                ->first();
            
                $start_date = new DateTime();
                $start_date->add(new DateInterval('PT2H')); 

                if ($lastSponsorship) {
                    $start_date = new DateTime($lastSponsorship->pivot->end_date);
                }
    
                $end_date = clone $start_date;
                $end_date->add(new DateInterval('PT' . $sponsorship->duration . 'H'));
                
                
            // Associa la nuova sponsorizzazione all'appartamento
            $apartment->sponsorships()->attach($formData['sponsorship_id'], [
                'start_date' => $start_date->format('Y-m-d H:i:s'),
                'end_date' => $end_date->format('Y-m-d H:i:s'),
            ]);
        }
            $currentDate = new DateTime();
            setlocale(LC_TIME, 'it_IT');

    }
        return view('admin.sponsorships.succsess',compact('activeLink','apartment','sponsorship','currentDate'));
    }
}

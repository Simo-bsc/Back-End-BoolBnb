<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    public function index()
    {
        $sponsorships = Sponsorship::all('id','name','price','duration');

        return response()->json([
            'success'   => true,
            'results'   => $sponsorships
        ]);
    }
}
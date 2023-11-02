<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Apartment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $now = now()->addHours(2);
    
        $apartments = Apartment::select('apartments.*', 'apartment_sponsorship.start_date', 'apartment_sponsorship.end_date')
            ->leftJoin('apartment_sponsorship', function ($join) use ($now) {
                $join->on('apartments.id', '=', 'apartment_sponsorship.apartment_id')
                    ->where('apartment_sponsorship.start_date', '<=', $now)
                    ->where('apartment_sponsorship.end_date', '>=', $now);
            })
            ->where('apartments.visible', 1)
            ->orderByRaw('CASE
                WHEN apartment_sponsorship.start_date IS NOT NULL THEN 1
                ELSE 2
            END, apartment_sponsorship.start_date DESC')
            ->take(8)
            ->get();
    
        return response()->json([
            'success' => true,
            'results' => $apartments,
        ]);
    }
    
    public function show($slug)
    {
        $apartment = Apartment::where("slug", $slug)->with(["pictures", "services","sponsorships","user"])->firstOrFail();

        return response()->json([
            'success'   => $apartment ? true : false,
            'results'   => $apartment,
        ]);
    }

    public function search(Request $request): JsonResponse
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $distance = $request->input('distance');
        $square_meters = $request->input('square_meters');
        $square_meters = intval($square_meters);
        $rooms_number = $request->input('rooms_number');
        $rooms_number = intval($rooms_number);
        $beds_number = $request->input('beds_number');
        $beds_number = intval($beds_number);
        $bathrooms_number = $request->input('bathrooms_number');
        $bathrooms_number  = intval($bathrooms_number);
        $services = $request->input('services');

        $apartments = $this->getApartmentsFiltered(
            $latitude,
            $longitude,
            $distance,
            $square_meters,
            $rooms_number,
            $beds_number,
            $bathrooms_number,
            $services
        );

        if (count($apartments) == 0) {
            return response()->json(['apartments' => null], 200);
        }

        return response()->json([
            'success'   => true,
            'results'   => $apartments,
        ]);
    }

    public function getApartmentsFiltered(
        $latitude,
        $longitude,
        $distance,
        $square_meters,
        $rooms_number,
        $beds_number,
        $bathrooms_number,
        $services
    ) {
        $earthRadius = 6371;
        $now = now()->addHours(2);

        if ($latitude || $longitude) {

            $apartments = Apartment::select('apartments.*', 'apartment_sponsorship.start_date', 'apartment_sponsorship.end_date')
            ->leftJoin('apartment_sponsorship', function ($join) use ($now) {
                $join->on('apartments.id', '=', 'apartment_sponsorship.apartment_id')
                    ->where('apartment_sponsorship.start_date', '<=', $now)
                    ->where('apartment_sponsorship.end_date', '>=', $now);
            })
            ->where('apartments.visible', 1)

            ->orderByRaw('CASE
                WHEN apartment_sponsorship.start_date IS NOT NULL THEN 1
                ELSE 2
            END, apartment_sponsorship.start_date DESC')
                ->selectRaw(
                    "( $earthRadius * acos(
            cos( radians($latitude) )
            * cos( radians( apartments.latitude ) )
            * cos( radians( apartments.longitude ) - radians($longitude) )
            + sin( radians($latitude) )
            * sin( radians( apartments.latitude ) )
        )) AS distance"
                )
                ->whereRaw("( $earthRadius * acos(
            cos( radians($latitude) )
            * cos( radians( apartments.latitude ) )
            * cos( radians( apartments.longitude ) - radians($longitude) )
            + sin( radians($latitude) )
            * sin( radians( apartments.latitude ) )
        )) <= ?", [$distance])

                ->orderBy('distance')

                ->with(['services', 'pictures']);

        } else {
            $apartments = Apartment::select('apartments.*', 'apartment_sponsorship.start_date', 'apartment_sponsorship.end_date')
            ->leftJoin('apartment_sponsorship', function ($join) use ($now) {
                $join->on('apartments.id', '=', 'apartment_sponsorship.apartment_id')
                    ->where('apartment_sponsorship.start_date', '<=', $now)
                    ->where('apartment_sponsorship.end_date', '>=', $now);
            })
            ->where('apartments.visible', 1)
            ->orderByRaw('CASE
                WHEN apartment_sponsorship.start_date IS NOT NULL THEN 1
                ELSE 2
            END, apartment_sponsorship.start_date DESC');
        }

        $apartments->where('square_meters', '>=', $square_meters);
        $apartments->where('rooms_number', '>=', $rooms_number);
        $apartments->where('beds_number', '>=', $beds_number);
        $apartments->where('bathrooms_number', '>=', $bathrooms_number);

        if (is_array($services) && count($services) > 0) {
            $apartments->whereHas('services', function ($query) use ($services) {
                $query->whereIn('id', $services);
            }, '=', count($services));
        }
        

        return $apartments->get();
    }
}
    

   
    


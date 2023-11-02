<?php

namespace App\Http\Controllers\Admin;

use App\Models\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $activeLink = 'view';

        $user = Auth::user();

        $apartments = $user->apartments;

        $apartmentId = $request->input('apartment_id');

        // Verifica se l'appartamento appartiene all'utente
        if ($apartments->pluck('id')->contains($apartmentId)) {
            
            $views = DB::table('views')
                ->select('day', DB::raw('COUNT(DISTINCT address_ip) as total'))
                ->where('apartment_id', $apartmentId)
                ->groupBy('day')
                ->get();

            $data = [];
            foreach ($views as $view) {
                $data[] = [
                    'label' => $view->day,
                    'data' => $view->total,
                ];
            };

            $messages = DB::table('messages')
                ->select('day', DB::raw('COUNT(DISTINCT id) as total'))
                ->where('apartment_id', $apartmentId)
                ->groupBy('day')
                ->get();

            $dataMess = [];
            foreach ($messages as $message) {
                $dataMess[] = [
                    'label' => $message->day,
                    'data' => $message->total,
                ];
            };

            return view('admin.statistics.index', compact('apartments', 'activeLink', 'data', 'dataMess'));
        } else {
            // Gestisci l'errore come preferisci
            $user = Auth::user();

            $views = DB::table('views')
            ->select('day', DB::raw('COUNT(DISTINCT address_ip) as total'))
            ->whereIn('apartment_id', $user->apartments->pluck('id'))
            ->groupBy('day')
            ->get();

            // Crea un array con i dati
            $data = [];
            foreach ($views as $view) {
                $data[] = [
                    'label' => $view->day,
                    'data' => $view->total,
                ];
            }

            $messages = DB::table('messages')
                ->select('day', DB::raw('COUNT(DISTINCT id) as total'))
                ->whereIn('apartment_id', $user->apartments->pluck('id')) 
                ->groupBy('day')
                ->get();

            // Crea un array con i dati
            $dataMess = [];
            foreach ($messages as $message) {
                $dataMess[] = [
                    'label' => $message->day,
                    'data' => $message->total,
                ];
            }

            return view('admin.statistics.index', compact('apartments', 'activeLink', 'data', 'dataMess'));
        }
    }

    // public function getViewsByMonth()
    // {
    //     $currentYear = Carbon::now()->year;

    //     $viewsByMonth = DB::table('views')
    //         ->selectRaw('MONTH(day) as month, COUNT(*) as total')
    //         ->whereYear('day', $currentYear)
    //         ->groupBy('month')
    //         ->get();

    //     return response()->json($viewsByMonth);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(View $view)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(View $view)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, View $view)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(View $view)
    {
        //
    }
}

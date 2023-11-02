<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Helpers
use Illuminate\Support\Facades\Auth;

//Models
use App\Models\View;
use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class DasboardController extends Controller
{
    public function dashboard()
    {
        //Ottieni il link attuale
        $activeLink = 'dashboard';

        // Ottieni l'utente autenticato
        $user = Auth::user();

        // Ottenere gli appartamenti di questo utente
        $apartments = $user->apartments;

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

        $totalViews = 0;
        foreach ($apartments as $apartment) {
        $views = View::where('apartment_id', $apartment->id)->count(); // Assumendo che 'View' sia il modello per la tabella 'views'
        $totalViews += $views;
        }

        $totalMessages = 0;
        foreach ($apartments as $apartment) {
        $messages = Message::where('apartment_id', $apartment->id)->count(); // Assumendo che 'View' sia il modello per la tabella 'messages'
        $totalMessages += $messages;
        }
        
        return view('admin.dashboard',compact('apartments','activeLink','user', 'data', 'dataMess', 'totalViews', 'totalMessages'));
    }

}

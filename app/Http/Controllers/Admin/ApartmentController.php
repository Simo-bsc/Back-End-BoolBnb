<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Http\Controllers\Controller;
use App\Models\Service;

// Facades
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use GuzzleHttp\Client;



//Controllers

use App\Http\Controllers\Admin\PictureController;
use App\Models\Picture;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Ottieni il link attuale
        $activeLink = 'index';

        $user = Auth::user();

        $today = now();

        // Ottenere gli appartamenti di questo utente
        $apartments = $user->apartments()->with('existingSponsorships')->get();

        return view('admin.apartments.index', compact('apartments','activeLink','today'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Ottieni il link attuale
        $activeLink = 'create';

        $services = Service::all();

        $user = Auth::user();
        $apartments = $user->apartments;
        
        return view('admin.apartments.create', compact('apartments','services','activeLink'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreApartmentRequest $request)
    {
        
        $coverImagePath = null;

        $apiKey = 'BxLvW0WHQgAEf3K4FogUXlvUV2qjlM8J';

        $formData = $request->all();

        $address = $formData['address'];

        // Esegui la richiesta API TomTom
        
        $response = Http::withOptions(['verify' => false])->get("https://api.tomtom.com/search/2/geocode/$address.json", [
            'key' => $apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['results'][0])) {
                $geocodedLocation = $data['results'][0]['position'];

                // Assicurati che le chiavi 'lat' e 'lon' esistano nella risposta

                if (isset($geocodedLocation['lat']) && isset($geocodedLocation['lon'])) {
                    $latitude = $geocodedLocation['lat'];
                    $longitude = $geocodedLocation['lon'];

                    // Crea un nuovo oggetto Apartment con i dati ricevuti

                    $apartment = new Apartment();
                    $apartment->user_id = Auth::id();
                    $apartment->title = $formData['title'];
                    $apartment->slug = str()-> slug($formData['title']);
                    $apartment->price_per_night = $formData['price_per_night'];
                    $apartment->rooms_number = $formData['rooms_number'];
                    $apartment->beds_number = $formData['beds_number'];
                    $apartment->bathrooms_number = $formData['bathrooms_number'];
                    $apartment->square_meters = $formData['square_meters'];
                    $apartment->address = $formData['address'];
                    $apartment->longitude = $longitude;
                    $apartment->latitude = $latitude;
                    $apartment->description = $formData['description'];
                    $apartment->visible = $request->has('visible');

                    // Carica l'immagine di copertina
                    if ($request->hasFile('cover_img')) {
                        $coverImagePath = $request->file('cover_img')->store('uploads/images', 'public');
                        $apartment->cover_img = $coverImagePath;
                    }

                    // Salva l'appartamento nel database
                    $apartment->save();

                    // Collega i servizi all'appartamento (Many to many)

                    if (isset($formData['services'])) {
                        $apartment->services()->sync($formData['services']);
                    }

                    // Carica le immagini aggiuntive
                    if ($request->hasFile('pictures')) {
                        foreach ($request->file('pictures') as $picture) {
                            $path = $picture->store('uploads/images', 'public');
                            $apartment->pictures()->create(['img_url' => $path]);
                        }
                    }

                    return redirect()->route('admin.apartments.index');
                } else {
                    return back()->withInput()->withErrors(['api_error' => 'Posizione non valida']);
                }
            } else {
                return back()->withInput()->withErrors(['api_error' => 'Indirizzo non trovato']);
            }
        } else {
            return back()->withInput()->withErrors(['api_error' => 'Errore nella richiesta API TomTom']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         //Ottieni il link attuale
        $activeLink = 'index';

        $apartment = Apartment::findOrFail($id);

        if (Auth::id() !== $apartment->user_id) abort(403);
        
        $services = $apartment->services;

        $today = now();

        return view('admin.apartments.show',compact('apartment','activeLink','services', 'today'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        // Assicurati che l'utente sia autenticato
        if (!Auth::check()) {
            // Reindirizza l'utente alla pagina di accesso o mostra un messaggio di errore
            return redirect()->route('login')->with('error', 'Devi effettuare l\'accesso per modificare l\'appartamento.');
        }

        // Verifica se l'appartamento appartiene all'utente autenticato
        if ($apartment->user_id != Auth::id()) {
            // Restituisci una risposta HTTP 403 Forbidden
            abort(403, 'Non hai il permesso di modificare questo appartamento.');
        }
        //Ottieni il link attuale
        $activeLink = 'index';

        $services = Service::all();
        
        return view('admin.apartments.edit', compact('apartment', 'services','activeLink'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $apiKey = 'BxLvW0WHQgAEf3K4FogUXlvUV2qjlM8J';

        $formData = $request->all();
        
        $address = $formData['address'];

        // Esegui la richiesta API TomTom
        $response = Http::withOptions(['verify' => false])->get("https://api.tomtom.com/search/2/geocode/$address.json", [
            'key' => $apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['results'][0])) {
                $geocodedLocation = $data['results'][0]['position'];

                // Assicurati che le chiavi 'lat' e 'lon' esistano nella risposta
                
                if (isset($geocodedLocation['lat']) && isset($geocodedLocation['lon'])) {
                    $latitude = $geocodedLocation['lat'];
                    $longitude = $geocodedLocation['lon'];

                    // Crea un nuovo oggetto Apartment con i dati ricevuti

                    $apartment->user_id = Auth::id();
                    $apartment->title = $formData['title'];
                    $apartment->slug = str()-> slug($formData['title']);
                    $apartment->price_per_night = $formData['price_per_night'];
                    $apartment->rooms_number = $formData['rooms_number'];
                    $apartment->beds_number = $formData['beds_number'];
                    $apartment->bathrooms_number = $formData['bathrooms_number'];
                    $apartment->square_meters = $formData['square_meters'];
                    $apartment->address = $formData['address'];
                    $apartment->longitude = $longitude;
                    $apartment->latitude = $latitude;
                    $apartment->description = $formData['description'];
                    $apartment->visible = $request->has('visible');

                    // Carica l'immagine di copertina
                    if ($request->hasFile('cover_img')) {
                        $coverImagePath = $request->file('cover_img')->store('uploads/images', 'public');
                        $apartment->cover_img = $coverImagePath;
                    }

                    // Salva l'appartamento nel database
                    $apartment->save();

                    // Collega i servizi all'appartamento (Many to many)

                    // Services

                    if (isset($formData['services'])) {
                        $apartment->services()->sync($formData['services']);
                    }
                    else {
                        $apartment->services()->detach();
                    }

                    // Pictures

                    // Elimina la Cover Img esistente se è stata rimossa
                    if (isset($formData['remove_cover_img']) && $apartment->cover_img) {
                        Storage::delete($apartment->cover_img);
                        $apartment->cover_img = null;
                    }

                    // Carica la nuova Cover Img se è stata fornita
                    if ($request->hasFile('cover_img')) {
                        if ($apartment->cover_img) {
                            Storage::delete($apartment->cover_img);
                        }
                        $apartment->cover_img = $request->file('cover_img')->store('uploads/images', 'public');
                    }

                    // Elimina Img esistente se è stata selezionata la check box
                    if (isset($formData['remove_pictures']) && $apartment->pictures) {
                        foreach ($formData['remove_pictures'] as $removePictureId) {
                            $pictureToRemove = $apartment->pictures()->find($removePictureId);
                    
                            if ($pictureToRemove) {
                                // Elimina il file associato all'immagine
                                Storage::delete($pictureToRemove->img_url);
                    
                                // Rimuovi l'immagine dal database
                                $pictureToRemove->delete();
                            }
                        }
                    }

                    // Aggiungo le nuove Img al DB
                    if ($request->hasFile('pictures')) {
                        foreach ($request->file('pictures') as $picture) {
                            $path = $picture->store('uploads/images', 'public');
                            $apartment->pictures()->create(['img_url' => $path]);
                        }
                    }

                    return redirect()->route('admin.apartments.index');
                } else {
                    return back()->withInput()->withErrors(['api_error' => 'Posizione non valida']);
                }
            } else {
                return back()->withInput()->withErrors(['api_error' => 'Indirizzo non trovato']);
            }
        } else {
            return back()->withInput()->withErrors(['api_error' => 'Errore nella richiesta API TomTom']);
        }
    }
        
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return redirect()->route('admin.apartments.index');
    }

     

       
}

    


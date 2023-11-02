<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'price_per_night' => 'required|numeric|min:1',
            'rooms_number' => 'required|integer|min:1',
            'beds_number' => 'required|integer|min:1',
            'bathrooms_number' => 'required|integer|min:1',
            'square_meters' => 'required|integer|min:1',
            'address' => 'required|string|max:255|min:3',
            'cover_img' => 'image|max:4096',
            'description' => 'nullable|string',
            'services' => 'nullable|array',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Inserire il titolo è obbligatorio!',
            'title.max' => 'Inserire il titolo con massimo 255 caratteri!',
            'slug.required' => 'Inserire lo slug è obbligatorio!',
            'slug.max' => 'Inserire lo slug con massimo 255 caratteri!',
            'price_per_night.required' => 'Inserire il prezzo è obbligatorio!',
            // 'price_per_night.decimal' => 'Inserire il prezzo sottoforma di numero e con i suoi decimali(max 2)!',
            'price_per_night.min' => 'Inserire il prezzo che deve essere almeno maggiore di 1!',
            'rooms_number.required' => 'Inserire le stanze è obbligatorio!',
            'rooms_number.integer' => 'Inserire le stanze in forma numerica!',
            'rooms_number.min' => 'Inserire minimo 1 stanza!',
            'beds_number.required' => 'Inserire i letti è obbligatorio!',
            'beds_number.integer' => 'Inserire i letti in forma numerica!',
            'beds_number.min' => 'Inserire minimo 1 letto!',
            'bathrooms_number.required' => 'Inserire il bagno è obbligatorio!',
            'bathrooms_number.integer' => 'Inserire il bagno in forma numerica!',
            'bathrooms_number.min' => 'Inserire minimo 1 bagno!',
            'square_meters.required' => 'Inserire i metri quadri è obbligatorio!',
            'square_meters.integer' => 'Inserire i metri quadri in forma numerica!',
            'square_meters.min' => 'Inserire almeno 1 metro quadro!',
            'address.required' => 'Inserire l\'indirizzo è obbligatorio!',
            'address.string' => 'Inserire l\'indirizzo sotto forma di scrittura!',
            'address.max' => 'Inserire l\'indirizzo con un massimo di 255 caratteri!',
            'address.min' => 'Inserire l\'indirizzo con un minimo di 3 caratteri!',
            'city.required' => 'Inserire la città è obbligatorio!',
            'city.string' => 'Inserire la città sotto forma di scrittura è obbligatorio!',
            'city.min' => 'Inserire la città con un minimo di 3 caratteri è obbligatorio!',
            'zip.required' => 'Inserire il codice postale è obbligatorio!',
            'zip.min' => 'Inserire il codice postale con un minimo di 5 caratteri è obbligatorio!',
            'zip.max' => 'Inserire il codice postale con un massimo di 5 caratteri è obbligatorio!',
            'cover_img.required' => 'Inserire l\'immagine è obbligatorio!',
            'cover_img.image' => 'Inserire un file di tipo immagine!',
            'cover_img.max' => 'Inserire un file di tipo immagine di max 4 KB!',
            'description.string' => 'Inserire la descrizione sotto forma di scrittura!',
            'visible.required' => 'Inserire la visibilità della stanza e/o appartamento è obbligatorio!',
        ];
    }
}

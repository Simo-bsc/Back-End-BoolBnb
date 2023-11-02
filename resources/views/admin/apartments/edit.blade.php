@extends('layouts.app')

@section('page-title', 'BoolBnb|'. $apartment->title)

@section('main-content')

<script src="{{ asset('js/tomtom.js') }}"></script>

<div class="create">

    <div class="row w-100">

        <div class="col-12 m-auto p-5 border rounded shadow ">

            <h2 class="mt-3 mb-3 text-center">
                Modifica "<span>{{ $apartment->title }}</span>"...
            </h2>

            <form action="{{ route('admin.apartments.update', ['apartment' => $apartment->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{--  Campo/ title --}}

                <div class="mb-3">
                    <label for="title" class="form-label">Titolo <span class="text-danger">*</span></label>
                    @error('title')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <input  type="text" maxlength="250" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Aggiungi un titolo (descrittivo)..." value="{{ old('title', $apartment->title) }}" required>
                </div>

                {{--  Campo/ description --}}

                <div class="mb-3">
                    <label for="description" class="form-label @error('description') is-invalid @enderror">Descrizione <span class="text-danger">*</span></label>
                    @error('description')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <textarea class="form-control" id="description" name="description" rows="7" placeholder="Aggiungi descrizione..." required>{{ old('description', $apartment->description) }}</textarea>
                </div>

                <div class="row">

                    {{--  Campo/ price_per_night --}}

                    <div class="col-sm-12 col-lg-4">
                        <div class="mb-3">
                            <label for="price_per_night" class="form-label @error('price_per_night') is-invalid @enderror">Prezzo per notte <span class="text-danger">*</span></label>
                            @error('price_per_night')
                                <div class="alert alert-danger my-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="number" min="0" max="9999,99" class="form-control" id="price_per_night" name="price_per_night" value="{{ old('price_per_night', $apartment->price_per_night) }}" placeholder="Inserisci il prezzo per notte..." required>
                        </div>
                    </div>

                    {{--  Campo/ rooms_number --}}

                    <div class="col-sm-12 col-lg-4">
                        <div class="mb-3">
                            <label for="rooms_number" class="form-label @error('rooms_number') is-invalid @enderror">Numero di camere <span class="text-danger">*</span></label>
                            @error('rooms_number')
                                <div class="alert alert-danger my-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="number" min="1" max="20" class="form-control" id="rooms_number" name="rooms_number" value="{{ old('rooms_number', $apartment->rooms_number) }}" placeholder="Inserisci il numero di camere..." required>
                        </div>
                    </div>

                    {{--  Campo/ beds_number --}}

                    <div class="col-sm-12 col-lg-4">
                        <div class="mb-3">
                            <label for="beds_number" class="form-label @error('beds_number') is-invalid @enderror">Numero di letti <span class="text-danger">*</span></label>
                            @error('beds_number')
                                <div class="alert alert-danger my-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="number" min="1" max="50" class="form-control" id="beds_number" name="beds_number" value="{{ old('beds_number', $apartment->beds_number) }}" placeholder="Inserisci il numero di letti..." required>
                        </div>
                    </div>

                    {{--  Campo/ bathrooms_number --}}

                    <div class="col-sm-12 col-lg-4">
                        <div class="mb-3">
                            <label for="bathrooms_number" class="form-label @error('bathrooms_number') is-invalid @enderror">Numero di bagni <span class="text-danger">*</span></label>
                            @error('bathrooms_number')
                                <div class="alert alert-danger my-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="number" min="1" max="10" class="form-control" id="bathrooms_number" name="bathrooms_number" value="{{ old('bathrooms_number', $apartment->bathrooms_number) }}" placeholder="Inserisci il numero di bagni..." required>
                        </div>
                    </div>

                    {{--  Campo/ square_meters --}}

                    <div class="col-sm-12 col-lg-4">
                        <div class="mb-3">
                            <label for="square_meters" class="form-label @error('square_meters') is-invalid @enderror">Metri quadrati <span class="text-danger">*</span></label>
                            @error('square_meters')
                                <div class="alert alert-danger my-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="text" maxlength="7" class="form-control" id="square_meters" name="square_meters" value="{{ old('square_meters', $apartment->square_meters) }}" placeholder="Inserisci i metri quadrati..." required>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">

                    {{--  Campo/ address --}}

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="address" class="form-label @error('address') is-invalid @enderror">Indirizzo<span class="text-danger">*</span></label>
                            @error('address')
                                <div class="alert alert-danger my-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="py-2" id="search-box-container" onclick="toggleAddress()"></div>
                            <input type="text" name="address" id="address" hidden value="{{ old('address', $apartment->address) }}">
                        </div>
                    </div>
                </div>

                <hr>

                {{-- Campo Cover Img --}}

                <div class="input-group my-3 py-3">
                    <input type="file" class="form-control" id="cover_img" name="cover_img" value="{{ old('cover_img', $apartment->cover_img) }}" placeholder="Inserisci il link dell'immagine...">
                    @error('cover_img')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <label class="input-group-text @error('cover_img') is-invalid @enderror" for="inputGroupFile02">Cover Image</label>
                </div>

                <div class="col-sm-12 col-lg-3">
                    <img class="w-100" src="/storage/{{ $apartment->cover_img }}" alt="{{ $apartment->title }}">
                    <div class="form-check">
                        <label class="form-check-label" for="remove_cover_img">
                            Rimuovi
                        </label>
                        <input class="form-check-input" type="checkbox" id="remove_cover_img" name="remove_cover_img">
                    </div>
                </div>

                {{--Pictures --}}

                <div class="input-group my-3 py-3">
                    <input type="file" class="form-control" name="pictures[]" value="" placeholder="Inserisci il link dell'immagine..."  multiple accept="image/*">
                    @error('cover_img')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <label class="input-group-text" for="pictures[]">Immagini Appartamento</label>
                </div>

                <div class="row">
                    @foreach ($apartment->pictures as $picture)

                    <div class="col-sm-12 col-lg-4">

                        <img class="w-100 fixed-image" src="/storage/{{ $picture->img_url }}" alt="Immagine">

                        <div class="form-check">
                            <label class="form-check-label" for="remove_pictures[]">
                                Rimuovi
                            </label>
                            <input class="form-check-input" type="checkbox" id="remove_picture_{{ $picture->id }}" name="remove_pictures[]" value="{{ $picture->id }}">
                        </div>

                    </div>

                    @endforeach
                </div>

                <hr>

                {{-- Servizi  --}}

                {{-- @foreach ($services as $service)
                    <div class="form-check my-4 d-inline-block me-2">
                        <input class="form-check-input border-2" type="checkbox" name="services[]" value="{{ $service->id }}" id="service-{{ $service->id }}" @if ($errors -> any())
                        @if (
                            in_array(
                                $apartment->id,
                                old('apartments', [])
                            )
                        )
                            checked
                        @endif
                    @elseif ($service->apartments->contains($apartment))
                    checked
                    @endif>
                        <label class="form-check-label" for="service-{{ $service->id }}">
                            {{ $service->name }}
                            <i :class=" $service->icon "></i>

                        </label>
                    </div>
                @endforeach --}}
                @foreach ($services as $service)
                    <div class="form-check my-4 d-inline-block me-2">
                        <input class="form-check-input border-2" type="checkbox" name="services[]" value="{{ $service->id }}" id="service-{{ $service->id }}" @if (old('services', []) && in_array($service->id, old('services', [])))
                            checked
                        @elseif ($service->apartments->contains($apartment))
                            checked
                        @endif>
                        <label class="form-check-label" for="service-{{ $service->id }}">
                            {{ $service->name }}
                            <i :class=" $service->icon "></i>
                        </label>
                    </div>
                @endforeach


                {{--  Campo/ visible --}}

                <div class="form-check form-switch py-3">
                    <label class="form-check-label @error('visible') is-invalid @enderror" for="visible">Visibile </label>
                    @error('visible')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                    @enderror
                    @if ($apartment->visible == 1)
                    <input class="form-check-input" type="checkbox" name="visible" role="switch" id="visible" checked>
                    @else
                        <input class="form-check-input" type="checkbox" name="visible" role="switch" id="visible">
                    @endif

                </div>

                <hr>

                <button type="submit" class="m-auto col-12 btn ">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="M8 5a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8zm0-2h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8a5 5 0 0 1 5-5zm5 8h3a1 1 0 0 1 0 2h-3v3a1 1 0 0 1-2 0v-3H8a1 1 0 0 1 0-2h3V8a1 1 0 0 1 2 0v3z"></path></svg> <strong>Modifica Appartamento</strong>
                </button>

            </form>

        </div>

    </div>

</div>

<script>
    var options = {
        searchOptions: {
            key: "BxLvW0WHQgAEf3K4FogUXlvUV2qjlM8J",
            language: "it-IT",
            limit: 5,
        },
        autocompleteOptions: {
            key: "BxLvW0WHQgAEf3K4FogUXlvUV2qjlM8J",
            language: "it-IT",
        },
    }

    var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
    var searchBoxHTML = ttSearchBox.getSearchBoxHTML();

    // Trova il campo di input "address" e il container dove inserire la search box
    var addressInput = document.getElementById('address');
    var searchBoxContainer = document.getElementById('search-box-container');

    
    // Aggiungi la search box al container
    searchBoxContainer.appendChild(searchBoxHTML);

    const inputElement = document.querySelector('.tt-search-box-input');
    inputElement.placeholder = '{{ old('address', $apartment->address) }}';
    // Collega la search box al campo "address"
    ttSearchBox.on('tomtom.searchbox.resultselected', function(result) {
        addressInput.value = result.data.text;
    });
    let isAddressCleared = false;

    function toggleAddress() {
        if (!isAddressCleared) {
            // Al primo clic, svuota il campo "address"
            addressInput.value = '';
            isAddressCleared = true;
        } else {
            // Al secondo clic, popola il campo "address" con il valore preso
            addressInput.value = result.data.text;
            isAddressCleared = false;
        }
    }
</script>

@endsection
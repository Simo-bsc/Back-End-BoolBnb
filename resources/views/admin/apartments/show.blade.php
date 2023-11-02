@extends('layouts.app')

@section('page-title', 'BoolBnb | I Tuoi Appartamenti')

@section('main-content')

    {{-- Calcolo Data Fine Sponsorizzazione --}}
    @php
    $futureEndDate = null;
    @endphp
    @foreach ($apartment->existingSponsorships as $sponsorship)
    @if ($sponsorship->pivot->end_date >= $today && ($futureEndDate === null || $sponsorship->pivot->end_date > $futureEndDate))
    @php
            $futureEndDate = $sponsorship->pivot->end_date;
    @endphp
    @endif
    @endforeach

    <h1 class="text-center fw-bold">
        {{ $apartment->title }}
    </h1>



        <div class="container text-center ">

            <div class="row align-items-center container-button-show ">

                {{-- buttom edit --}}
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4">

                    
                        <a class="" href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id]) }}">
                            <button class="btn btn-outline-warning">
                                Modifica
                            </button>
                        </a>
                    

                </div>

                {{-- button sponsorship --}}
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 py-3">

                    
                        <a href="{{ route('admin.sponsorships.index') }}">
                            <span class="sponsor_btn">Sponsorizza</span> 
                        </a>
                    

                </div>

                {{-- button delete --}}
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4">

                    
                        <form class="d-inline" action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}" method="post"
                            onsubmit="return confirm('Sei sicuro di voler elimnare l\'appartamento?')">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger d-inline">
                                    Elimina
                                </button>
                        </form>
                    

                </div>


            </div>

        </div>




















    {{-- <div class="text-center container-button-show d-flex justify-content-center flex-column py-3">
        <div>
            <a class="py-2 " href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id]) }}">
                <button class="btn btn-outline-warning">
                    Modifica
                </button>
            </a>
        </div>

        <div class="px-3 py-3">
            <a href="{{ route('admin.sponsorships.index') }}">
                <span class="sponsor_btn">Sponsorizza</span> 
            </a>
        </div>

        <div class="d-inline div_form">
            <form class="d-inline" action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}" method="post"
                onsubmit="return confirm('Sei sicuro di voler elimnare l\'appartamento?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger d-inline">
                    Elimina
                </button>
            </form>
        </div>
    </div> --}}
        
    <hr>

    {{-- IMG CONTAINER --}}
    
    <div class="container">
        <div class="row H-row drcr">

            <div class="col-6">
                <img class="w-100 rounded float-start box-shadow" src="/storage/{{ $apartment->cover_img }}" alt="{{ $apartment->title }}">
            </div>

            <div class="col-6">

                {{-- VIA COMPLETA E CITTA' --}}
                <h2>{{ $apartment->address }}, <span class="price">{{ $apartment->price_per_night }}€ /N</span> </h2>

                {{-- VISIBILITA' --}}
                <h3>
                    <strong>Visibilita'= 
                        @if($apartment->visible == 1) 
                        <span class="active-visibility">ATTIVA</span> 
                        @else 
                        <span class="inactive-visibility">INATTIVA</span> 
                        @endif
                    </strong> 
                </h3>

                <div>
                    @if ($futureEndDate !== null)
                       @php
                          $carbonDate = \Carbon\Carbon::parse($futureEndDate);
                       @endphp
                          <h5>Sponsorizzato fino al : <span style="color: #F6AE2D"> {{ $carbonDate->format('d/m/Y H:i') }} </span> </h5>
                    @endif
                 </div>

                {{-- DESCRIZIONE --}}
                <h3>Descrizione <i class="fa-solid fa-arrow-turn-down"></i></h3>

                <p> {{ $apartment->description }}</p>

                

            </div>
            
        </div>
    </div>

    <hr>

    <div class="container">
        <div class="row d-flex img_desk">
            @foreach ($apartment->pictures as $picture)
                <div class="col-3 p-0 d-flex justify-content-center"> 
                    <div class="image-container py-3">
                        <img class="img rounded mx-auto fixed-image box-shadow" src="/storage/{{ $picture->img_url }}" alt="Immagine">
                    </div>
                </div>
            @endforeach
        </div>

        <div id="carouselExample" class="carousel slide carosello_img d-none box-shadow">
            <div class="carousel-inner">
                @foreach ($apartment->pictures as $key => $picture)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }} img_h">
                        <img src="/storage/{{ $picture->img_url }}" class="d-block w-100 rounded car_img" alt="Immagine">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" ariahidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        
    </div>
        
    <hr>

    {{-- SERVIZI --}}
    <div class="container container-mobile-show">
        <div class="row rowr ">

            <div class="col-6 size-col">

                <h3><strong>Informazioni principali</strong></h3>

                <div class="font-size">
                    <div class="border rounded-3 fill px-3 pt-1 m-2 fw-semibold"><i class="fa-solid fa-door-open"></i> Stanze: {{ $apartment->rooms_number }}</div>
                    <div class="border rounded-3 fill px-3 pt-1 m-2 fw-semibold"><i class="fa-solid fa-bed"></i> Letti: {{ $apartment->beds_number }}</div>
                    <div class="border rounded-3 fill px-3 pt-1 m-2 fw-semibold"><i class="fa-solid fa-bath"></i> Bagni: {{ $apartment->bathrooms_number }}</div>
                    <div class="border rounded-3 fill px-3 pt-1 m-2 fw-semibold"><i class="fa-solid fa-maximize"></i> M²: {{ $apartment->square_meters }}</div>
                </div>
            
            </div>

            <div class="col-6 font-size">
                
                <h3><strong>Servizi aggiunti</strong></h3>
                <div class="row rowr">
                    @foreach($services as $service)
                        <div class="col-auto px-3 border rounded m-1 pt-2 fw-semibold">
                            <i class="{{ $service->icon }}"></i> {{ $service->name }}
                        </div>
                    @endforeach
                </div>

            </div>

        </div>

    </div>

        

@endsection
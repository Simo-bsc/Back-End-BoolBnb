@extends('layouts.app')

@section('page-title', 'BoolBnb | I Tuoi Appartamenti')

@section('main-content')

<h1 class="m-3 text-center mb-5">I TUOI <strong class="name_color">APPARTAMENTI</strong></h1>

   @if (count($apartments) > 0)
      <div class="container container-apartment-fluid container-apartment-mobile">

         @foreach ($apartments as $apartment)
         
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

            <div class="row py-4 align-items-center bord">
               <div class="col-5 resp-img-col-5">
                  <div class="component_container">
                     @if ($futureEndDate !== null)
                        <div class="premium_badge"> 
                           Premium
                        </div> 
                     @endif
                     <img class="w-100 box-shadow"  style="max-height: 250px" src="/storage/{{ $apartment->cover_img }}" alt="{{ $apartment->title }}">
                  </div>
               </div>
               <div class="col-7 resp-img-col-7">
                  <h3>
                     {{ $apartment->title }}
                  </h3>
                  <h6 class="py-1">
                     {{ $apartment->address }}
                  </h6>
                  <h5 class="py-1">
                     Prezzo: <span class="price">{{ $apartment->price_per_night }}€ /N</span>  
                  </h5>

                  <div>
                     @if ($futureEndDate !== null)
                        @php
                           $carbonDate = \Carbon\Carbon::parse($futureEndDate);
                        @endphp
                           <h5>Sponsorizzato fino al : <span style="color: #F6AE2D"> {{ $carbonDate->format('d/m/Y H:i') }} </span> </h5>
                     @endif
                  </div>
                  
                  @if ($apartment->visible == 1)
                     <h5 class="py-1">Visibile: <span class="text-success"> SI </span></h5>
                  @else
                     <h5 class="py-1">Visibile: <span class="text-danger"> NO </span></h5>
                  @endif
                  
                  <div class="d-flex flx-col">
                     <a class="py-2 pe-3" href="{{ route('admin.sponsorships.index') }}">
                        <span class="sponsor_btn_index decor">Sponsorizza</span> 
                     </a>
                     <a class="py-2 pe-3" href="{{ route('admin.apartments.show',['apartment' => $apartment->id]) }}">
                        <button class="btn btn-outline-primary mtr">
                           Vedi
                        </button>
                     </a>
                     <a class="py-2 pe-3" href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id]) }}">
                        <button class="btn btn-outline-warning">
                           Modifica
                        </button>
                     </a>
                     <div class="py-2 pe-3">
                        <form action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}" method="post"
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
            </div>
      
         @endforeach

      </div>
   @else
      <div class="container w-75 py-5 text-center">
         <h1 class="p-4">
            Non hai ancora nessun Appartamento.
         </h1>

         <a href="{{ route('admin.apartments.create') }}" class="btn btn-outline-warning fw-bold w-50 @if($activeLink === 'create') activeLink @endif">
            Aggiungilo subito!
         </a>
        
      </div>
   @endif
   
   <style>
      .component_container {
         position: relative;
      }
      .premium_badge {
         position: absolute;
         z-index: 99;
         left: 0px;
         top: 0px;
         padding: 2px 5px;
         background-color: #F6AE2D;
         border: 1px solid #F6AE2D;
         border-bottom-right-radius: 10px;
         border-top-left-radius: 5px;
      }
   </style>
@endsection
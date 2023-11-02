@extends('layouts.app')

@section('page-title', 'BoolBnb | Payment Success')

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Pagamento Effettuato</div>

                <div class="card-body">

                    <p>Grazie per il tuo pagamento. Il tuo ordine: sponsor <strong>{{ $sponsorship->name }}</strong> è stato completato con successo.</p>
                    <p>Totale: </p>
                    <p><strong>{{ $sponsorship->price }} €</strong></p>
                    <p>Data dell'ordine: </p>
                    <p><strong>{{ strftime('%d %B %Y', $currentDate->getTimestamp()) }}</strong></p>
                    <p>Durata dell'ordine:</p>
                    <p><strong>{{ $sponsorship->duration }} ore</strong></p>
                    <p>Appartamento selezionato:</p>
                    @if(isset($apartment))
                        <p><strong>{{ $apartment->title }}</strong></p>
                    @else
                        <p>Nessun appartamento selezionato.</p>
                    @endif

                    <div class="row text-center justify-content-center">
                        <div class="col-auto"><div class="fw-bold p-2">
                            <a href="http://127.0.0.1:8000/admin/dashboard" class="turnhome-a-hover">
                                
                                <i class="fa-solid fa-circle-chevron-left"></i>
                                Torna alla home
                            </a>
                        </div></div>
                        <div class="col-auto"><div class="fw-bold p-2">
                            <a href="http://localhost:5173/" class="turnsite-a-hover">
                                
                                <i class="fa-solid fa-circle-chevron-left"></i>
                                Torna al Sito
                            </a>
                        </div></div>
                        <div class="col-auto"><div class="fw-bold p-2">
                            <a href="http://127.0.0.1:8000/admin/apartments" class="apartment-a-hover">
                                
                                <i class="fa-solid fa-circle-chevron-left"></i>
                                i tuoi Appartamenti
                            </a>
                        </div></div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection 
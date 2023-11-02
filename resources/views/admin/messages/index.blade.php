@extends('layouts.app')

@section('page-title', 'BoolBnb | Messaggi')

@section('main-content')
    <div class="container w-100 m-auto container-mobile-messages">

        <h1 class="m-3 text-center mb-5">I TUOI <strong class="name_color">MESSAGGI</strong></h1>

        <div>
            @if (count($messages) > 0)

                @foreach ($messages as $message)

                    <div class="row p-2 mb-3 borderBtm msgr">
                        <div class="col-4 ">
                            <div class="bg-col-left bg text-center">
                                <h4 class="py-2 d-inline-block title_bg">
                                    <strong>{{ $message->apartment->title }}</strong>
                                </h4>
                                <h5 class="py-1">
                                    {{ $message->apartment->address }} {{ $message->apartment->zip }} {{ $message->apartment->city }}
                                </h5>  
                                <div class="ps-1 pe-1 mb-2"><strong class="object fst-italic">{{ $message->object }}</strong></div>
                                {{-- <img src="/storage/{{ $message->apartment->cover_img }}" class="rounded" alt=""> --}}
                            </div>
                        </div>
                
                        <div class="col-8 borde">
                            <h4 class="py-2">
                                <strong>Nome:</strong> {{ $message->sender_name }}
                            </h4>
                            <h6 class="py-2">
                                <strong>Email:</strong> {{ $message->sender_email }}
                            </h6>
                            <p>
                                {{ $message->content }}
                            </p>
                        </div>
                    </div>

                    <hr>
                @endforeach 

            @else
                <div class="row text-center">
                    <div class="col-12">
                        <h2 class="py-5">
                            Nessun messaggio disponibile!
                        </h2>
                    </div>
                </div>
            @endif 
        </div>
    </div>
@endsection
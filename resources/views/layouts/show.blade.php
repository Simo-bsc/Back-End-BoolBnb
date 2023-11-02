@extends('layouts.app')

@section('page-title', 'BoolBnb | I Tuoi Appartamenti')

@section('main-content')
    <h1>
        {{ $apartment->title }}
    </h1>
    <p>
        {{ $apartment->description }}
    </p>

    <h6>
        Cover Img
    </h6>

    <div>
        <img class="w-25" src="/storage/{{ $apartment->cover_img }}" alt="{{ $apartment->title }}">
    </div>

    <h6>
        Altre Img
    </h6>
    <div>
        <div>
            @foreach ($apartment->pictures as $picture)
                <img class="w-25" src="/storage/{{ $picture->img_url }}" alt="Immagine">
            @endforeach
        </div>
    </div>



@endsection
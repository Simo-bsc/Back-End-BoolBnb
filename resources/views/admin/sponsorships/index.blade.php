@extends('layouts.app')

@section('page-title', 'BoolBnb | Sponsorships')

@section('main-content')

<h1 class="m-3 text-center mb-5">Raggiungi più utenti <strong class="name_color">sponsorizzando</strong> un tuo appartamento!</h1>

<div class="container container-payment w-75">
    <h3 class="text-center pb-3">
        Scegli il piano di sponsorizzazione e l'appartamento!
    </h3>
    <form action="{{ route('admin.sponsorships.store') }}" method="POST" id="form">
        @csrf

        <div class="row">
            @foreach ($sponsorships as $sponsorship)
                <div class="col-sm-12 col-md-12 col-lg-4 gx-5">
                    <div class="card text-center border_box mt-2">
                        <div class="card-body">
                        <h5 class="card-title spons_name_bg"> <strong>{{ $sponsorship->name }}</strong> </h5>
                        <p class="card-text">
                            <strong> Durata: {{ $sponsorship->duration }} ore</strong>
                        </p>
                        <div class="form-check">
                            <input class="form-check-input my_input" type="radio" name="sponsorship_id" id="{{ $sponsorship->id }}" value="{{ $sponsorship->id }}" required>
                            <label class="form-check-label" for="{{ $sponsorship->id }}">
                                <strong>{{ $sponsorship->price }} €</strong>
                            </label>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 gx-5 m-auto py-3">
                <select class="form-select" aria-label="Default select example" name="apartment_id" required id="apartment-select">
                    <option selected disabled>Seleziona un appartamento</option>
                        @foreach ($apartments as $apartment)
                            <option value="{{ $apartment->id }}">{{ $apartment->title }}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="row" id="payment-div" style="display: none;">
            <div class="col-sm-12 col-md-12 col-lg-6 m-auto">
                <div id="dropin-container" ></div>
                <div id="checkout-message"></div>
                <button id="submit-button" type="button" class="btn col-12 btn-primary">Conferma Dati</button>

                <div id="purchase-button-container" style="display: none;">
                    <button type="submit" class="btn col-12 btn-success">Acquista</button>
                </div>
            </div>
        </div>
        
    </form>

</div>

<script>
    let button = document.querySelector('#submit-button');
    let form = document.querySelector('#form');
    let purchaseButtonContainer = document.querySelector('#purchase-button-container');

    let dropinContainer = document.querySelector('#payment-div');
    let apartmentSelect = document.querySelector('#apartment-select');


    braintree.dropin.create({
        authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
        selector: '#dropin-container'
    }, function (err, instance) {
        button.addEventListener('click', function () {
            instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                   
                    console.error(err);
                } else {
                    button.style.display = 'none';
                    purchaseButtonContainer.style.display = 'block';

                }
            });
        });

        apartmentSelect.addEventListener('change', function () {
            if (apartmentSelect.value !== 'disabled') {
                dropinContainer.style.display = 'block';
            } else {
                dropinContainer.style.display = 'none';
            }
        });
    });
    
</script>

<style>

    .my_input{
        border: 3px solid #33658A;
    }

    .spons_name_bg{
        width: 100%;
        background-color: #33658A;
        border-radius: 5px;
        padding: 5px;
        color: #F6AE2D;
    }

    .border_box{
        border: 4px solid #33658A;
        border-radius: 10px;
    }

    .form-check .form-check-input {
        float: none;
        padding: 0 5px;
    }
    .button {
        cursor: pointer;
        font-weight: 500;
        left: 3px;
        line-height: inherit;
        position: relative;
        text-decoration: none;
        text-align: center;
        border-style: solid;
        border-width: 1px;
        border-radius: 3px;
        -webkit-appearance: none;
        -moz-appearance: none;
        display: inline-block;
    }

    .button--small {
        padding: 10px 20px;
        font-size: 0.875rem;
    }

    .button--green {
        outline: none;
        background-color: #64d18a;
        border-color: #64d18a;
        color: white;
        transition: all 200ms ease;
    }

    .button--green:hover {
        background-color: #8bdda8;
        color: white;
    }
</style>
  
@endsection
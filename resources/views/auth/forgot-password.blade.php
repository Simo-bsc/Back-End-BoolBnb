@extends('layouts.guest')

@section('main-content')
    <div class="container mt-5">
        <div class="w-75 m-auto border rounded shadow p-5 back-drop form_pass">
            <div>
                {{ __('Hai dimenticato la password? Nessun problema. Scrivi il tuo indirizzo e invieremo una e-mail per reimpostare la password.') }}
            </div>
        
            <form method="POST" action="{{ route('password.email') }}" class="">
                @csrf

                <div class="row mt-4">
                    <div class="col-12 w-100 mb-3">
                        <label for="email" class="form-label">
                            Email
                        </label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>

                    <div class="col-12 w-100">
                        <button type="submit" class="btn btn-success w-100">
                            Email Password Reset Link
                        </button>
                    </div>
                </div>
        
                {{-- <div class="row flex-column">
                    <!-- Email Address -->
                <div class="mt-4 col-12">
                    <label for="email" class="form-label">
                        Email
                    </label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
        
                <div class="mt-4 col-12">
                    <button type="submit" class="btn btn-outline-success w-100">
                        Email Password Reset Link
                    </button>
                </div>
                </div> --}}
            </form>
        </div>
    </div>
@endsection

@extends('layouts.guest')

@section('page-title', 'Register')

@section('main-content')
    <div class="container mt-5 mb-5">

        <div class="row justify-content-center">
            <div class="col-12 col-xs-12 col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <form class="w-75 m-auto border rounded p-3 shadoww back-drop form_reg" method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="row">

                        <!-- First Name -->
                        <div class="col-12 col-lg-6">
                            <label for="first_name" class="form-label">
                                <strong class="colortext" class="colortext">Nome</strong>
                            </label>
                            <input type="text" id="first_name" name="first_name" class="form-control" maxlength="64" minlength="3" value="{{ old('first_name') }}">
                        </div>

                        @error('first_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- Last Name -->
                        <div class="col-12 col-lg-6">
                            <label for="last_name" class="form-label">
                                <strong class="colortext">Cognome</strong>
                            </label>
                            <input type="text" id="last_name" name="last_name" class="form-control" maxlength="64" minlength="3" value="{{ old('last_name') }}">
                        </div>

                        @error('last_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
            
                    </div>
                    
                    <!-- Email Address -->
                    <div class="mt-4">
                        <label for="email" class="form-label">
                            <strong class="colortext">Email</strong> <span style="color: red">*</span>
                        </label>
                        <input type="email" id="email" name="email" class="form-control" maxlength="32" required value="{{ old('email') }}">
                    </div>

                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <!-- Birthday Date -->
                    <div class="mt-4">
                        <label for="date_of_birth" class="form-label">
                            <strong class="colortext">Data di nascita</strong>
                        </label>
                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" max="2005-10-11" value="{{ old('date_of_birth') }}">
                    </div>

                    @error('date_of_birth')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
            
                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="form-label">
                            <strong class="colortext">Password</strong> <span style="color: red">*</span>
                        </label>
                        <input type="password" id="password" name="password" class="form-control" maxlength="64" minlength="8" required value="{{ old('password') }}">
                    </div>

                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
            
                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <label for="password_confirmation" class="form-label">
                            <strong class="colortext">Conferma Password</strong> <span style="color: red">*</span>
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" maxlength="64" minlength="8" required value="{{ old('password_confirmation') }}">
                    </div>

                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="w-100 mt-4">
                        <button type="submit" class="btn m-0 btn-outline-warning w-100">
                            Registrati
                        </button>
                    </div>
            
                    <div class="text-center mt-3 mb-3">
                        <a href="{{ route('login') }}" class="text-dark">
                            {{ __('Già registrato?') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>

        
    </div>
@endsection

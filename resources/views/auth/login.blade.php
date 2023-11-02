@extends('layouts.guest')

@section('page-title', 'Login')

@section('main-content')
    <div class="container-fluid mt-5 ">


        <div class="row justify-content-center">
            <div class="col-12 col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-3">

                <form class="w-75 m-auto border rounded p-3 shadoww back-drop" method="POST" action="{{ route('login') }}">
                    @csrf
            
                    <!-- Email Address -->
                    <div>
                        <label for="email" class="form-label">
                            <strong class="colortext">Email</strong>
                        </label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
            
                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="form-label">
                            <strong class="colortext">Password</strong>
                        </label>
                        <input type="password" id="password" name="password" class="form-control" minlength="8" required>
                    </div>
            
                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me">
                            <input id="remember_me" type="checkbox" name="remember" class="form-check-input" >
                            <span><strong class="colortext">Remember me</strong></span>
                        </label>
                    </div>
        
                    <div class="w-100 mt-3">
                        <button type="submit" class="btn btn-outline-warning w-100">
                            LOGIN
                        </button>
                    </div>
            
                    <div class="text-center mt-3 mb-3">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-dark">
                                {{ __('Password dimenticata?') }}
                            </a>
                        @endif
                    </div>
                </form>




            </div>
        </div>

















       
    </div>
@endsection

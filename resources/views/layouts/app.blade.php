<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- FONTAWESOME --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        {{-- Tom Tom --}}
        <link
            rel="stylesheet"
            type="text/css"
            href="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox.css"
        />
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.1.2-public-preview.15/services/services-web.min.js"></script>
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js"></script>


        {{-- BRAINTREE PER PAGAMENTO --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

        
        <title>@yield('page-title')</title>

        <!-- Scripts -->
        @vite('resources/js/app.js')
        {{-- @vite('public/js/responsive.js') --}}
    </head>
    <body>
        <main class="position-sticky ">
            <header class="vh-100 vw-100 overflow-y-hidden">
                
                <nav class="navbar overflow">
                    <div class="container-fluid aside-xxl">
                        <div class="logo imgr-tablet mobile-tablet-visible">
                            <a href="http://localhost:5173/">
                                <img class="img-fluid" src="/storage/img/logo_black.png" alt="Logo"> 
                            </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse px-5 text-center" id="navbarSupportedContent">
                            <div class="logo mx-2 desktop-visible">
                                <a href="http://localhost:5173/">
                                    <img class="img-fluid" src="/storage/img/logo_black.png" alt="Logo"> 
                                </a> 
                            </div>
                            <ul class="navbar-nav  mb-2 mb-lg-0">
                                
                                <div class="d-flex flex-column h-100 justify-content-between">  
                                    <div>
                                        @if (count($apartments) > 0)
                                            <ul class="text-center ps-0">
                                                {{-- --------------- --}}
                                                <li class="py-2 px-2 tablet @if($activeLink === 'dashboard') activeLink @endif">
                                                    <a href="{{ route('admin.dashboard') }}" class="py-2">
                                                        <i class="fa-solid fa-display"></i>
                                                    </a>
                                                </li>
                                                <li class="py-2 mobile-desktop  @if($activeLink === 'dashboard') activeLink @endif">
                                                    <a href="{{ route('admin.dashboard') }}" class="py-2">
                                                        Dashboard
                                                    </a>
                                                </li>
                                                {{-- --------------- --}}
                                                {{-- --------------- --}}
                                                <li class="py-2 px-2 tablet  @if($activeLink === 'messaggi') activeLink @endif">
                                                    <a href="{{ route('admin.messages.index') }}" class=" position-relative py-2">
                                                        <i class="fa-regular fa-envelope"></i>
                                                    </a>
                                                    
                                                </li>
                                                <li class="py-2 px-2 mobile-desktop   @if($activeLink === 'messaggi') activeLink @endif">
                                                    <a href="{{ route('admin.messages.index') }}" class=" position-relative py-2">
                                                        Messaggi 
                                                    </a>
                                                    
                                                </li>
                                                {{-- --------------- --}}
                                                {{-- --------------- --}}
                                                <li class="py-2 px-2 tablet @if($activeLink === 'index') activeLink @endif">
                                                    <a href="{{ route('admin.apartments.index') }}" class="py-2 ">
                                                        <i class="fa-solid fa-house"></i>
                                                    </a>
                                                </li>
                                                <li class="py-2 px-2 mobile-desktop @if($activeLink === 'index') activeLink @endif">
                                                    <a href="{{ route('admin.apartments.index') }}" class="py-2  ">
                                                        I tuoi appartamenti
                                                    </a>
                                                </li>
                                                {{-- --------------- --}}
                                                {{-- --------------- --}}

                                                <li class="py-2 px-2 tablet @if($activeLink === 'create') activeLink @endif">
                                                    <a href="{{ route('admin.apartments.create') }}" class="py-2  ">
                                                        <i class="fa-solid fa-house-medical"></i>
                                                    </a>
                                                </li>
                                                <li class="py-2 px-2 mobile-desktop @if($activeLink === 'create') activeLink @endif">
                                                    <a href="{{ route('admin.apartments.create') }}" class="py-2  ">
                                                        Aggiungi appartamento
                                                    </a>
                                                </li>
                                                {{-- --------------- --}}
                                                {{-- --------------- --}}
                                                <li class="py-2 tablet @if($activeLink === 'sponsorizzazione') activeLink @endif">
                                                    <a href="{{ route('admin.sponsorships.index') }}" class="py-2  ">
                                                        <i class="fa-solid fa-money-check-dollar"></i>
                                                    </a>
                                                </li>
                                                <li class="py-2 px-2 mobile-desktop @if($activeLink === 'sponsorizzazione') activeLink @endif">
                                                    <a href="{{ route('admin.sponsorships.index') }}" class="py-2  ">
                                                        Sponsorizzazione
                                                    </a>
                                                </li>
                                                <li class="py-2 tablet @if($activeLink === 'view') activeLink @endif">
                                                    <a href="{{ route('admin.statistics.index') }}" class="py-2  ">
                                                        <i class="fa-solid fa-signal"></i>
                                                    </a>
                                                </li>
                                                <li class="py-2 mobile-desktop @if($activeLink === 'view') activeLink @endif">
                                                    <a href="{{ route('admin.statistics.index') }}" class="py-2  ">
                                                        Statistiche
                                                    </a>
                                                </li>
                                                {{-- --------------- --}}
                                                {{-- --------------- --}}

                                            </ul>
                                        @else
                                            <ul>
                                                <li class="py-2 px-2 tablet  @if($activeLink === 'dashboard') activeLink @endif">
                                                    <a href="{{ route('admin.dashboard') }}" class="py-2  ">
                                                        <i class="fa-solid fa-display"></i>
                                                    </a>
                                                </li>
                                                <li class="py-2 px-2 mobile-desktop  @if($activeLink === 'dashboard') activeLink @endif">
                                                    <a href="{{ route('admin.dashboard') }}" class="py-2 ">
                                                        Dashboard
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                            </ul>
                            <div class="container ps-0 pe-0 ">
                                <a class="" href="http://localhost:5173/">
                                    <i class="fa-solid fa-earth-americas pe-0 py-2 fa-xl"></i><p class="">Torna al sito</p>
                                </a>
                            </div>
                            <form class="button-sex" method="POST" action="{{ route('logout') }}">
                                @csrf
        
                                <button type="submit" class="btn tablet mb-3 btn-outline-danger">
                                    <p class="p-0 text-center">Out</p>

                                </button>
                                <button type="submit" class="btn mobile-desktop mb-5 btn-outline-danger">
                                    <p class=" text-center">Log out</p>
                                </button>
                                
                            </form>
                        </div>
                    </div>
                </nav>
                <div class="main-content vw-90 overflow-x-hidden overflow-y-scroll">
                    <div class="px-5 mobile">
                        @yield('main-content')
                    </div>
                </div>
            </header>
            </div>
        </main>
    </body>
</html>

<div class="w-100 pt-4 pb-4">
    <div class="container align-middle">
        <div class="row align-items-center back-drop shadoww">
            <div class=" col-4">
                <a href="/">
                    <div class="w-25">
                        <a href="http://localhost:5173/">
                            <img class="my-logo" src="/storage/img/logo_black.png" alt="Logo"> 
                        </a>
                    </div>
                </a>
            </div>
            <div class="col-4">
    
            </div>
            <div class="nav-links col-4">
                <ul class="d-flex align-items-center mb-0 ">
                    @auth
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="px-3">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li>
                            <div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
            
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="px-2">
                            <a href="{{ route('login') }}">Accedi</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">Registrati</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
        
    </div>
</div>

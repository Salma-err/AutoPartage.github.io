<nav class="navbar navbar-expand-md shadow-sm" style=" background-color:#dbece8;">
    <div class="container">
            <h1>Trace & Origin</h1>
            @if (Route::has('login'))
                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link">Accueil</a></li>
                    @else
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Connecter</a></li>
                        @if (Route::has('register'))
                            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">S'inscrire</a></li>
                        @endif
                    @endauth
                </ul>
            @endif
    </div>
</nav>
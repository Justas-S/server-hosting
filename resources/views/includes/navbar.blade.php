<nav class="nav navbar">
    <div class="container">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav pull-right">
                <li><a href="{{ route('home') }}">Pradžia</a></li>
                <li><a href="{{ route('gameserver.index') }}">Paslaugos</a></li>
                @if(Auth::check())
                <li><a href="{{ route('user.index') }}">Mano Meniu</a></li>
                <li><a href="{{ route('auth.logout') }}">Atsijungti</a></li>
                @else 
                <li><a href="{{ route('auth.register') }}">Registracija</a></li>
                <li><a href="{{ route('auth.login') }}">Prisijungimas</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
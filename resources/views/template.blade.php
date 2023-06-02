<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        
        <style> textarea {resize:none} </style>

     

        @yield('title')


    </head>
    <body>
        <header class="jumbotron">
            <div class="container">
                <nav>
                    <ul class="nav nav-pills">
                        <li role="presentation"><a href="{{ url('/') }}">Accueil</a></li>
                        <li role="presentation"><a href="{{ url('/chat') }}">Chat</a></li>
                        <li role="presentation"><a href="{{ url('/sondage') }}">Sondage</a></li>
                        
                        @if (Auth::check() && Auth::user()->role_id == 2)
                        <li role="presentation"><a href="{{ url('/creationsondage') }}">Création Sondage</a></li>
                        @endif
                        @if (!Auth::check())
                        <li role="presentation"><a href="{{ url('/login') }}">Connexion</a></li>
                        @endif
                        @if (Auth::check())
                        <li role="presentation"><a href="{{ url('/mon-compte') }}">Mon Compte</a></li>
                        <form method="post" action="{{ url('/logout') }}">
                            @csrf
                        <li role="presentation"><input type="Submit" value="Déconnexion"></li>
                        </form>
                    @endif
                    </ul>
                </nav>
                @yield('header')
            </div>
        </header>
        <div class="container" id="app" >
            @yield('contenu')
        </div>
    </body>
</html>
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

        @vite('resources/js/app.js')

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
                        <li role="presentation"><a href="{{ url('/mon-compte') }}">Connexion/Mon Compte</a></li>
                    </ul>
                </nav>
                @yield('header')
            </div>
        </header>
        <div class="container" id="app">
            @yield('contenu')
        </div>
    </body>
</html>
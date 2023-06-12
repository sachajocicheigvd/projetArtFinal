<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--<link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
-->
<!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite('resources/css/index.css')
        
        <style> textarea {resize:none} </style>

        @vite('resources/js/popup.js')

        @yield('title')
  

</head>
<body>
    <header class="jumbotron">
        <div class="container-nav">
            <nav>
                <ul class="nav nav-pills">
                  <li role="presentation"><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Emissions</a></li>
                  <li role="presentation"><a href="{{ route('vote') }}" class="{{ Request::is('vote') ? 'active' : '' }}">Vote musique</a></li>
                  <li role="presentation"><a href="{{ url('/sondagesacha') }}" class="{{ Request::is('sondagesacha') ? 'active' : '' }}">sondage sacha</a></li>
                  <li role="presentation"><a href="{{ url('/chat') }}" class="{{ Request::is('chat') ? 'active' : '' }}">Chat</a></li>
                  @if (Auth::check() && Auth::user()->role_id == 2)
                    <li role="presentation"><a href="{{ url('/creationsondage') }}" class="{{ Request::is('creationsondage') ? 'active' : '' }}">Création Sondage</a></li>
                  @endif
                  @if (!Auth::check())
                    <li role="presentation"><a href="{{ url('/loginchoice') }}" class="{{ Request::is('loginchoice') ? 'active' : '' }}">Connexion</a></li>
                  @endif
                  @if (Auth::check())
                    <li role="presentation"><a href="{{ url('/mon-compte') }}" class="{{ Request::is('mon-compte') ? 'active' : '' }}">Mon Compte</a></li>
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
    <div class="container"  >

        @yield('contenu')

<div id="player" class="PlayerFlex-container">
  <div class="audio-info">
    <img id= "imgCover" src="{{ asset('storage/images/saucisse9.png') }}" >
    <p id = "titreEmission" >Saucisse 9</p>
  </div>


   <!--  <img src="{{ asset('storage/images/logoCouleur3.svg') }}" style="width: 95px; 
        height: 147px" alt="logoCouleur3" class="logoCouleur3"> -->
 
      <audio id="audioPlayer" src="{{ asset('storage/images/saucisse9Audio.mp3')}} "></audio>
   
    <script>
      function playAudio() {
        let audio = document.querySelector("#audioPlayer");
        audio.play();
        
      }
    </script>
 <!-- <audio id="audioPlayer" src="resources\views\saucisse9.mp3"></audio> -->

  <button id = "boutonPlayPause" onclick="toggleAudio()" >
   <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
    <path fill-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" clip-rule="evenodd" />
  </svg>
    </button>
   <script>



      function toggleAudio() {
        console.log("toggleAudio")
        let audio = document.querySelector("#audioPlayer");
        if (audio.paused) {
          audio.play();
           localStorage.setItem("audioState", "playing");
        } else {
          audio.pause();
          localStorage.setItem("audioState", "paused");
        }
      }
    </script>
</div>

    </div>
        @if (Auth::check())
        <div id="app"></div>
        @endif
    <footer>
        <nav>
            <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}" >
                <svg class="iconenav" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-17 h-17">
                    <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
                </svg>
                <span class="textNav">Emissions</span>
            </a>
            <a href="{{ route('vote') }}" class="{{ Request::is('vote') ? 'active' : '' }}">
                <svg class="iconenav" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-17 h-17">
                    <path fill-rule="evenodd" d="M19.952 1.651a.75.75 0 01.298.599V16.303a3 3 0 01-2.176 2.884l-1.32.377a2.553 2.553 0 11-1.403-4.909l2.311-.66a1.5 1.5 0 001.088-1.442V6.994l-9 2.572v9.737a3 3 0 01-2.176 2.884l-1.32.377a2.553 2.553 0 11-1.402-4.909l2.31-.66a1.5 1.5 0 001.088-1.442V9.017 5.25a.75.75 0 01.544-.721l10.5-3a.75.75 0 01.658.122z" clip-rule="evenodd" />
                </svg>
                <span class="textVote">Vote musique</span>
            </a>
            <a href="{{ url('/chat') }}" class="{{ Request::is('chat') ? 'active' : '' }}">
                <svg class="iconenav" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-17 h-17">
                    <path fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97-1.94.284-3.916.455-5.922.505a.39.39 0 00-.266.112L8.78 21.53A.75.75 0 017.5 21v-3.955a48.842 48.842 0 01-2.652-.316c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97z" clip-rule="evenodd" />
                </svg>
                <span class="textChat">Chat</span>
            </a>
        </nav>
        @yield('footer')
    </footer>
</body>
</html>
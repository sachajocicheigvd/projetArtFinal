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
        
        <style> textarea {resize:none} </style>
        @vite('resources/css/index.css')

        <!-- <script src="{{ asset('public/js/popup.js') }}"></script> -->
        @vite('resources/js/app.js')

        @yield('title')
  

</head>
<body>
    <header class="jumbotron">
        <div class="container-nav">
            <nav>


           
          
              @if (Auth::check())
              @if (Request::is('/') || Request::is('stats'))
                <a href="{{ url('mon-compte') }}">
                <svg class="iconUser" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                </svg> 
                </a>
              @endif
               @elseif (Request::is('/'))
                <a href="{{ url('loginchoice') }}">
                <svg class="iconUser" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                </svg> 
                </a>
            @endif

          
            @if(Request::is('chat'))
            <header class = "headerChat">
           @endif
                 
             
              </nav>
              
              
        @yield('header')


             
        </div>
    </header>




    <div class="container"  >

        @yield('contenu')


 @if (Request::is('loginchoice') || Request::is('login') || Request::is('forgot-password') || Request::is('register') || Request::is('password/reset'))   

 <div> </div>
 @else
<div id="player" class="PlayerFlex-container">
  <div class="audio-info">
    <img id= "imgCover" src="{{ asset('/images/saucisse9.png') }}" >
    <p id = "titreEmission" >Saucisse 9</p>
  </div>


   <!--  <img src="{{ asset('storage/images/logoCouleur3.svg') }}" style="width: 95px; 
        height: 147px" alt="logoCouleur3" class="logoCouleur3"> -->
 
      <audio id="audioPlayer" src="{{ asset('/audio/saucisse9Audio.mp3')}} "></audio>
   
    <script>
      function playAudio() {
        let audio = document.querySelector("#audioPlayer");
        audio.play();
        
      }
    </script>
 <!-- <audio id="audioPlayer" src="resources\views\saucisse9.mp3"></audio> -->

  <button id = "boutonPlayPause" onclick="toggleAudio()" >
   <svg id="boutonPlayPauseChange" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
    <path fill-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" clip-rule="evenodd" />
  </svg>
    </button>
   <script>
    
      function toggleAudio() {
      
        let audio = document.querySelector("#audioPlayer");
        if (audio.paused) {
          audio.play();
          document.querySelector("#boutonPlayPauseChange").innerHTML = `<svg id="boutonPlayPauseChange" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
        <path fill-rule="evenodd" d="M6.75 5.25a.75.75 0 01.75-.75H9a.75.75 0 01.75.75v13.5a.75.75 0 01-.75.75H7.5a.75.75 0 01-.75-.75V5.25zm7.5 0A.75.75 0 0115 4.5h1.5a.75.75 0 01.75.75v13.5a.75.75 0 01-.75.75H15a.75.75 0 01-.75-.75V5.25z" clip-rule="evenodd" />
</svg>`
;
document.querySelector("#boutonPlayPausePageAccueilIcon").innerHTML = `<svg id="boutonPlayPausePageAccueilIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
        <path fill-rule="evenodd" d="M6.75 5.25a.75.75 0 01.75-.75H9a.75.75 0 01.75.75v13.5a.75.75 0 01-.75.75H7.5a.75.75 0 01-.75-.75V5.25zm7.5 0A.75.75 0 0115 4.5h1.5a.75.75 0 01.75.75v13.5a.75.75 0 01-.75.75H15a.75.75 0 01-.75-.75V5.25z" clip-rule="evenodd" />
</svg>`;
           localStorage.setItem("audioState", "playing");
        } else {
          audio.pause();
          document.querySelector("#boutonPlayPauseChange").innerHTML = ` <svg id="boutonPlayPauseChange" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
    <path fill-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" clip-rule="evenodd" <svg/>`
          localStorage.setItem("audioState", "paused");
          document.querySelector("#boutonPlayPausePageAccueilIcon").innerHTML = ` <svg id="boutonPlayPausePageAccueilIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
    <path fill-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" clip-rule="evenodd" <svg/>`
          localStorage.setItem("audioState", "paused");
        }
      }
    </script>
</div>
@endif


    </div>
        @if (Auth::check())
        <div id="app"></div>
        @endif
    <footer>
     @if (Auth::check() && Auth::user()->role_id == 2)
      
         <nav id="navAdmin">
            <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}" >
                <svg class="iconenavAdmin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-17 h-17">
                    <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
                </svg>
                <span class="textNav">Emissions</span>
            </a>
            <a href="{{ url('/aftersurvey') }}" class="{{ Request::is('stats')||Request::is('vote') ? 'active' : '' }}">
                <svg class="iconenavAdmin musika" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-17 h-17">
                    <path fill-rule="evenodd" d="M19.952 1.651a.75.75 0 01.298.599V16.303a3 3 0 01-2.176 2.884l-1.32.377a2.553 2.553 0 11-1.403-4.909l2.311-.66a1.5 1.5 0 001.088-1.442V6.994l-9 2.572v9.737a3 3 0 01-2.176 2.884l-1.32.377a2.553 2.553 0 11-1.402-4.909l2.31-.66a1.5 1.5 0 001.088-1.442V9.017 5.25a.75.75 0 01.544-.721l10.5-3a.75.75 0 01.658.122z" clip-rule="evenodd" />
                </svg>
                <span class="textVote">Vote musique</span>
            </a>
            <a href="{{ url('/chat') }}" class="{{ Request::is('chat') ? 'active' : '' }}">
                <svg class="iconenavAdmin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-17 h-17">
                    <path fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97-1.94.284-3.916.455-5.922.505a.39.39 0 00-.266.112L8.78 21.53A.75.75 0 017.5 21v-3.955a48.842 48.842 0 01-2.652-.316c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97z" clip-rule="evenodd" />
                </svg>
                <span class="textChat">Chat</span>
            </a>
            <a href="{{ url('/creation-sondage') }} " class="{{ Request::is('creation-sondage') ? 'active' : '' }}">
                <svg class="iconenavAdmin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-17 h-17">
                  <path fill-rule="evenodd" d="M20.432 4.103a.75.75 0 00-.364-1.455L4.128 6.632l-.2.033C2.498 6.904 1.5 8.158 1.5 9.575v9.175a3 3 0 003 3h15a3 3 0 003-3V9.574c0-1.416-.997-2.67-2.429-2.909a49.016 49.016 0 00-7.255-.658l7.616-1.904zm-9.585 8.56a.75.75 0 010 1.06l-.005.006a.75.75 0 01-1.06 0l-.006-.005a.75.75 0 010-1.061l.005-.005a.75.75 0 011.06 0l.006.005zM9.781 15.85a.75.75 0 001.061 0l.005-.005a.75.75 0 000-1.061l-.005-.005a.75.75 0 00-1.06 0l-.006.005a.75.75 0 000 1.06l.005.006zm-1.055-1.066a.75.75 0 010 1.06l-.005.006a.75.75 0 01-1.061 0l-.005-.005a.75.75 0 010-1.06l.005-.006a.75.75 0 011.06 0l.006.005zM7.66 13.73a.75.75 0 001.061 0l.005-.006a.75.75 0 000-1.06l-.005-.005a.75.75 0 00-1.06 0l-.006.005a.75.75 0 000 1.06l.005.006zM9.255 9.75a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75h-.008a.75.75 0 01-.75-.75V10.5a.75.75 0 01.75-.75h.008zm3.624 3.28a.75.75 0 00.275-1.025L13.15 12a.75.75 0 00-1.025-.275l-.006.004a.75.75 0 00-.275 1.024l.004.007a.75.75 0 001.024.274l.007-.003zm-1.38 5.126a.75.75 0 01-1.024-.274l-.004-.007a.75.75 0 01.275-1.024l.006-.004a.75.75 0 011.025.274l.004.007a.75.75 0 01-.275 1.024l-.006.004zm.282-6.776a.75.75 0 00-.274-1.025l-.007-.003a.75.75 0 00-1.024.274l-.004.007a.75.75 0 00.274 1.024l.007.004a.75.75 0 001.024-.274l.004-.007zm1.369 5.129a.75.75 0 01-1.025.274l-.006-.003a.75.75 0 01-.275-1.025l.004-.006a.75.75 0 011.025-.275l.006.004a.75.75 0 01.275 1.024l-.004.007zm-.145-1.502a.75.75 0 00.75-.75v-.007a.75.75 0 00-.75-.75h-.008a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008zm-3.75 2.243a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75h-.008a.75.75 0 01-.75-.75V18a.75.75 0 01.75-.75h.008zm-2.871-.47a.75.75 0 00.274-1.025l-.003-.006a.75.75 0 00-1.025-.275l-.006.004a.75.75 0 00-.275 1.025l.004.006a.75.75 0 001.024.274l.007-.003zm1.366-5.12a.75.75 0 01-1.025-.274l-.004-.006a.75.75 0 01.275-1.025l.006-.003a.75.75 0 011.025.274l.004.007a.75.75 0 01-.275 1.024l-.006.004zm.281 6.215a.75.75 0 00-.275-1.024l-.006-.004a.75.75 0 00-1.025.274l-.003.007a.75.75 0 00.274 1.024l.007.004a.75.75 0 001.024-.274l.004-.007zM6.655 12.76a.75.75 0 01-1.025.274l-.006-.003a.75.75 0 01-.275-1.025L5.353 12a.75.75 0 011.025-.275l.006.004a.75.75 0 01.275 1.024l-.004.007zm-1.15 2.248a.75.75 0 00.75-.75v-.007a.75.75 0 00-.75-.75h-.008a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008zM17.25 10.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm1.5 6a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" clip-rule="evenodd" />
                </svg>
                <span class="textSondage">Sondage</span>
        </nav>
       
@elseif (Request::is('loginchoice') || Request::is('login') || Request::is('forgot-password') || Request::is('register') || Request::is('password/reset'))
<nav id="navSansRien"> </nav>


   
@else 
        <nav>
            <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}" >
                <svg class="iconenav" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-17 h-17">
                    <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
                </svg>
                <span class="textNav">Emissions</span>
            </a>
            <a href="{{ route('vote') }}" class="{{ Request::is('stats')||Request::is('vote') ? 'active' : '' }}">
                <svg class="iconenav musika" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-17 h-17">
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


        @endif
        @yield('footer')
    </footer>
</body>
</html>
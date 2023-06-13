@extends('template')

@section('title')
<link rel="stylesheet" href="{{ asset('public/css/pageAccueil.css') }}">
@endsection

@section('header')

<a href="">
        <svg class="iconUser" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
        </svg>
</a>
@endsection
@section('contenu')

<div id = "pageAccueilAffichageEnLive">
<div class="rectangleEmission">
        <img class="imageEmission" src="{{ asset('storage/images/logoSaucisse9.svg') }}">
        <span class="nomEmission">Saucisse 9</span>
</div>



<div id="lecteurAudioPageAccueil">
    <audio id="lecteurAudioFinal" >
        <source src="{{ asset('storage/images/saucisse9Audio.mp3') }}" type="audio/mp3">
    </audio>
    

    <button id="boutonPlayPausePageAccueil" onclick="toggleAudio()">
      
    <div id="progressionPlayer">
    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
    <path fill-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" clip-rule="evenodd" />
  </svg>
</div>
    </button>

       <div id="barreProgression">
        <div id="tempsEcoulé"></div>
        <div id="barre">
            <div id="progression"></div>
        </div>
        <div id="tempsTotal">--:--</div>
    </div>
</div>
    <script>
        let audio = document.querySelector("#lecteurAudioFinal");
        let tempsEcoulé = document.querySelector("#tempsEcoulé");
        let tempsTotal = document.querySelector("#tempsTotal");

        // Mettre à jour la durée totale de l'audio
        audio.addEventListener("loadedmetadata", function() {
            let duration = formatTime(audio.duration);
            tempsTotal.textContent = duration;
        });

        // Mettre à jour le temps écoulé pendant la lecture
        audio.addEventListener("timeupdate", function() {
        let currentTime = formatTime(audio.currentTime);
         tempsEcoulé.textContent = currentTime;
 
});

        // Fonction pour formater le temps au format MM:SS
      function formatTime(time) {
    let hours = Math.floor(time / 3600);
    let minutes = Math.floor((time % 3600) / 60);
    let seconds = Math.floor(time % 60);
    return `${padZero(hours)}:${padZero(minutes)}:${padZero(seconds)}`;
}

        // Fonction pour ajouter un zéro devant les chiffres inférieurs à 10
        function padZero(number) {
            return number < 10 ? `0${number}` : number;
        }

        function toggleAudio() {
            console.log("toggleAudio")
            if (audio.paused) {
                audio.play();
                localStorage.setItem("audioState", "playing");
            } else {
                audio.pause();
                localStorage.setItem("audioState", "paused");
            }
        }
// Mettre à jour le temps écoulé pendant la lecture
        
    </script>
</div>
</div>

<div class="descriptionRediffusionEtEmission">
        <h1 id="rediffusions">Rediffusions</h1>
        <h3 id="nomEmissionAccueil">3ème Mi-Temps</h3>
</div>

<!-- slider emission 1 -->

<section id="slider">
     
        <input class="rectangleEmissionPetit" type="radio" name="slider" id="s1">
        <input class="rectangleEmissionPetit" type="radio" name="slider" id="s2">
        <input class="rectangleEmissionPetit" type="radio" name="slider" id="s3" checked>
        <input class="rectangleEmissionPetit" type="radio" name="slider" id="s4">
        <input class="rectangleEmissionPetit" type="radio" name="slider" id="s5">

        <label for="s1" id="slide1" class="rectangleEmissionPetit">
                <img class="imageEmissionPetit" src="{{ asset('storage/images/logo3MiTemps.svg') }}">
                <span class="dateEmissionPetit">14 mai 2023</span>
        </label>
        <label for="s2" id="slide2" class="rectangleEmissionPetit">
                <img class="imageEmissionPetit" src="{{ asset('storage/images/logo3MiTemps.svg') }}">
                <span class="dateEmissionPetit">12 mai 2023</span>
        </label>
        <label for="s3" id="slide3" class="rectangleEmissionPetit">
                <img class="imageEmissionPetit" src="{{ asset('storage/images/logo3MiTemps.svg') }}">
                <span class="dateEmissionPetit">9 mai 2023</span>
        </label>
        <label for="s4" id="slide4" class="rectangleEmissionPetit">
                <img class="imageEmissionPetit" src="{{ asset('storage/images/logo3MiTemps.svg') }}">
                <span class="dateEmissionPetit">6 mai 2023</span>
        </label>
        <label for="s5" id="slide5" class="rectangleEmissionPetit">
                <img class="imageEmissionPetit" src="{{ asset('storage/images/logo3MiTemps.svg') }}">
                <span class="dateEmissionPetit">2 mai 2023</span>
        </label>
       
</section>  

<div id="ajoutEspace"> </div>
<!-- 

  <div class="rectangleEmissionPetit">
        <img class="imageEmissionPetit" src="{{ asset('storage/images/logoBrasCasse.svg') }}">
        <span class="dateEmi<ssionPetit">14 mai 2023</span> -->


   








@endsection
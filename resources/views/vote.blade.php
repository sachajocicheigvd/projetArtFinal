@extends('template')

@section('title')
  <title>Vote</title>
  <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
@endsection

@section('header')
  <h1 class="page-header">Vote musique</h1>
  <h2 id="carousel-heading">{{$question}}</h2>
@endsection

@section('contenu')

<!-- Vérification côté serveur si jamais la personne a desactivé JavaScript -->
@if ($duree > 0)

<form method="post" action="{{route('vote')}}" accept-charset="UTF-8">
        @csrf
<!-- Réalisation de 3 champs de formulaires écrit -->
<!-- Question sur une durée type number -->
<p id="alert" style="display:none;">Pas de sondage disponible</p>
<div class="sondage">
<p id="duree" style="display:none;">{{$duree}}</p>

<div class="mkt-3dSlider py-6">
<section id="glisseur">
        <section class="splide" aria-labelledby="carousel-heading">
          
  <div class="splide__track">
  <ul class="splide__list">                              
                              
<div class="zoneradio">
{{$i = 1}}       
</div>    

<!-- Mise en boucle pour générer les réponses -->
 @foreach($reponses as $reponse)      

<li class="splide__slide" data-slideid="{{$i}}"><div class="txtimage"><p><strong>{{$reponse->answer}}</strong> @if($reponse->artist){{$reponse->artist}}</p></div> <img src="{{$reponse->picture}}" alt="{{$reponse->artist}}" width="200px"> @endif</li>

<div class="zoneradio">
{{$i = $i + 1}}
</div>
@endforeach

</ul>
</div>
</section>
</section>

<div class="zoneradio">
{{$i = 1}}
</div>

<div class ="zoneradio">

<!-- Mise en boucle pour générer les réponses -->
@foreach($reponses as $reponse)
 <label class="card-slider">{{$reponse->answer}} @if($reponse->artist)- {{$reponse->artist}} @endif
<input class="card-slider" data-radioid="{{$i}}" type="radio" name="answers[]" value="{{$reponse->id}}">
{{--  <img src="{{$reponse->picture}}" alt="{{$reponse->artist}}" width="200px">  
 --}}</label>  
<br>

<div class="zoneradio">
{{$i = $i + 1}}
</div>
@endforeach
</div>
</div>

<input type="submit" class="primaire valide" value="Valider">
</form> 


@else
<p>Pas de sondage disponible</p>
@endif

<script>

let splide = new Splide('.splide', {
   type   : 'loop',
  perPage: 3,
  perMove: 1,
});
splide.on('active', function () {

  // Obtenir les éléments du DOM
  let nextSlide = document.querySelector('.splide__slide.is-next');

  if (nextSlide) {
    let slideId = nextSlide.dataset.slideid;
    
    // Sélectionne le bouton radio correspondant à l'ID du slide.
    let radioBtn = document.querySelector('input[data-radioid="' + slideId + '"]');
    
    if (radioBtn) {
      // Coche le bouton radio.
      radioBtn.checked = true;
    }
  }
});

// Initialise le slider.
splide.mount();
</script>

<script>

  // Récupérer les éléments du DOM
  let chrono = document.querySelector("#duree").innerHTML;
  let sondageElement = document.querySelector(".sondage");
  let alert = document.querySelector("#alert");

  // Convertir la date
  let futureDate = new Date(chrono);

  // Mettre à jour l'affichage toutes les secondes
  setInterval(function () {

    let now = new Date();

    // Calculer la différence entre les deux dates
    let timeDiff = futureDate.getTime() - now.getTime();

    // Convertir la différence en secondes
    let secondsLeft = Math.floor(timeDiff / 1000);

    // Convertir les secondes en minutes et secondes
    let minutes = Math.floor(secondsLeft / 60);
    let seconds = secondsLeft % 60;

    // Si les secondes sont inférieures à 10, ajouter un 0
    seconds >= 10 ? seconds : (seconds = "0" + seconds);

    // Afficher le compte à rebours dans le DOM
    document.querySelector("#duree").innerHTML = `${minutes}:${seconds}`;

    // Si le compte à rebours est terminé rediriger vers la page des statistiques
    if (minutes < 0) {
        window.location.replace("/stats");
    }

    document.querySelector("#duree").style.display = "block";
}, 1000);
</script>
@endsection
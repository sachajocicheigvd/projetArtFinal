@extends('template')


@section('title')
<title>Vote</title>

<script src="{{ asset('resources/js/vote.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('resources/css/vote.css') }}">

@endsection

@section('header')
<h1 class="page-header"><a href="">Vote</a></h1>
@endsection

@section('contenu')
<link href="
https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css
" rel="stylesheet">
<script src="
https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js
"></script>

<!-- Vérification côté serveur si jamais la personne a desactivé JavaScript -->
@if ($duree > 0)

<form method="post" action="{{route('vote')}}" accept-charset="UTF-8">
        @csrf
<!-- Réalisation de 3 champs de formulaires écrit -->
<!-- Question sur une durée type number -->
<p id="alert" style="display:none;">Pas de sondage disponible</p>
<div class="sondage">
<p>Vote musique</p>
<p id="duree" style="display:none;">{{$duree}}</p>


<div class="mkt-3dSlider py-6">
<section id="slider">
        <section class="splide" aria-labelledby="carousel-heading">
                <h2 id="carousel-heading">{{$question}}</h2>
              
              
                <div class="splide__track">
                              <ul class="splide__list">
                                      
                                      
                              
<div class="zoneradio">
{{$i = 1}}       
</div>    
 @foreach($reponses as $reponse)      

<li class="splide__slide" data-slideid="{{$i}}"><div class="txtimage"> {{$reponse->answer}} @if($reponse->artist)- {{$reponse->artist}}</div> <img src="{{$reponse->picture}}" alt="{{$reponse->artist}}" width="200px">  @endif</li>

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

<input type="submit" class="primaire" value="Valider">
</form> 


@else
<p>Pas de sondage disponible</p>
@endif


<script>

var splide = new Splide('.splide', {
   type   : 'loop',
  perPage: 3,
  perMove: 1,
});
splide.on('active', function () {
  // Obtenez l'élément `.splide__slide` ayant la classe `.is-next`.
  var nextSlide = document.querySelector('.splide__slide.is-next');

  if (nextSlide) {
    // Obtenez la valeur de l'attribut `data-slideid` de l'élément `.splide__slide`.
    var slideId = nextSlide.dataset.slideid;
    
    // Sélectionnez le bouton radio correspondant à l'ID du slide.
    var radioBtn = document.querySelector('input[data-radioid="' + slideId + '"]');
    
    if (radioBtn) {
      // Cochez le bouton radio.
      radioBtn.checked = true;
    }
  }
});

splide.mount();
</script>
@endsection
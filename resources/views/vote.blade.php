@extends('template')


@section('title')
<title>Vote</title>

@vite('resources/js/sondage.js')
@endsection

@section('header')
<h1 class="page-header"><a href="">Vote</a></h1>
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
<p>Durée du sondage</p>
<p id="duree">{{$duree}}</p>

<p>{{$question}}</p>

@foreach($reponses as $reponse)
<label>{{$reponse->answer}}
<input type="radio" name="answers[]" value="{{$reponse->id}}">
</label>
<br>
@endforeach

<input type="submit" value="Valider">
</form>
</div>

@else
<p>Pas de sondage disponible</p>
@endif
<script>
        let chrono = document.querySelector("#duree").innerHTML;
        let sondageElement = document.querySelector(".sondage");
        let alert = document.querySelector("#alert");

        var futureDate = new Date(chrono);
// Mettre à jour l'affichage toutes les secondes
setInterval(function(){ // Remplacez par la date future souhaitée
var now = new Date();
var timeDiff = futureDate.getTime() - now.getTime();
  var secondsLeft = Math.floor(timeDiff / 1000);
  
  var minutes = Math.floor(secondsLeft / 60);
  var seconds = secondsLeft % 60;

  seconds >= 10 ? seconds : seconds = "0" + seconds;
  
  document.querySelector("#duree").innerHTML = `${minutes}:${seconds}`;


if (minutes<0) {
        sondageElement.style.display = "none";
        alert.style.display = "block";
}
}, 1000);

</script>
@endsection


@extends('template')

@section('title')
<title>Sondage</title>
@endsection

@section('header')
<h1 class="page-header">Vote musique</h1>

@endsection

@section('contenu')


<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<?php

use App\Models\Survey;
use App\Models\Answer;


    $createdTimestamp = strtotime($surveys[count($surveys)-1]->created_at);
    $tenDaysTimestamp = $createdTimestamp + (60 * 60 * 24 * 10);

    $latestSurvey = Survey::latest()->first();
    $answers = $latestSurvey->answers()->with('users')->get();
    $totalVotes = $answers->sum('users_count');
    $nbVote = 0;
    $totalResponses = 0;
    // récupère les images des réponses
    $images = [];

?>
@if(Auth::user()->admin == 0 && $surveys[count($surveys)-1]->type == "text")
<p>Page indisponible lors de sondage texte</p>
@else

<div class="span6">
<script>

if(duration>0){
document.querySelector("body > div.container > div.span6").innerHTML = `
    <h2>Vous avez voté pour</h2>
    @foreach($answers as $answer)
    @if($answer->survey_id == $surveys[count($surveys)-1]->id)
    @foreach($answer->users as $user)
    @if($user->id == Auth::user()->id)
    <img class="imgAuth" src="{{$answer->picture}}" alt="{{$answer->artist}}" width="200px">
    <p><strong>{{$answer->answer}}</strong></p>
    <p>{{$answer->artist}}</p>
    @endif
    @endforeach
    @endif
    @endforeach`;}
</script>

</div>
    <br><br>
  <!-- Chronomètre -->
  <div id="countdown" class="text-center" >
        <span id="days" class="display-4" style="display: none"></span>
        <span class="text-muted"  style="display: none"></span>
        <span class="text-muted " style="display: none">jours</span>
        <span id="hours" class="display-4" style="display: none"></span>
        <span class="text-muted" style="display: none">heures</span>
        <span id="minutes" class="display-4" style="color: white"></span>
        <span class="text-muted" style="color: white" style="color: white">:</span>
        <span id="seconds" class="display-4" style="color: white"></span>
        <span class="text-muted" style="display: none">secondes</span>
    </div>

    <div id="contentContainer" id="dataSondage">
{{--         <h5>{{$surveys[count($surveys)-1]->title}}</h5>
 --}} @foreach($answers as $answer)
 @if($answer->survey_id == $surveys[count($surveys)-1]->id)
    
 @endif
 @endforeach
 

</div>

@foreach ($answers as $answer)
    <ul>        
        @php
            $responseCount = $answer->users->count();
            $totalResponses += $responseCount;
            $percentage = $totalVotes > 0 ? number_format(($responseCount / $totalVotes) * 100, 2) : 0;
        @endphp

    </ul>

    @endforeach

    <div class="afficheSondage"></div>

<script> let i = 0;</script>
@foreach ($answers as $answer)
    <ul>
        @php
            $responseCount = $answer->users->count();
            $percentage = $totalVotes > 0 ? number_format(($responseCount / $totalVotes) * 100, 2) : 0;
        @endphp
<script>
       
       @if($totalResponses > 0)
  
@else
 
@endif

        i++;
       </script>
    </ul>
@endforeach
@endif
@endsection


<script>
        // Fonction pour démarrer le chronomètre
       // const duration = ((($surveys[count($surveys)-1]->duration) - ($surveys[count($surveys)-1]->created_at)) / 1000);

<?php



$createdTimestamp = $surveys[count($surveys)-1]->created_at;
////$durre = $surveys[count($surveys)-1]->duration;

$mnt = strtotime(now());

$difference = strtotime($createdTimestamp);
$duree = strtotime($surveys[count($surveys)-1]->duration);

$duree2 = ($duree) - ($difference) - ($mnt-$difference);

$durations = $duree2;
//echo "Durée en timestamp : " . $createdTimestamp;



?>

const duration = <?php echo $durations; ?>;
//console.log(duration);
     

let estTermine = false;

function startTimer(duration, display) {
            var timer = duration, days, hours, minutes, seconds;
            var interval = setInterval(function () {
                days = parseInt(timer / (60 * 60 * 24), 10);
                hours = parseInt((timer % (60 * 60 * 24)) / (60 * 60), 10);
                minutes = parseInt((timer % (60 * 60)) / 60, 10);
                seconds = parseInt(timer % 60, 10);
    
                days = days < 10 ? "0" + days : days;
                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
    
                display.querySelector('#days').textContent = days;
                display.querySelector('#hours').textContent = hours;
                display.querySelector('#minutes').textContent = minutes;
                display.querySelector('#seconds').textContent = seconds;
    
                if (--timer < 0) {
                    clearInterval(interval);
                    display.innerHTML = '<span style="color: green;">Résultat final du sondage</span>';
                }
            }, 1000);
        }
    

        // Démarrer le chronomètre au chargement de la page
        window.onload = function () {

            
            var createdTimestamp = <?php echo strtotime($surveys[count($surveys)-1]->created_at); ?>;
            //var tenDaysTimestamp = createdTimestamp + <?php echo ($surveys[count($surveys)-1]->duration); ?>; // Timestamp de 10 jours après la création du sondage (en secondes
            var currentTime = Math.floor(Date.now() / 1000); // Timestamp actuel en secondes
            //var duration = tenDaysTimestamp - currentTime;
            var display = document.querySelector('#countdown');
    
            duration = <?php echo $durations; ?>;
            startTimer(duration, display);
        };

//there


if (duration <= 0) {
        setInterval(function () {
            fetchSurveyResults();
        }, 1000);
    }

        function fetchSurveyResults() {
    // Effectuer une requête AJAX pour récupérer les résultats du sondage
    // Vous devrez peut-être ajouter du code ici pour mettre à jour les éléments HTML appropriés avec les nouvelles données

    // Exemple de requête AJAX avec jQuery
    $.ajax({
        url: '/api/survey-results', // Remplacez l'URL par l'endpoint approprié pour récupérer les résultats du sondage
        method: 'GET',
        success: function(response) {


            var arr = Object.values(response);

            // Tri de l'array par ordre du nombre de votes
            arr.sort(function(a, b) {
                return b.totalVotes - a.totalVotes;
            });

            var estTermine = true; // Mettez la valeur correcte ici

            // Raccourci le tableau au 3 premiers résultats si status = true seulement si le sondage est de type music (donc contient un artiste)
            if (estTermine == true && arr[0].artist != null) {
                arr = arr.slice(0, 3);
            }


            document.querySelector(".afficheSondage").innerHTML="";

            //calcul le total du nombre de answer
            var total = 0;
            let i = 0;
            arr.forEach(a => {
                total += a.totalVotes;
            });
            
            arr.forEach(a => {

                if (a.artist != null){
                
                document.querySelector(".afficheSondage").insertAdjacentHTML("beforeend", `
   <div class='uneElement' data-position=${i}>
    <img src="${a.image}" alt="image" width="130px" height="130px">
    <p class="answer rep${i}">${a.answer}</p>
    <p class="artist artiste${i}">${a.artist}</p>
    <p class=" percent pourcentage${i}">${isNaN(Math.round(a.totalVotes / total * 100)) ? 0 : Math.round(a.totalVotes / total * 100)}%</p>

    </div>
    `)
    i++

/*     <div class="progress progress active labar">
        <div class="bar" style="width: ${isNaN(Math.round(a.totalVotes / total * 100)) ? 0 : Math.round(a.totalVotes / total * 100)}%;"></div>
    </div> */
                }
                else {
                    document.querySelector(".afficheSondage").insertAdjacentHTML("beforeend", `
    <strong><p>${a.answer}</p></strong>
    <span class="pull-right pourcentage">${isNaN(Math.round(a.totalVotes / total * 100)) ? 0 : Math.round(a.totalVotes / total * 100)}%</span>
    <div class="progress progress active labar">
        <div class="bar" style="width: ${isNaN(Math.round(a.totalVotes / total * 100)) ? 0 : Math.round(a.totalVotes / total * 100)}%;"></div>
    </div>`)
        }                
    }
);

        },
        error: function(error) {
            console.error('Une erreur s\'est produite lors de la récupération des résultats du sondage:', error);
        }
    });



}
    </script>

<script>
        // Fonction pour démarrer le chronomètre
       // const duration = ((($surveys[count($surveys)-1]->duration) - ($surveys[count($surveys)-1]->created_at)) / 1000);

<?php



$createdTimestamp = $surveys[count($surveys)-1]->created_at;
////$durre = $surveys[count($surveys)-1]->duration;

$mnt = strtotime(now());

$difference = strtotime($createdTimestamp);
$duree = strtotime($surveys[count($surveys)-1]->duration);

$duree2 = ($duree) - ($difference) - ($mnt-$difference);

$durations = $duree2;
//echo "Durée en timestamp : " . $createdTimestamp;


?>





        function startTimer(duration, display) {
            var timer = duration, days, hours, minutes, seconds;
            var interval = setInterval(function () {
                days = parseInt(timer / (60 * 60 * 24), 10);
                hours = parseInt((timer % (60 * 60 * 24)) / (60 * 60), 10);
                minutes = parseInt((timer % (60 * 60)) / 60, 10);
                seconds = parseInt(timer % 60, 10);
    
                days = days < 10 ? "0" + days : days;
                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
    
                display.querySelector('#days').textContent = days;
                display.querySelector('#hours').textContent = hours;
                display.querySelector('#minutes').textContent = minutes;
                display.querySelector('#seconds').textContent = seconds;
    
                if (--timer < 0) {
                    clearInterval(interval);
                    display.innerHTML = '<span style="color: #27EB42;">Résultat final du sondage</span>';
                }
            }, 1000);
        }
    
        // Démarrer le chronomètre au chargement de la page
        window.onload = function () {
            var createdTimestamp = <?php echo strtotime($surveys[count($surveys)-1]->created_at); ?>;
            //var tenDaysTimestamp = createdTimestamp + <?php echo ($surveys[count($surveys)-1]->duration); ?>; // Timestamp de 10 jours après la création du sondage (en secondes
            var currentTime = Math.floor(Date.now() / 1000); // Timestamp actuel en secondes
            //var duration = tenDaysTimestamp - currentTime;
            var display = document.querySelector('#countdown');
    
            const duration = <?php echo $durations; ?>;
            startTimer(duration, display);
        };

    </script>



    

    <style>
   
    #countdown {
        background-color: #18181B !important;
        padding: 10px;
        border-radius: 4px;
    }

    #countdown .display-4 {
        color: #333;
        font-weight: bold;
    }

    #countdown .text-muted {
        color: #666;
    }
</style>
@extends('template')

@section('title')
<title>Sondage</title>
@endsection

@section('header')
<h1 class="page-header">après sondage</h1>

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

?>

<div class="span6">

    <br><br><br><br><br><br><br><br><br>

 <h3>{{$surveys[count($surveys)-1]->title}}</h3>


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

 @foreach($answers as $answer)
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


        setInterval(function () {
            fetchSurveyResults();
        }, 1000);

        function fetchSurveyResults() {
    // Effectuer une requête AJAX pour récupérer les résultats du sondage
    // Vous devrez peut-être ajouter du code ici pour mettre à jour les éléments HTML appropriés avec les nouvelles données

    // Exemple de requête AJAX avec jQuery
    $.ajax({
        url: '/api/survey-results', // Remplacez l'URL par l'endpoint approprié pour récupérer les résultats du sondage
        method: 'GET',
        success: function(response) {


            var arr = Object.values(response);


            document.querySelector(".afficheSondage").innerHTML="";

            //calcul le total du nombre de answer
            var total = 0;
            arr.forEach(a => {
                total += a.totalVotes;
            });
            
            arr.forEach(a => {

                document.querySelector(".afficheSondage").insertAdjacentHTML("beforeend", `

           
    <strong><p>${a.answer}</p></strong>

    <div class="progress" style="height: 40px;">
    <div class="progress-bar" "role="progressbar" style="width: ${isNaN(Math.round(a.totalVotes / total * 100)) ? 0 : Math.round(a.totalVotes / total * 100)}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">${isNaN(Math.round(a.totalVotes / total * 100)) ? 0 : Math.round(a.totalVotes / total * 100)}%</div>
  </div>
  
    
    `);


                
            });

            




        },
        error: function(error) {
            console.error('Une erreur s\'est produite lors de la récupération des résultats du sondage:', error);
        }
    });



}
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

    .progress-bar {
    width: 100%;
    height: 20px;
    background-color: #27EB42;
    color: white;
  }
</style>
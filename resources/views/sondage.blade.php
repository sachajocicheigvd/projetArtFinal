@extends('template')
<head>

</head>
@section('title')
<title>Sondage</title>
@endsection

@section('header')

<h1 class="page-header"><a href="">Sondage</a></h1>

@endsection

@section('contenu')
        <p>Vous êtes sur la page des sondages</p>
        {{-- <div id="app"></div> --}}
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

console.log('Durée en timestamp :  <?php echo $difference; ?>');
console.log('Durée en timestamp :  <?php echo $duree; ?>');

console.log('Durée en timestamp :  <?php echo $durations; ?>');




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
                    display.innerHTML = '<span style="color: red;">Résultat final du sondage</span>';
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
        background-color: #f2f2f2;
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
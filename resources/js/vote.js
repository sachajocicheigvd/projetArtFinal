let chrono = document.querySelector("#duree").innerHTML;
let sondageElement = document.querySelector(".sondage");
let alert = document.querySelector("#alert");

var futureDate = new Date(chrono);
// Mettre à jour l'affichage toutes les secondes
setInterval(function () {
    // Remplacez par la date future souhaitée
    var now = new Date();
    var timeDiff = futureDate.getTime() - now.getTime();
    var secondsLeft = Math.floor(timeDiff / 1000);

    var minutes = Math.floor(secondsLeft / 60);
    var seconds = secondsLeft % 60;

    seconds >= 10 ? seconds : (seconds = "0" + seconds);

    document.querySelector("#duree").innerHTML = `${minutes}:${seconds}`;

    if (minutes < 0) {
        sondageElement.style.display = "none";
        alert.style.display = "block";
    }

    document.querySelector("#duree").style.display = "block";
}, 1000);

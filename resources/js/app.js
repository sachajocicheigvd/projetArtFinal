import "./bootstrap";
import { createApp } from "vue";
import App from "./App.vue";
import ChatApp from "./ChatApp.vue";

let appup = null;
// Écoutez les événements sur la chaîne "popup-channel"
window.Echo.channel("popup-channel").listen("PopupEvent", () => {
    if (appup) {
        appup.unmount("#app"); // Démonter l'application si elle est déjà montée
    }
    appup = createApp(App);
    appup.mount("#app"); // Monter l'application
});
/*
PARTIE POPUP DANS LE CHAT
*/
const popupChat = async () => {
    const response = await fetch("/lastsondage");
    const sondage = await response.json();
    // mettre dans une variable la date actuelle
    let app = createApp(ChatApp);
    let duration = new Date(sondage.duration);
    let now = new Date();
    let type = sondage.type;
    //condition pour afficher le popup si la date actuelle est inférieur à la date de fin du sondage  et si le type est text
    if (duration > now && type == "text") {
        app.mount("#chatpopup");
    }
    //démonter l'application si la date actuelle est supérieur à la date de fin du sondage
    setInterval(function () {
        now = new Date();
        if (duration < now) {
            if (app.mounted) {
                app.unmount("#chatpopup"); // Démonter l'application si elle est déjà montée
            }
        }
    }, 1000);
    // Écoutez les événements sur la chaîne "chat-popup"
    window.Echo.channel("chat-popup").listen("ChatPopup", () => {
        if (app) {
            app.unmount("#chatpopup"); // Démonter l'application si elle est déjà montée
        }
        app.mount("#chatpopup"); // Monter l'application
    });
};

if (window.location.pathname == "/chat") {
    popupChat();
}
/*
PARTIE CHAT 
*/
//fonction pour envoyer un message
$(document).ready(function () {
    $(document).on("click", "#send_message", function (e) {
        e.preventDefault();

        let username = $("#username").val();
        let message = $("#message").val();
        //condition pour ne pas envoyé de message vide
        if (username == "" || message == "") {
            alert("Merci de ne pas envoyé de message vide");
            return false;
        }
        //envoie du message dans la database
        $.ajax({
            method: "post",
            url: "/send-message",
            data: { username: username, message: message },
            success: function (res) {
                //
            },
        });
    });
});
//fonction pour obtenir l'heure actuelle en format hh:mm
function getCurrentTime() {
    let now = new Date();
    let hours = now.getHours().toString().padStart(2, "0"); // Obtenir les heures et les formater
    let minutes = now.getMinutes().toString().padStart(2, "0"); // Obtenir les minutes et les formater
    return hours + ":" + minutes; // Retourner l'heure au format "hh:mm"
}
//récupère depuis la database les genres de musique de la personnes connecté
//en écoutant l'événement "message" sur la chaîne "chat"
window.Echo.channel("chat").listen(".message", (e) => {
    let username = $("#username").val();
    let currentTime = getCurrentTime();
    let message = e.message;
    let genres = e.genres;
    let txtGenres = "";
    //boucle pour afficher les genres de musique de la personne connecté
    for (let i = 0; i < genres.length && i < 3; i++) {
        txtGenres +=
            '<p class="musique ' +
            genres[i].name +
            ' genreMusiqueMessage"> <span>' +
            genres[i].name +
            "</span></p>";
    }

    let formattedMessage = "";
    //permet de mettre un saut de ligne tous les 20 caractères
    for (let i = 0; i < message.length; i += 23) {
        formattedMessage += message.substring(i, i + 20) + "<br>";
    }
    //messageHTML permet d'afficher le message de la personne connecté
    let messageHTML =
        '<div class="encadree monEncadree">' +
        '<p class="message ' +
        (e.username === username ? "moi" : "") +
        '">' +
        '<strong class="user">' +
        e.username +
        "</strong> " +
        formattedMessage +
        "</p>" +
        '<div id="genresUtilisateurs">' +
        txtGenres +
        "</div>" +
        '<p class="text-muted">' +
        "</p>" +
        '<strong id="minutesEnvoie">' +
        currentTime +
        "</strong>" +
        "</div>";
    //permet d'ajouter le message de la personne connecté dans la div #zonemess
    $("#zonemess > div:last-child").append(messageHTML);
    //permet de vider le champ message
    $("#message").val("");
    //permet de scroller automatiquement vers le bas de la page
    $("html, body").animate({ scrollTop: $(document).height() }, "slow");
});

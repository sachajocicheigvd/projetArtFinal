import "./bootstrap";
// // i want to import the others js files here
// import "./appsondage.js";
// // import "./bootstrap.js";
// import "./chatpopup.js";
// import "./monProfil";
// import "./player.js";
// import "./popup.js";
// import "./sondage.js";
// import "./vote.js";

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

// import ChatApp from "./ChatApp.vue";
// import "./bootstrap";

let app = null;

const popupChat = async () => {
    const response = await fetch("/lastsondage");
    const sondage = await response.json();
    // mettre dans une variable la date actuelle
    let app = createApp(ChatApp);
    let duration = new Date(sondage.duration);
    let now = new Date();

    if (duration > now) {
        // app = createApp(ChatApp);
        app.mount("#chatpopup");
    }
    setInterval(function () {
        now = new Date();
        if (duration < now) {
            if (app.mounted) {
                app.unmount("#chatpopup"); // Démonter l'application si elle est déjà montée
            }
        }
    }, 1000);

    window.Echo.channel("chat-popup").listen("ChatPopup", () => {
        // console.log("chat-popup");

        if (app) {
            console.log("a présnentntnrefndasjfdjf");
            app.unmount("#chatpopup"); // Démonter l'application si elle est déjà montée
        }
        console.log("chat-popup");
        // app = createApp(ChatApp);
        app.mount("#chatpopup"); // Monter l'application
    });
};

if (window.location.pathname == "/chat") {
    popupChat();
}

/*
FIN PARTIE POPUP DANS LE CHAT
*/

$(document).ready(function () {
    $(document).on("click", "#send_message", function (e) {
        e.preventDefault();

        let username = $("#username").val();
        let message = $("#message").val();

        if (username == "" || message == "") {
            alert("Merci de ne pas envoyé de message vide");
            return false;
        }

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

function getCurrentTime() {
    var now = new Date();
    var hours = now.getHours().toString().padStart(2, "0"); // Obtenir les heures et les formater
    var minutes = now.getMinutes().toString().padStart(2, "0"); // Obtenir les minutes et les formater

    return hours + ":" + minutes; // Retourner l'heure au format "hh:mm"
}
const lastMessage = document.querySelector(".message:last-child");

window.Echo.channel("chat").listen(".message", (e) => {
    let username = $("#username").val();
    let currentTime = getCurrentTime();
    let lastChild = document.querySelector("#zonemess > div:last-child");

    let message = e.message;
    let formattedMessage = "";
    for (let i = 0; i < message.length; i += 23) {
        formattedMessage += message.substring(i, i + 20) + "<br>";
    }

    let messageHTML =
        '<div class="encadree">' +
        '<p class="message ' +
        (e.username === username ? "moi" : "") +
        '">' +
        currentTime +
        '<strong class="user">' +
        e.username +
        "</strong> " +
        formattedMessage +
        "</p>" +
        '<p class="text-muted">' +
        "</p>" +
        "</div>";

    $("#zonemess > div:last-child").append(messageHTML);
    $("#message").val("");
    $("html, body").animate({ scrollTop: $(document).height() }, "slow");
});

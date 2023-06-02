import "./bootstrap";
import { createApp } from "vue";
import Popup from "./components/Popup.vue";

createApp(Popup).mount("#app");

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

window.Echo.channel("chat").listen(".message", (e) => {
    $("#messages").append(
        '<p class="moi"><strong>' +
            e.username +
            "</strong>" +
            ": " +
            e.message +
            "</p>" +
            '<p class="text-muted">' +
            getCurrentTime() +
            "</p>"
    );
    $("#message").val("");
});

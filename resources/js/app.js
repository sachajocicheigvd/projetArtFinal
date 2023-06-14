import "./bootstrap";

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

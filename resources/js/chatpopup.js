import { createApp } from "vue";
// import ChatApp from "./ChatApp.vue";
// import "./bootstrap";

(async () => {
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
})();

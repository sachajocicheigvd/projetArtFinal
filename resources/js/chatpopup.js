import { createApp } from "vue";
import ChatApp from "./ChatApp.vue";
import "./bootstrap";

let app = null;

window.Echo.channel("chat-popup").listen("ChatPopup", () => {
    // console.log("chat-popup");
    if (app) {
        app.unmount("#chatpopup"); // Démonter l'application si elle est déjà montée
    }

    app = createApp(ChatApp);
    app.mount("#chatpopup"); // Monter l'application
});

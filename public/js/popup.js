import { createApp } from "vue";
import App from "./App.vue";
import "./bootstrap";

let app = null;

// Écoutez les événements sur la chaîne "popup-channel"
window.Echo.channel("popup-channel").listen("PopupEvent", () => {
    if (app) {
        app.unmount("#app"); // Démonter l'application si elle est déjà montée
    }

    app = createApp(App);
    app.mount("#app"); // Monter l'application
});

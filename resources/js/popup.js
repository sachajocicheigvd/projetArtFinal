import { createApp } from "vue";
import App from "./App.vue";
import "./bootstrap";

const app = createApp(App);

// Écoutez les événements sur le canal "popup-channel"
window.Echo.channel("popup-channel").listen("PopupEvent", (data) => {
    app.mount("#app"); // Monter l'application
});

<template>
    <main>
        <h1>Vue popups</h1>
        <button @click="togglePopup('buttonTrigger')">Open Popup</button>
        <Popup
            v-if="popupTriggers.buttonTrigger"
            :togglePopup="() => togglePopup('buttonTrigger')"
        >
        </Popup>
    </main>
</template>

<script>
import { ref } from "vue";
import Popup from "./components/Popup.vue";
export default {
    setup() {
        const popupTriggers = ref({
            buttonTrigger: false,
            timerTrigger: false,
        });
        const togglePopup = (trigger) => {
            popupTriggers.value[trigger] = !popupTriggers.value[trigger];
        };
        return {
            popupTriggers,
            togglePopup,
        };
    },
    components: {
        Popup,
    },
};
</script>

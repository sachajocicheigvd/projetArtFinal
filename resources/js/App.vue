<template>
    <main>
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
//permet de trigger le popup
export default {
    setup() {
        const popupTriggers = ref({
            buttonTrigger: true,
            // timerTrigger: false,
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

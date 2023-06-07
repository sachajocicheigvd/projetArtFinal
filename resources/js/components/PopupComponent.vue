<template>
    <div class="popup-container" v-if="popupVisible">
        <div class="popup-content">
            <!-- Contenu du pop-up -->
            <h2>{{ title }}</h2>
            <p>{{ message }}</p>
            <button @click="closePopup">Fermer</button>
        </div>
    </div>
    <button @click="openPopup">Ouvrir le pop-up</button>
</template>

<script>
export default {
    data() {
        return {
            popupVisible: false,
            title: "Titre du pop-up",
            message: "Contenu du pop-up",
        };
    },
    methods: {
        openPopup() {
            this.popupVisible = true;
        },
        closePopup() {
            this.popupVisible = false;
        },
    },
};
</script>

<style scoped>
.popup-container {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.5);
}

.popup-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
}

button {
    margin-top: 10px;
}
</style>

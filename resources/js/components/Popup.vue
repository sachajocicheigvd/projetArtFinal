<template>
    <div class="popup">
        <div v-if="lastSurvey">
            <h2>{{ lastSurvey.title }}</h2>
            <p>{{ formattedDuration }}</p>
            <ul>
                <li v-for="(answer, index) in lastSurvey.answers" :key="index">
                    <p>{{ answer.answer }}</p>
                    <button @click="vote(answer.id)">Vote</button>
                </li>
            </ul>
        </div>
        <div class="popup-inner">
            <slot />
            <button class="popup-close" @click="togglePopup()">Fermer</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: ["togglePopup"],
    data() {
        return {
            lastSurvey: null,
            countdownInterval: null,
        };
    },
    async created() {
        await this.fetchLastSurvey();
    },
    computed: {
        formattedDuration() {
            if (this.lastSurvey && this.lastSurvey.duration) {
                const duration = this.lastSurvey.duration;
                const minutes = Math.floor(duration / 60);
                const seconds = duration % 60;
                return `${minutes}:${seconds.toString().padStart(2, "0")}`;
            }
            return "";
        },
    },
    methods: {
        vote(answer) {
            console.log(answer);
            // Logique pour enregistrer le vote dans la base de données
            axios
                .post("/vote", { answer: answer })
                .then((response) => {
                    // Réponse de succès, vous pouvez effectuer des actions supplémentaires si nécessaire
                    console.log(response.data);
                })
                .catch((error) => {
                    // Gestion des erreurs en cas de problème lors de l'enregistrement du vote
                    console.error(error);
                });

            // Fermer le popup en appelant la méthode togglePopup
            this.togglePopup();
        },
        async fetchLastSurvey() {
            try {
                const response = await fetch("/lastsondage");
                if (!response.ok) {
                    throw new Error(
                        "Erreur lors de la récupération du dernier sondage"
                    );
                }
                const data = await response.json();
                this.lastSurvey = data;
                console.log(this.lastSurvey);
                console.log(this.lastSurvey.answers[0]);
                this.startCountdown();
            } catch (error) {
                console.error(error);
                // Gérer l'erreur de récupération du dernier sondage ici
            }
        },
        startCountdown() {
            if (this.countdownInterval) {
                clearInterval(this.countdownInterval);
            }
            const durationInSeconds = this.lastSurvey.duration * 60;
            this.lastSurvey.duration = durationInSeconds;
            this.countdownInterval = setInterval(() => {
                if (this.lastSurvey.duration > 0) {
                    this.lastSurvey.duration--;
                    const minutes = Math.floor(this.lastSurvey.duration / 60);
                    const seconds = this.lastSurvey.duration % 60;
                    this.lastSurvey.formattedDuration = `${minutes}:${seconds
                        .toString()
                        .padStart(2, "0")}`;
                } else {
                    clearInterval(this.countdownInterval);
                }
            }, 1000);
        },
    },
    beforeUnmount() {
        if (this.countdownInterval) {
            clearInterval(this.countdownInterval);
        }
    },
};
</script>

<style lang="scss" scoped>
.popup {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 99;
    background-color: rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 500px; /* Ajustez la largeur selon vos besoins */
    height: 500px;
    .popup {
        background-color: #fff;
        padding: 32px;
    }
}
</style>

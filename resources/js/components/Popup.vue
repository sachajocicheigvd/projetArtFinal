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
            formattedDuration: "",
            showPopup: false,
        };
    },
    async created() {
        await this.fetchLastSurvey();
    },
    methods: {
        vote(answer) {
            console.log(answer);
            // Logique pour enregistrer le vote dans la base de données
            axios
                .post("/storevote", { answer: answer })
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

                // Comparer la date de fin du sondage avec la date actuelle
                const now = new Date();
                const endTime = new Date(this.lastSurvey.duration);

                if (endTime > now) {
                    const duration = Math.floor((endTime - now) / 1000); // Durée restante en secondes
                    this.startCountdown(duration); // Appel de la méthode startCountdown avec la durée restante
                } else {
                    // Le sondage est terminé
                    this.formattedDuration = "Sondage terminé";
                }
            } catch (error) {
                console.error(error);
                // Gérer l'erreur de récupération du dernier sondage ici
            }
        },
        startCountdown(duration) {
            if (this.countdownInterval) {
                clearInterval(this.countdownInterval);
            }

            this.countdownInterval = setInterval(() => {
                if (duration > 0) {
                    const minutes = Math.floor(duration / 60);
                    const seconds = duration % 60;
                    this.formattedDuration = `${minutes}:${seconds
                        .toString()
                        .padStart(2, "0")}`;
                    duration--;
                } else {
                    clearInterval(this.countdownInterval);
                    this.formattedDuration = "Sondage terminé";
                }
            }, 1000);
        },
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
    background-color: rgba(12, 189, 92, 0.2);
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

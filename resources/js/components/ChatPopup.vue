<template>
    <div class="popup">
        <div class="infos" v-if="lastSurvey && showSurveyInfo">
            <h1>ChatPopup</h1>
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
            <p v-show="showPopupMessage">
                Merci pour votre vote, retrouvez les résultats du sondage dans
                le chat!
            </p>
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
            showPopupMessage: false,
            showSurveyInfo: true,
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
                    this.showPopupMessage = true; // Afficher le message "Hola" dans le popup
                    this.showSurveyInfo = false; // Cacher la section "infos"
                })
                .catch((error) => {
                    // Gestion des erreurs en cas de problème lors de l'enregistrement du vote
                    console.error(error);
                });
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
    top: 50%; /* Aligner le haut du popup au milieu de la fenêtre */
    left: 50%; /* Aligner la gauche du popup au milieu de la fenêtre */
    transform: translate(
        -50%,
        -50%
    ); /* Déplacer le popup de moitié de sa largeur et de sa hauteur vers le haut et la gauche */
    z-index: 99;
    background-color: rgba(12, 189, 92, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 300px; /* Ajustez la largeur selon vos besoins */
    height: 300px;
}

// .popup * {
//     background-color: pink;
// }
</style>

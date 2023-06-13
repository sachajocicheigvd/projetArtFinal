<template>
    <div class="popup">
        <div class="infos" v-if="lastSurvey && showSurveyInfo">
            <div class="text">
                <h2>{{ lastSurvey.title }}</h2>
                <p>{{ formattedDuration }}</p>
            </div>
            <div v-for="(answer, index) in lastSurvey.answers" :key="index">
                <div class="answer">
                    <button
                        :class="{
                            secondaire: selectedAnswer !== answer.id,
                            primaire: selectedAnswer === answer.id,
                        }"
                        @click="toggleAnswer(answer.id)"
                    >
                        {{ answer.answer }}
                    </button>
                </div>
            </div>
            <div class="vote-button" v-if="selectedAnswer !== null">
                <button class="primaire" @click="vote(selectedAnswer)">
                    Vote
                </button>
            </div>
        </div>
        <div class="popup-inner">
            <p v-show="showPopupMessage">
                Merci pour votre vote, retrouvez les résultats du sondage dans
                le chat!
            </p>
            <button class="popup-close" @click="togglePopup()"></button>
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
            selectedAnswer: null,
        };
    },
    async created() {
        await this.fetchLastSurvey();
    },
    methods: {
        toggleAnswer(answerId) {
            if (this.selectedAnswer === answerId) {
                this.selectedAnswer = null;
            } else {
                this.selectedAnswer = answerId;
            }
        },
        vote(answer) {
            // Logique pour enregistrer le vote dans la base de données
            axios
                .post("/storevote", { answer: answer })
                .then((response) => {
                    // Réponse de succès, vous pouvez effectuer des actions supplémentaires si nécessaire
                    console.log(response.data);
                    this.showPopupMessage = true; //
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
                    this.showSurveyInfo = false;
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
                    this.showSurveyInfo = false;
                }
            }, 1000);
        },
    },
};
</script>

<style scoped>
.popup {
    position: fixed;
    top: 50%; /* Aligner le haut du popup au milieu de la fenêtre */
    left: 50%; /* Aligner la gauche du popup au milieu de la fenêtre */
    transform: translate(
        -50%,
        -50%
    ); /* Déplacer le popup de moitié de sa largeur et de sa hauteur vers le haut et la gauche */
    z-index: 99;
    background-color: rgb(42, 42, 47);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 307px;
    height: 471px;
    border-radius: 40px;
}
.popup *:not(.primaire) {
    background-color: rgb(42, 42, 47);
}

.popup-close {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 30px;
    height: 30px;
    background-color: transparent;
    border: none;
    outline: none;
}

.popup-close::before,
.popup-close::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 2px;
    background-color: #fff; /* Remplacez #fff par la couleur blanche souhaitée */
    transform: translate(-50%, -50%) rotate(45deg);
}
/* center text */
.text {
    text-align: center;
    margin-top: 10;
}
.popup-close::after {
    transform: translate(-50%, -50%) rotate(-45deg);
}
</style>

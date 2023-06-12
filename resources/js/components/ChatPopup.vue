<template>
    <div class="popup">
        <ul>
            <li v-for="item in lastSurvey" :key="item.answer">
                <strong
                    ><p>{{ item.answer }}</p></strong
                >
                <span class="pull-right pourcentage"
                    >{{
                        isNaN(Math.round((item.totalVotes / total) * 100))
                            ? 0
                            : Math.round((item.totalVotes / total) * 100)
                    }}%</span
                >
                <div class="progress progress active labar">
                    <div
                        class="bar"
                        style="width: {{ isNaN(Math.round(item.totalVotes / total * 100)) ? 0 : Math.round(item.totalVotes / total * 100) }}%;"
                    ></div>
                </div>
            </li>
        </ul>
        <div class="popup-inner">
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
            total: 0, // Ajoutez la variable total ici
            showPopupMessage: false,
            showSurveyInfo: true,
        };
    },
    async created() {
        await this.fetchLastAnswer();
    },
    mounted() {
        setInterval(this.fetchLastAnswer, 1000); // Actualisation toutes les secondes
    },
    methods: {
        async fetchLastAnswer() {
            try {
                const response = await fetch("/api/survey-results");
                if (!response.ok) {
                    throw new Error(
                        "Erreur lors de la récupération du dernier sondage"
                    );
                }
                const data = await response.json();
                this.lastSurvey = data;
                // Calculer la valeur de total
                this.total = this.lastSurvey.reduce(
                    (sum, item) => sum + item.totalVotes,
                    0
                );
            } catch (error) {
                console.error(error);
                // Gérer l'erreur de récupération du dernier sondage ici
            }
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

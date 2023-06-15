<template>
    <div class="popup">
        <div id="title">
            <h2 v-if="dataT">{{ dataT.title }}</h2>
        </div>

        <div v-for="item in lastSurvey" :key="item.answer" class="survey-item">
            <div class="progress-bar">
                <span class="progress-bar-text">
                    <span class="left-text">{{ item.answer }}</span>
                    <span class="right-text">{{
                        getPercentage(item.totalVotes)
                    }}</span>
                </span>
                <div
                    class="progress-bar-inner"
                    :style="{ width: getPercentage(item.totalVotes) }"
                ></div>
            </div>
        </div>
        <div class="popup-inner">
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
            total: 0, // Ajoutez la variable total ici
            showPopupMessage: false,
            showSurveyInfo: true,
            dataT: null,
        };
    },
    async created() {
        await this.fetchLastAnswer();
    },
    mounted() {
        setInterval(this.fetchLastAnswer, 1000); // Actualisation toutes les secondes
    },
    methods: {
        getPercentage(totalVotes) {
            if (totalVotes === 0) return "0%";
            const percentage = (totalVotes / this.total) * 100;
            return `${percentage}%`;
        },
        async fetchLastAnswer() {
            try {
                const response = await fetch("/api/survey-results");
                const reponseTitle = await fetch("/lastsondage");
                if (!response.ok || !reponseTitle.ok) {
                    throw new Error(
                        "Erreur lors de la récupération du dernier sondage"
                    );
                }
                const dataTitle = await reponseTitle.json();

                this.dataT = dataTitle;
                console.log(this.dataT.title);
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
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 99;
    background-color: rgba(42, 42, 47);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 307px;
    height: 149px;
    border-radius: 40px;
    flex-wrap: wrap;
}

.popup * {
    background-color: rgb(42, 42, 47);
}

#title {
    position: absolute;
    top: 0;
    margin-top: 0%;
    height: 27.2px;
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
    background-color: #fff;
    transform: translate(-50%, -50%) rotate(45deg);
}

.popup-close::after {
    transform: translate(-50%, -50%) rotate(-45deg);
}

.progress-bar {
    width: 202px;
    height: 29px;
    background: #18181b;
    border-radius: 40px;
    position: relative;
    margin-top: 20%;
}

.progress-bar-inner {
    height: 100%;
    background: var(--secondaire-color);
    border-radius: 40px;
    position: absolute;
    top: 0;
    left: 0;
}

.progress-bar-text {
    position: relative;
    color: #fff;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    width: 100%;
    align-items: center;
    z-index: 2;
    background-color: transparent;
    height: 100%;
}
// reduce the space beteween 2 progress bar
.survey-item {
    margin-bottom: 5%;
}
.left-text {
    text-align: left;
    margin-left: 5%;
    background-color: transparent;
}

.right-text {
    text-align: right;
    margin-right: 5%;
    background-color: transparent;
}
</style>

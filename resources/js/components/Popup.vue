<script setup>
import { ref } from "vue";

// Fetch lastSurvey from Route lastSondage
const lastSurvey = ref(null);
async function fetchLastSurvey() {
    try {
        const response = await fetch("/lastsondage");
        if (!response.ok) {
            throw new Error(
                "Erreur lors de la récupération du dernier sondage"
            );
        }
        const data = await response.json();
        lastSurvey.value = data;
        console.log(lastSurvey.value);
    } catch (error) {
        console.error(error);
        // Gérer l'erreur de récupération du dernier sondage ici
    }
}
fetchLastSurvey();
</script>
<template>
    <h2>Hello vue</h2>
    <div>
        <!-- Affichage des données du dernier sondage -->
        <div v-if="lastSurvey">
            <h2>{{ lastSurvey.title }}</h2>
            <p>{{ lastSurvey.duration }}</p>
            <!-- ... Affichez d'autres propriétés du dernier sondage ... -->
        </div>
    </div>
</template>

<style></style>

<script setup>
const title = defineProps(["titre", "sousTitre"]);
</script>

<template>{{ title.titre }} {{ title.sousTitre }}</template>

<style scoped></style>

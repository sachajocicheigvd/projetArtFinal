<script setup>
const test = defineProps(["x", "y"]);
</script>

<template>{{ test.x }} {{ test.y }}</template>

<style scoped></style>

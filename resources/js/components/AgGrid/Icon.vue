<template>
    <v-btn :color="color" :icon="params.icon" size="x-small"></v-btn>
</template>
<script lang="ts" setup>
const { params } = defineProps(['params'])
const color = params.color == null ? 'teal' : params.color
</script>
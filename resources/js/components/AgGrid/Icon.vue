<template>
    <v-btn color="teal" :icon="params.icon" size="x-small"></v-btn>
</template>
<script lang="ts" setup>
const { params } = defineProps(['params'])
</script>
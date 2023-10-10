<template>
    <div class="d-flex item-center">
        <v-btn tag="a" :href="`/files/${icon.src}`" target="_blank" v-for="icon in params.value" color="teal" icon="mdi-file-pdf-box" class="mr-1" size="small"></v-btn>
    </div>
</template>
<script setup lang="ts">
const { params } = defineProps(['params'])
</script>
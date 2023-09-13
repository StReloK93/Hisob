<template>
    <main class="relative">
        <v-switch v-model="swith" hide-details="auto" color="teal"></v-switch>
        <div class="absolute front-block"></div>
    </main>
</template>

<script setup lang="ts">
import { ref } from 'vue'
const { params } = defineProps(['params'])
const swith = ref(false)
swith.value = Boolean(params.value)
</script>
<style scoped>
.relative{
    position: relative;
}
.absolute{
    position: absolute;
}
.front-block{
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
}
</style>
<template>
    <main class="relative d-flex align-center">
        <span v-if="params.color == 'red'">
            {{ params.data.expiration_date }}
        </span>
        <span v-else-if="params.color == 'blue'">
            {{ params.data.date_write_off }}
        </span>
        <span v-else>
            {{ params.data.date_of_receipt }}
        </span>
        <v-checkbox v-model="swith" :color="params.color ? params.color: 'teal'" hide-details />
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
.front-block{
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
}
</style>
<template>
    <v-btn :color="color" :icon="params.icon" size="x-small"></v-btn>
</template>
<script lang="ts" setup>
import { computed } from 'vue';

const { params } = defineProps(['params'])

const color = computed(() => {
    if(params.data.toggle_write_off) return 'grey'
    return params.color == null ? 'teal' : params.color
})

</script>
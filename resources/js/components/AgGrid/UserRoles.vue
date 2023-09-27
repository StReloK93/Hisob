<template>
    <main>
        <v-chip v-for="item in params.value" size="small" label :key="item" class="mx-1">
            {{ item.role.name }}
        </v-chip>
    </main>
</template>

<script setup lang="ts">
const { params } = defineProps(['params'])
</script>
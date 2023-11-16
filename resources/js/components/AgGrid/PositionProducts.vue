<template>
    <main>
        <v-chip v-for="item in params.data.products" size="small" label :key="item" class="mr-1">
            {{ item.product?.name }} <span class="text-teal pl-2">x{{ item?.count }}</span>
        </v-chip>
    </main>
</template>

<script setup lang="ts">
const { params } = defineProps(['params'])
</script>
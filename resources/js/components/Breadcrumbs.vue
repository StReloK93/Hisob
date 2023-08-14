<template>
    <v-breadcrumbs divider="-" :items="routes" tag="route-link"></v-breadcrumbs>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import { useRoute } from 'vue-router'
const { user } = defineProps(['user'])

const route:any = useRoute()

console.log(route.meta.breadcrumbs)

const routes:any = reactive([...route.meta.breadcrumbs])

if(user) routes.push({ title: user.name, disabled: true })

</script>
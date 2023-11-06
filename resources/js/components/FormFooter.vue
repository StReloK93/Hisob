<template>
    <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue-gray-1" type="button" @click="$emit('close')">
            Yopish
        </v-btn>
        <v-btn type="submit" :loading="pageData?.formLoading">
            Saqlash
        </v-btn>
    </v-card-actions>
</template>

<script lang="ts" setup>
const { pageData } = defineProps(['pageData'])
</script>

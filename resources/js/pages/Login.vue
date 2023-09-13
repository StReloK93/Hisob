<template>
    <v-app>
        <v-card tag="form" @submit.prevent="login" width="600">
            <v-text-field label="Label" variant="underlined" v-model="formData.login" required></v-text-field>
            <v-text-field label="Label" variant="underlined" type="password" v-model="formData.password" required></v-text-field>
            <v-btn type="submit">
            Kirish
            </v-btn>
        </v-card>
    </v-app>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/store/useAuthStore'
import { reactive } from 'vue';

const store = useAuthStore()


const formData = reactive({
    login: null,
    password: null,
})

function login(){
    store.login(formData)
}

</script>

<style scoped>

</style>
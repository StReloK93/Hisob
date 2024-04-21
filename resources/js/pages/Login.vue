<template>
    <v-app class="bg-grey-lighten-5">
        <v-main class="d-flex align-center">
            <v-sheet width="400" class="mx-auto elevation-10  py-4 rounded">
                <v-tabs
                    v-model="pageData.tab"
                    color="teal"
                    align-tabs="center"
                >
                    <v-tab :value="1">Kirish</v-tab>
                    <v-tab :value="2">Ro'yhatdan o'tish</v-tab>
                </v-tabs>
                <v-window class="px-4" v-model="pageData.tab">

                    <v-window-item :value="1">
                        <v-container tag="form" @submit.prevent="login" fluid>
                            <p class="text-center text-caption text-red-darken-1" v-if="pageData.errorLogin">
                                {{ pageData.errorLogin.message }}
                            </p>
                            <v-text-field class="mb-4" label="Login" v-model="LoginData.login" required></v-text-field>
                            <v-text-field class="mb-4" label="Parol" type="password" v-model="LoginData.password" required></v-text-field>
                            <v-btn type="submit" class="w-100">
                                Kirish
                            </v-btn>
                        </v-container>
                    </v-window-item>

                    <v-window-item :value="2">
                        <v-container tag="form" @submit.prevent="register" fluid>
                            <p class="text-center text-caption text-red-darken-1" v-if="pageData.errorRegister">
                                {{ pageData.errorRegister.message }}
                            </p>
                            <v-text-field class="mb-4" label="F.I.SH" v-model="RegisterData.name" required></v-text-field>
                            <v-text-field class="mb-4" label="Login" v-model="RegisterData.login" required></v-text-field>
                            <v-text-field class="mb-4" label="Parol" type="password" v-model="RegisterData.password" required></v-text-field>
                            <v-text-field class="mb-4" label="Parolni takrorlang" type="password" v-model="RegisterData.password_confirmation" required></v-text-field>
                            <v-btn type="submit" class="w-100">
                                Ro'yhatdan o'tish
                            </v-btn>
                        </v-container>
                    </v-window-item>
                </v-window>
            </v-sheet>
        </v-main>
    </v-app>
</template>

<script setup lang="ts">
import { auth } from '@/store/auth'
import { reactive } from 'vue'

const store = auth()
const pageData = reactive({
    errorLogin: null,
    errorRegister: null,
    tab: 1
})

const LoginData = reactive({
    login: null,
    password: null,
})


const RegisterData = reactive({
    name: null,
    login: null,
    password: null,
    password_confirmation: null,
})


function login(){
    store.login(LoginData).then((data) => {
        pageData.errorLogin = data
        setTimeout(() => pageData.errorLogin = null, 5000)
    })
}

function register(){
    store.register(RegisterData).then((data) => {
        pageData.errorRegister = data
        setTimeout(() => pageData.errorRegister = null, 5000)
    })
}

</script>
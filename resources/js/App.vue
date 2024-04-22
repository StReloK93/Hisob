<template>
    <main v-if="print.employe && print.employeProducts && print.position" class="position-top-left print-hidden">
        <FrontPage />
        <BackPage />
    </main>
    <router-view class="print-none"></router-view>
</template>
<script setup lang="ts">
import FrontPage from './components/FrontPagePrint.vue'
import BackPage from './components/BackPagePrint.vue'
import { printStore } from './store/auth'
import { useLocale } from 'vuetify'
const print = printStore()
const { current } = useLocale()

if (localStorage.getItem('locale') == null) localStorage.setItem('locale', 'uz')
current.value = localStorage.getItem('locale')
</script>
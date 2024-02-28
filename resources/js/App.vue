<template>
    <main v-if="print.employe && print.employeProducts" class="position-top-left print-hidden">
        <FrontPage />
        <BackPage />
    </main>
    <router-view class="print-none"></router-view>
</template>
<script setup lang="ts">
import FrontPage from './components/FrontPagePrint.vue'
import BackPage from './components/BackPagePrint.vue'
import { printStore } from './store/useAuthStore'

const print = printStore()

</script>
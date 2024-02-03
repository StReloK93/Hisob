<template>
    <section>
        <v-btn tag="a" href="/employe/export" color="success" target="_blank">
            Hisobotni yuklash
        </v-btn>
    </section>
</template>

<script setup lang="ts">
import axios from '@/modules/axios'

function get() {
    axios.get('employe/export')
}
</script>
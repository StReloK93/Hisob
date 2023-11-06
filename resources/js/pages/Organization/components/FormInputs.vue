<template>
    <v-row>
        <v-col cols="12" class="pt-0">
            <v-text-field class="mb-2" label="Nomi" v-model="formData.name" :rules="rules" />
            <v-text-field class="mb-2" label="Qisqa nomi" v-model="formData.short_name" :rules="rules" />
            <v-switch class="mb-2" label="Faolligi" v-model="formData.isActive" />
        </v-col>
    </v-row>
</template>

<script setup lang="ts">
const { formData } = defineProps(['formData'])
import { rules } from '@/modules/helpers'
</script>
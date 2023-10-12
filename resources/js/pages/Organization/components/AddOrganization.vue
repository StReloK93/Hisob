<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
            </template>
            <v-card tag="form" class="bg-white" @submit.prevent="addOrganization">
                <v-card-title> Bo'linma kiritish </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" class="pt-0">
                                <v-text-field class="mb-2" label="Nomi" v-model="formData.name" required/>
                                <v-text-field class="mb-2" label="Qisqa nomi" v-model="formData.short_name" required/>
                                <v-switch class="mb-2" label="Faolligi"  v-model="formData.isActive"/>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <FormFooter @close="pageData.dialog = false"/>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script setup lang="ts">
import { reactive, watch } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['addOrganization'])
const pageData = reactive({ dialog: false })

const formData = reactive({
    name: null,
    short_name: [],
    isActive: true,
})

function addOrganization() {
    axios.post('organization', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addOrganization', data)
    })
}

watch(() => pageData.dialog, (current) => {
    if (current) {
        formData.name = null
        formData.short_name = null
        formData.isActive = true
    }
})
</script>
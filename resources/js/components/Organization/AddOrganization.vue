<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
            </template>
            <v-card tag="form" class="bg-white" @submit.prevent="addOrganization">
                <v-card-title class="bg-blue-grey-lighten-5">
                    <span>Bo'linma kiritish formasi</span>
                </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" class="pt-0">
                                <v-text-field
                                    color="teal"
                                    label="Nomi"
                                    variant="underlined"
                                    hide-details="auto"
                                    v-model="formData.name"
                                    required>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-text-field
                                    color="teal"
                                    label="Qisqa nomi"
                                    variant="underlined"
                                    hide-details="auto"
                                    v-model="formData.short_name"
                                    required>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-switch label="Faolligi"  v-model="formData.isActive" hide-details="auto" color="teal"></v-switch>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue-gray-1" variant="text" type="button" @click="pageData.dialog = false">
                        Yopish
                    </v-btn>
                    <v-btn color="blue-darken-1" variant="text" type="submit">
                        Saqlash
                    </v-btn>
                </v-card-actions>
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
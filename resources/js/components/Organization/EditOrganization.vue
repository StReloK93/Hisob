<template>
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <v-card tag="form" class="bg-white" @submit.prevent="editOrganization">
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
</template>

<script setup lang="ts">
import { reactive, watch } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['editOrganization'])
const { current } = defineProps(['current'])
const pageData = reactive({ dialog: false })

const formData = reactive({
    name: null,
    short_name: null,
    isActive: true,
})

function editOrganization() {
    axios.patch(`organization/${current.selected}`, formData).then(({ data }) => {
        pageData.dialog = false
        emit('editOrganization', data)
    })
}



function getSelectedOrganization(id){
    axios.get(`organization/${id}`).then(({data}) =>{
        formData.name = data.name
        formData.short_name = data.short_name
        formData.isActive = Boolean(data.isActive)
    })
}

function clear(){
    formData.name = null
    formData.short_name = null
    formData.isActive = true
}

watch(() => pageData.dialog, (dialog) => {
    if (dialog) getSelectedOrganization(current.selected)
    else clear()
})

const toggle = () => pageData.dialog = true
defineExpose({toggle})
</script>
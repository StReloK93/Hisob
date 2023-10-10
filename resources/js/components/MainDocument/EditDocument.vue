<template>
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <v-form ref="formTag" @submit.prevent="editDocument">
            <v-card class="bg-white">
                <v-card-title class="bg-blue-grey-lighten-5">
                    <span>Normaviy hujjat tahrirlash formasi</span>
                </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" class="pt-0">
                                <v-textarea color="teal" label="Nomi" variant="underlined" hide-details="auto"
                                    v-model="formData.name" :rules="pageData.rules" />
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-text-field color="teal" label="Hujjat tasdiqlangan sana" variant="underlined"
                                    hide-details="auto" v-model="formData.confirm_date" type="date"
                                    :rules="pageData.rules"></v-text-field>
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-file-input
                                    chips
                                    variant="underlined"
                                    v-model="formData.files"
                                    hide-details="auto"
                                    item-value="src"
                                    multiple
                                    label="Normaviy hujjatlar"
                                />
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-textarea color="teal" label="Izoh" variant="underlined" hide-details="auto"
                                    v-model="formData.description" />
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
        </v-form>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive, watch, ref } from 'vue'
import axios from '@/modules/axios'
const { current } = defineProps(['current'])
const emit = defineEmits(['editDocument'])
const pageData = reactive({
    dialog: false,
    rules: [(value) => [null, ""].includes(value) ? 'toldiring' : true]
})

const formData = reactive({
    name: null,
    confirm_date: null,
    description: null,
    files: []
})

const formTag = ref()
async function editDocument() {
    const { valid } = await formTag.value.validate()
    if (valid == false) return

    const Form = new FormData()
    Form.append('name', formData.name)
    Form.append('confirm_date', formData.confirm_date)
    Form.append('description', formData.description == null? "" : formData.description)
    formData.files.forEach(file => {
        if(file.type) Form.append('files[]', file)
        else Form.append('files[]', file.id)
    })
    console.log(current)
    
    axios.post(`document/${current.selected}`, Form).then(({ data }) => {
        pageData.dialog = false
        emit('editDocument', data)
    })
}

function getSelectedDocument(current){
    axios.get(`/document/${current}`).then(({ data }) => {
        formData.name = data.name
        formData.confirm_date = data.confirm_date
        formData.description = data.description

        data.files.forEach((file) => file.name = file.src)
        formData.files = data.files
    })
}

watch(() => pageData.dialog, (dialog) => {
    if (dialog) getSelectedDocument(current.selected)
    else formTag.value.reset()
})

const toggle = () => pageData.dialog = true
defineExpose({toggle})
</script>
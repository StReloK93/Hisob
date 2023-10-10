<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
            </template>
            <v-form ref="formTag" @submit.prevent="addDocument" @vnode-mounted="formTag.reset()">                
                <v-card class="bg-white">
                    <v-card-title class="bg-blue-grey-lighten-5">
                        <span>Normaviy hujjat kiritish formasi</span>
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
                                    <v-file-input chips variant="underlined" v-model="formData.files" hide-details="auto" multiple
                                        label="Normaviy hujjatlar" :rules="pageData.rules"></v-file-input>
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
    </v-row>
</template>

<script setup lang="ts">
import { reactive, ref } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['addDocument'])
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

async function addDocument() {
    const { valid } = await formTag.value.validate()
    if (valid == false) return

    const Form = new FormData()
    Form.append('name', formData.name)
    Form.append('confirm_date', formData.confirm_date)
    Form.append('description', formData.description == null? "" : formData.description)
    formData.files.forEach(file => Form.append('files[]', file))

    
    console.log(Form)

    axios.post('document', Form).then(({ data }) => {
        pageData.dialog = false
        emit('addDocument', data)
    })
}
</script>
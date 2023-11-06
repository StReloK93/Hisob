<template>
    <v-row justify="end" class="ma-0 pb-2 px-4">
        <v-dialog v-model="pageData.dialog" scrollable persistent width="992">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" v-bind="props"></v-btn>
            </template>
            <CustomForm
                :submitMethod="addDocument" 
                @close="pageData.dialog = false"
                title="Normaviy hujjat kiritish"
                height="700px"
                @vue:mounted="formTagMounted">
                <FormInputs :formData="formData"/>
            </CustomForm>
        </v-dialog>
    </v-row>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import FormInputs from './FormInputs.vue'
import axios from '@/modules/axios'
const emit = defineEmits(['addDocument'])
const pageData = reactive({dialog: false})

const formData = reactive({
    name: null,
    confirm_date: null,
    description: null,
    files: [],
    positionTypes: [{ name: "", code: "" }],
})

async function addDocument() {
    const Form = new FormData()
    Form.append('name', formData.name)
    Form.append('confirm_date', formData.confirm_date)
    Form.append('description', formData.description == null ? "" : formData.description)
    formData.files.forEach(file => Form.append('files[]', file))
    formData.positionTypes.forEach(type => Form.append('positionTypes[]', JSON.stringify(type)))

    const { data }  = await axios.post('document', Form)
    pageData.dialog = false
    emit('addDocument', data)
}

function formTagMounted(){
    formData.positionTypes = [{ name: "", code: "" }]
}
</script>
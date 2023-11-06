<template>
    <v-dialog v-model="pageData.dialog" scrollable width="992" location="right">
        <CustomForm
            :submitMethod="editDocument" 
            @close="pageData.dialog = false"
            title="Normaviy hujjat kiritish"
            height="700px"
            @vue:mounted="getSelectedDocument(current.selected)"
            >
            <FormInputs :formData="formData"/>
        </CustomForm>
    </v-dialog>
</template>

<script setup lang="ts">
import FormInputs from './FormInputs.vue'
import axios from '@/modules/axios'
import { reactive } from 'vue'
const { current } = defineProps(['current'])
const emit = defineEmits(['editDocument'])
const pageData = reactive({dialog: false})

const formData = reactive({
    name: null,
    confirm_date: null,
    description: null,
    positionTypes: [],
    files: []
})

async function editDocument() {
    const Form = new FormData()
    Form.append('name', formData.name)
    Form.append('confirm_date', formData.confirm_date)
    Form.append('description', formData.description == null ? "" : formData.description)
    formData.positionTypes.forEach(type => Form.append('positionTypes[]', JSON.stringify(type)))

    formData.files.forEach(file => {
        if (file.type) Form.append('files[]', file)
        else Form.append('files[]', file.id)
    })

    await axios.post(`document/${current.selected}`, Form).then(({ data }) => {
        console.log(pageData.dialog, 'dialog')
        
        pageData.dialog = false
        emit('editDocument', data)
    })
}

function getSelectedDocument(current) {
    axios.get(`/document/${current}`).then(({ data }) => {
        formData.name = data.name
        formData.confirm_date = data.confirm_date
        formData.description = data.description
        formData.positionTypes = data.position_types

        data.files.forEach((file) => file.name = file.src)
        formData.files = data.files
    })
}

const toggle = () => pageData.dialog = true
defineExpose({ toggle })
</script>
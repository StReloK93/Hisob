<template>
    <v-dialog v-model="pageData.dialog" scrollable width="992" location="right">
        <CustomForm :submitMethod="editPosition" @close="pageData.dialog = false" title="Lavozim kiritish" height="600px">
            <FormInputs :formData="formData" :pageData="pageData" />
        </CustomForm>
    </v-dialog>
</template>

<script setup lang="ts">
import FormInputs from './FormInputs.vue';
import { reactive, watch } from 'vue'
import axios from '@/modules/axios'
const { current } = defineProps(['current'])
const emit = defineEmits(['editPosition'])
const pageData = reactive({
    dialog: false,
    products: null,
    position_types: null,
    working_conditions: null,
    main_documents: null,
})

const formData = reactive({
    name: null,
    products: [],
    isActive: true,
    main_document_id: null,
    number_in_document: null,
    position_type_id: null,
})



async function editPosition() {
    await axios.patch(`position/${current.selected}`, formData).then(({ data }) => {
        pageData.dialog = false
        emit('editPosition', data)
    })
}

function getSelectedEmploye(id) {
    axios.get(`position/${id}`).then(({ data }) => {
        formData.main_document_id = data.main_document_id
        formData.number_in_document = data.number_in_document
        formData.position_type_id = data.position_type_id
        formData.name = data.name
        formData.products = data.products.map((item) => {
            return {
                ...item.product,
                count: item.count,
                expiration_date: item.expiration_date,
                working_condition_id: item.working_condition_id,
            }
        })
        formData.isActive = Boolean(data.isActive)
    })
}

axios.get('product').then(({ data }) => {
    pageData.products = data.map((item) => {
        return {
            ...item,
            count: 1,
            expiration_date: null,
            working_condition_id: 1,
        }
    })
})
axios.get('position_type').then(({ data }) => pageData.position_types = data)
axios.get('document').then(({ data }) => pageData.main_documents = data)
axios.get('working_condition').then(({ data }) => pageData.working_conditions = data)

watch(() => pageData.dialog, (dialog) => {
    if (dialog) getSelectedEmploye(current.selected)
})

const toggle = () => pageData.dialog = true
defineExpose({ toggle })
</script>
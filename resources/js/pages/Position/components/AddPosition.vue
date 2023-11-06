<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" scrollable width="992" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
            </template>
            <CustomForm :submitMethod="addPostion" @close="pageData.dialog = false" title="Lavozim kiritish" height="600px">
                <FormInputs :formData="formData" :pageData="pageData"/>
            </CustomForm>
        </v-dialog>
    </v-row>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import FormInputs from './FormInputs.vue';
import axios from '@/modules/axios'
const emit = defineEmits(['addPosition'])

const pageData = reactive({
    dialog: false,
    products: null,
    position_types: null,
    main_documents: null,
    working_conditions: null,
})

const formData = reactive({
    name: null,
    products: [],
    isActive: true,
    main_document_id: null,
    number_in_document: null,
    position_type_id: null,
})

async function addPostion() {
    await axios.post('position', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addPosition', data)
    })
}

axios.get('product').then(({ data }) => {
    pageData.products = data.map((item) => {
        return {...item,count: 1,expiration_date: null,working_condition_id: 1}
    })
})

axios.get('position_type').then(({ data }) => pageData.position_types = data)
axios.get('document').then(({ data }) => pageData.main_documents = data)
axios.get('working_condition').then(({ data }) => pageData.working_conditions = data)
</script>
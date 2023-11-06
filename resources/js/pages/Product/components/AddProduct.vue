<template>
<v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <template v-slot:activator="{ props }">
            <v-btn icon="mdi-plus" v-bind="props"></v-btn>
        </template>
        <CustomForm :submitMethod="addProduct" @close="pageData.dialog = false" title="Mahsulot kiritish">
            <FormInputs :formData="formData" :pageData="pageData"/> 
        </CustomForm>
    </v-dialog>
</v-row>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import axios from '@/modules/axios'
import FormInputs from './FormInputs.vue'
const emit = defineEmits(['addProduct'])
const pageData = reactive({
    dialog: false,
    products_types: null,
    products: null,
})

const formData = reactive({
    name: null,
    product_type_id: null,
    isActive: true,
})

async function addProduct() {
    await axios.post('product', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addProduct', data)
    })
}

axios.get('product_type').then(({data}) => {
    pageData.products_types = data.map((item) => { return {...item, count: 1} })
})

axios.get('product').then(({data}) => {
    pageData.products = data.map((product) => product.name)
})
</script>
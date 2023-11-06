<template>
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <CustomForm :submitMethod="editProduct" @close="pageData.dialog = false" @vue:mounted="getSelectedProduct(current.selected)" title="Mahsulotni tahrirlash">
            <FormInputs :formData="formData" :pageData="pageData" /> 
        </CustomForm>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import axios from '@/modules/axios'
import FormInputs from './FormInputs.vue'
const { current } = defineProps(['current'])
const emit = defineEmits(['editProduct'])
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

axios.get('product_type').then(({ data }) => {
    pageData.products_types = data
})

async function editProduct() {
    await axios.patch(`product/${current.selected}`, formData).then(({ data }) => {
        pageData.dialog = false
        emit('editProduct', data)
    })
}

axios.get('product').then(({ data }) => {
    pageData.products = data.map((product) => product.name)
})

function getSelectedProduct(id) {
    axios.get(`product/${id}`).then(({ data }) => {
        formData.name = data.name
        formData.product_type_id = data.product_type_id
        formData.isActive = Boolean(data.isActive)
    })
}

const toggle = () => pageData.dialog = true
defineExpose({ toggle })
</script>
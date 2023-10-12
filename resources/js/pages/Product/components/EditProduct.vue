<template>
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <v-card class="bg-white">
            <v-form ref="formTag" @submit.prevent="editProduct">
                <v-card-title> Mahsulotni tahrirlash </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" class="pt-0">
                                <v-combobox class="mb-2" label="Nomi" v-model="formData.name"         :items="pageData.products"       :rules="pageData.rules"/>
                                <v-autocomplete class="mb-2" label="Turi" v-model="formData.product_type_id" :items="pageData.products_types" :rules="pageData.rules"
                                    item-title="name"
                                    :item-value="(item) => item.id"
                                />
                                <v-switch label="Faolligi" v-model="formData.isActive"></v-switch>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <FormFooter @close="pageData.dialog = false"/>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive, watch } from 'vue'
import axios from '@/modules/axios'
const { current } = defineProps(['current'])
const emit = defineEmits(['editProduct'])
const pageData = reactive({
    dialog: false,
    products_types: null,
    products: null,
    rules: [(value) => value == null || value == "" ? 'toldiring' : true ],
})

const formData = reactive({
    name: null,
    product_type_id: null,
    isActive: true,
})


axios.get('product_type').then(({ data }) => {
    pageData.products_types = data
})


function editProduct() {
    axios.patch(`product/${current.selected}`, formData).then(({ data }) => {
        pageData.dialog = false
        emit('editProduct', data)
    })
}

axios.get('product').then(({data}) => {
    pageData.products = data.map((product) => product.name)
})

function getSelectedProduct(id) {
    axios.get(`product/${id}`).then(({ data }) => {
        formData.name = data.name
        formData.product_type_id = data.product_type_id
        formData.isActive = Boolean(data.isActive)
    })
}

function clear() {
    formData.name = null
    formData.product_type_id = null
    formData.isActive = true
}

watch(() => pageData.dialog, (dialog) => {
    if (dialog) getSelectedProduct(current.selected)

    else clear()
})

const toggle = () => pageData.dialog = true
defineExpose({ toggle })
</script>
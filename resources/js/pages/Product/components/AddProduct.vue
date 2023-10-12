<template>
<v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <template v-slot:activator="{ props }">
            <v-btn icon="mdi-plus" v-bind="props"></v-btn>
        </template>
        <v-card class="bg-white">
            <v-form ref="formTag" @submit.prevent="addProduct">
                <v-card-title> Mahsulot kiritish </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" class="pt-0">
                                <v-combobox class="mb-2" label="Nomi" v-model="formData.name" :items="pageData.products" :rules="pageData.rules"/>
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
</v-row>
</template>

<script setup lang="ts">
import { reactive, watch, ref } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['addProduct'])
const formTag = ref()
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

async function addProduct() {
    const { valid } = await formTag.value.validate()
    if (valid == false) return


    axios.post('product', formData).then(({ data }) => {
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

watch(() => pageData.dialog, (current) => {
    if (current) {
        formData.name = null
        formData.product_type_id = null
        formData.isActive = true
    }
})
</script>
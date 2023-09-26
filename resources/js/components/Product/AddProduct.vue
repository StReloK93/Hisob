<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
            </template>
            <v-card tag="form" class="bg-white" @submit.prevent="addProduct">
                <v-card-title class="bg-blue-grey-lighten-5">
                    <span>Mahsulot kiritish formasi</span>
                </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" class="pt-0">
                                <v-combobox
                                    color="teal"
                                    label="Nomi"
                                    variant="underlined"
                                    hide-details="auto"
                                    :items="pageData.products"
                                    v-model="formData.name"
                                    required
                                />
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-text-field
                                    color="teal"
                                    label="Muddati (Oy)"
                                    variant="underlined"
                                    hide-details="auto"
                                    type="number"
                                    v-model="formData.expiration_date"
                                />
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-select
                                    color="teal"
                                    :items="pageData.products_types"
                                    variant="underlined"
                                    hide-details="auto"
                                    v-model="formData.product_type"
                                    label="Turi" 
                                    item-title="name"
                                    :item-value="(item) => item.id"
                                    :rules="pageData.rules"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-switch label="Faolligi"  v-model="formData.isActive" hide-details="auto" color="teal"></v-switch>
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
        </v-dialog>
    </v-row>
</template>

<script setup lang="ts">
import { reactive, watch } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['addProduct'])

const pageData = reactive({
    dialog: false,
    products_types: null,
    products: null,
    rules: [(value) => value == null || value == "" ? 'toldiring' : true ],
})

const formData = reactive({
    name: null,
    expiration_date: null,
    product_type: null,
    isActive: true,
})

function addProduct() {
    
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
        formData.product_type = null
        formData.expiration_date = null,
        formData.isActive = true
    }
})
</script>
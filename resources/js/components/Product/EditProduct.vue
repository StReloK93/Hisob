<template>
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <v-card tag="form" class="bg-white" @submit.prevent="editProduct">
            <v-card-title class="bg-blue-grey-lighten-5">
                <span>Lavozim kiritish formasi</span>
            </v-card-title>
            <v-card-text class="pa-0">
                <v-container>
                    <v-row>
                        <v-col cols="12" class="pt-0">
                            <v-text-field color="teal" label="Nomi" variant="underlined" hide-details="auto"
                                v-model="formData.name" required>
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" class="pt-0">
                            <v-select color="teal" :items="pageData.products_types" variant="underlined" hide-details="auto"
                                v-model="formData.product_type" label="Turi" item-title="name"
                                :item-value="(item) => item.id" />
                        </v-col>
                        <v-col cols="12" class="pt-0">
                            <v-switch label="Faolligi" v-model="formData.isActive" hide-details="auto"
                                color="teal"></v-switch>
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
</template>

<script setup lang="ts">
import { reactive, watch } from 'vue'
import axios from '@/modules/axios'
const { current } = defineProps(['current'])
const emit = defineEmits(['editProduct'])
const pageData = reactive({
    dialog: false,
    products_types: null,
})

const formData = reactive({
    name: null,
    product_type: null,
    isActive: true,
})


axios.get('product_type').then(({ data }) => {
    pageData.products_types = data.map((item) => { return { ...item, count: 1 } })
})


function editProduct() {
    axios.patch(`product/${current.selected}`, formData).then(({ data }) => {
        pageData.dialog = false
        emit('editProduct', data)
    })
}


function getSelectedProduct(id) {
    axios.get(`product/${id}`).then(({ data }) => {
        formData.name = data.name
        formData.product_type = data.product_type_id
        formData.isActive = Boolean(data.isActive)
    })
}

function clear() {
    formData.name = null
    formData.product_type = null
    formData.isActive = true
}

watch(() => pageData.dialog, (dialog) => {
    if (dialog) getSelectedProduct(current.selected)

    else clear()
})

const toggle = () => pageData.dialog = true
defineExpose({ toggle })
</script>
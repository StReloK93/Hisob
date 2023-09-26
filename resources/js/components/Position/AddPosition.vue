<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
            </template>
            <v-card tag="form" class="bg-white" @submit.prevent="addEmploye">
                <v-card-title class="bg-blue-grey-lighten-5">
                    <span>Lavozim kiritish formasi</span>
                </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" class="pt-0">
                                <v-text-field
                                    color="teal"
                                    label="Nomi"
                                    variant="underlined"
                                    hide-details="auto"
                                    v-model="formData.name"
                                    required>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-autocomplete
                                    color="teal"
                                    :items="pageData.products"
                                    variant="underlined"
                                    hide-details="auto"
                                    v-model="formData.products"
                                    label="Biriktirilgan buyumlar" 
                                    item-title="name"
                                    :item-value="(item) => item"
                                    multiple
                                ></v-autocomplete>
                            </v-col>
                            <v-col cols="12" class="py-4">
                                <template v-for="product in formData.products">
                                    <div class="w-100 d-flex justify-space-between align-center py-1 px-2 table-border">
                                        <span class="text-grey-darken-1">{{ product.name }}</span>
                                        <main class="d-flex align-center ">
                                            <v-btn icon="mdi-menu-left" density="compact" elevation="0" @click="decrement(product)" :disabled="product.count == 1"></v-btn>
                                            <span class="px-2">
                                                {{ product.count }}
                                            </span>
                                            <v-btn icon="mdi-menu-right" density="compact" elevation="0" @click="increment(product)"></v-btn>
                                        </main>
                                    </div>
                                </template>
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
import { increment, decrement } from '@/modules/helpers'
import { reactive, watch } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['addPosition'])
const pageData = reactive({
    dialog: false,
    products: null,
})

const formData = reactive({
    name: null,
    products: [],
    isActive: true,
})

function addEmploye() {
    axios.post('position', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addPosition', data)
    })
}

axios.get('product').then(({data}) => {
    pageData.products = data.map((item) => { return {...item, count: 1} })
})

watch(() => pageData.dialog, (current) => {
    if (current) {
        formData.name = null
        formData.products = []
        formData.isActive = true
    }
})
</script>
<template>
    <v-dialog v-model="pageData.dialog" persistent width="992" location="right">
        <v-card class="bg-white">
            <v-form @submit.prevent="editPosition" ref="formTag">
                <v-card-title> Lavozim tahrirlash </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="5" class="pt-0">
                                <v-autocomplete
                                    label="Biriktirilgan meyor" 
                                    class="my-2"
                                    v-model="formData.main_document_id"
                                    :items="pageData.main_documents"
                                    item-title="name"
                                    :item-value="(item) => item.id"
                                    :rules="pageData.rules"
                                />
                                <v-autocomplete
                                    class="my-2"
                                    :items="pageData.position_types"
                                    v-model="formData.position_type_id"
                                    label="Lavozim turi" 
                                    item-title="name"
                                    :item-value="(item) => item.id"
                                    :rules="pageData.rules"
                                />
                                <v-text-field
                                    class="my-2"
                                    label="Nomi"
                                    v-model="formData.name"
                                    :rules="pageData.rules"
                                />
                                <v-text-field
                                    class="my-2"
                                    label="Meyordagi tartib raqami"
                                    v-model="formData.number_in_document"
                                    :rules="pageData.rules"
                                />
                                <v-autocomplete
                                    class="my-2"
                                    :items="pageData.products"
                                    v-model="formData.products"
                                    label="Biriktirilgan buyumlar" 
                                    item-title="name"
                                    :item-value="(item) => item"
                                    multiple
                                    :rules="pageData.rules"
                                />
                            </v-col>
                            <v-col cols="7" class="pt-0">
                                <section v-for="product in formData.products" class="bg-blue-grey-lighten-5 mb-1">
                                    <div class="w-100 d-flex justify-space-between align-center pt-1 px-2">
                                        <span class="text-grey-darken-1 w-75 pb-1">{{ product.name }}</span>
                                        <main class="d-flex align-center w-25 d-flex justify-end pb-1">
                                            <v-btn icon="mdi-menu-left" density="compact" elevation="0" @click="decrement(product)" :disabled="product.count == 1"></v-btn>
                                            <span class="px-2">
                                                {{ product.count }}
                                            </span>
                                            <v-btn icon="mdi-menu-right" density="compact" elevation="0" @click="increment(product)"></v-btn>
                                        </main>
                                    </div>
                                    <main class="d-flex align-center">
                                        <v-col cols="6" class="py-0">
                                            <v-combobox
                                                density="compact"
                                                v-model="product.expiration_date"
                                                label="Muddati (oy)"
                                                :hide-details="true"
                                                :rules="pageData.rules"
                                                :items="['дежурные', 'до износа']"
                                            />
                                        </v-col>
                                        <v-col cols="6" class="py-0">
                                            <v-autocomplete
                                                class="my-2"
                                                density="compact"
                                                :items="pageData.working_conditions"
                                                :hide-details="true"
                                                v-model="product.working_condition_id"
                                                label="Mehnat sharoitlari" 
                                                item-title="name"
                                                :item-value="(item) => item.id"
                                                :rules="pageData.rules"
                                            />
                                        </v-col>
                                    </main>
                                </section>
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
import { increment, decrement } from '@/modules/helpers'
import { reactive, watch, ref } from 'vue'
import axios from '@/modules/axios'
import {  } from 'vue';
const { current } = defineProps(['current'])
const emit = defineEmits(['editPosition'])
const formTag = ref()

const pageData = reactive({
    dialog: false,
    products: null,
    position_types: null,
    working_conditions: null,
    main_documents: null,
    rules: [(value) => [null, ""].includes(value) ? 'toldiring' : true]
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
    const { valid } = await formTag.value.validate()
    if (valid == false) return

    axios.patch(`position/${current.selected}`, formData).then(({ data }) => {
        pageData.dialog = false
        emit('editPosition', data)
    })
}

function getSelectedEmploye(id){
    axios.get(`position/${id}`).then(({data}) =>{
        formData.main_document_id = data.main_document_id
        formData.number_in_document = data.number_in_document
        formData.position_type_id = data.position_type_id
        formData.name = data.name
        // formData.products = data.products.map((item) => item.product)
        formData.products = data.products.map((item) => { 
            return {
                ...item.product,
                count: item.count ,
                expiration_date: item.expiration_date,
                working_condition_id: item.working_condition_id,
            }
        })
        
        formData.isActive = Boolean(data.isActive)
    })
}

axios.get('product').then(({data}) => {
    pageData.products = data.map((item) => { 
        return {
            ...item,
            count: 1 ,
            expiration_date: null,
            working_condition_id: null,
        }
    })
})
axios.get('position_type').then(({data}) => pageData.position_types = data)
axios.get('document').then(({data}) => pageData.main_documents = data)
axios.get('working_condition').then(({data}) => pageData.working_conditions = data)


function clear(){
    current.selected = null
    formData.name = null
    formData.products = []
    formData.isActive = false
}

watch(() => pageData.dialog, (dialog) => {
    if (dialog) getSelectedEmploye(current.selected)
    else clear()
})

const toggle = () => pageData.dialog = true
defineExpose({toggle})
</script>
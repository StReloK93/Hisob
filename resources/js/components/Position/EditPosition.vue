<template>
    <v-dialog v-model="pageData.dialog" persistent width="992" location="right">
        <v-card tag="form" class="bg-white" @submit.prevent="editPosition">
            <v-card-title class="bg-blue-grey-lighten-5">
                <span>Lavozim tahrirlash formasi</span>
            </v-card-title>
            <v-card-text class="pa-0">
                <v-container>
                            <v-row>
                                <v-col cols="5" class="pt-0">
                                    <v-autocomplete
                                        chips
                                        class="my-2"
                                        color="teal"
                                        :items="pageData.main_documents"
                                        variant="underlined"
                                        hide-details="auto"
                                        v-model="formData.main_document_id"
                                        label="Biriktirilgan meyor" 
                                        item-title="name"
                                        :item-value="(item) => item.id"
                                        :rules="pageData.rules"
                                    />
                                    <v-autocomplete
                                        class="my-2"
                                        chips
                                        color="teal"
                                        :items="pageData.position_types"
                                        variant="underlined"
                                        hide-details="auto"
                                        v-model="formData.position_type_id"
                                        label="Lavozim turi" 
                                        item-title="name"
                                        :item-value="(item) => item.id"
                                        :rules="pageData.rules"
                                    />
                                    <v-text-field
                                        class="my-2"
                                        color="teal"
                                        label="Nomi"
                                        variant="underlined"
                                        hide-details="auto"
                                        v-model="formData.name"
                                        :rules="pageData.rules"
                                    />
                                    <v-text-field
                                        class="my-2"
                                        color="teal"
                                        label="Meyordagi tartib raqami"
                                        variant="underlined"
                                        hide-details="auto"
                                        v-model="formData.number_in_document"
                                        :rules="pageData.rules"
                                    />
                                    <v-autocomplete
                                        chips
                                        class="my-2"
                                        color="teal"
                                        :items="pageData.products"
                                        variant="underlined"
                                        hide-details="auto"
                                        v-model="formData.products"
                                        label="Biriktirilgan buyumlar" 
                                        item-title="name"
                                        :item-value="(item) => item"
                                        :rules="pageData.rules"
                                        multiple
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
                                                    color="teal"
                                                    density="compact"
                                                    v-model="product.expiration_date"
                                                    label="Muddati"
                                                    variant="underlined"
                                                    :hide-details="true"
                                                    :rules="pageData.rules"
                                                    :items="['дежурные', 'до износа']"
                                                />
                                            </v-col>
                                            <v-col cols="6" class="py-0">
                                                <v-autocomplete
                                                    color="teal"
                                                    class="my-2"
                                                    density="compact"
                                                    :items="pageData.working_conditions"
                                                    variant="underlined"
                                                    :hide-details="true"
                                                    v-model="product.working_condition_id"
                                                    label="Mehnat sharoitlari" 
                                                    item-title="name"
                                                    :item-value="(item) => item"
                                                    :rules="pageData.rules"
                                                    return-object
                                                />
                                            </v-col>
                                        </main>
                                    </section>
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
import { increment, decrement } from '@/modules/helpers'
import { reactive, watch, computed } from 'vue'
import axios from '@/modules/axios'
import {  } from 'vue';
const { current } = defineProps(['current'])
const emit = defineEmits(['editPosition'])

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


// const products = computed(() => {
//     formData.products.map()
// })

function editPosition() {
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
                // count: item.count ,
                // expiration_date: item.expiration_date,
                // working_condition_id: item.working_condition_id,
            }
        })
        
        formData.isActive = Boolean(data.isActive)
    })
}

axios.get('product').then(({data}) => pageData.products = data)
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
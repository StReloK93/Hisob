<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" scrollable width="600" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
            </template>
            <v-form ref="form" @submit.prevent="addProductEmploye">
            <v-card class="bg-white">
                    <v-card-title> Xodimga maxsus kiyim topshirish </v-card-title>
                    <v-divider></v-divider>
                    <v-card-text class="pa-0" style="height: 700px;">
                        <v-container>
                            <v-row>
                                <v-col cols="12" class="pt-3">
                                    <v-autocomplete
                                        :rules="pageData.rules"
                                        :items="pageData.products"
                                        v-model="formData.products"
                                        label="Xodim lavozimiga biriktirilgan buyumlar" 
                                        item-title="name"
                                        :item-value="(item) => item"
                                        multiple
                                    />
                                </v-col>
                                <v-col cols="12" class="py-4">
                                    <template v-for="product in formData.products">
                                        <main class="px-3 pb-3 pt-2 mb-4 bg-grey-lighten-5">
                                            <div class="w-100 d-flex justify-space-between align-center mb-2">
                                                <span class="text-grey-darken-1">{{ product.name }}</span>
                                                <main class="d-flex align-center">
                                                    <v-btn icon="mdi-menu-left" color="teal" density="compact" elevation="0" @click="decrement(product)" :disabled="product.count == 1"></v-btn>
                                                    <span class="px-2">
                                                        {{ product.count }}
                                                    </span>
                                                    <v-btn icon="mdi-menu-right" color="teal" density="compact" elevation="0" @click="increment(product)"></v-btn>
                                                </main>
                                            </div>
                                            <v-row>                                            
                                                <v-col cols="6">
                                                    <v-text-field
                                                        :rules="pageData.rules"
                                                        label="Nomenklatura raqami"
                                                        @input="getProductPrices(product)"
                                                        v-model="product.nomenclature"
                                                        type="number"
                                                    />
                                                </v-col>
                                                <v-col cols="6">
                                                    <v-combobox
                                                        :rules="pageData.rules"
                                                        :items="product.productPrices"
                                                        v-model="product.price"
                                                        type="number"
                                                        label="Mahsulot narxlari"
                                                        item-title="price1"
                                                    />
                                                </v-col>
                                            </v-row>
                                        </main>
                                    </template>
                                </v-col>
                                <v-col cols="12" class="pt-0">
                                    <v-text-field
                                        :rules="pageData.rules"
                                        label="Topshirilgan sana"
                                        type="date"
                                        v-model="formData.date_of_receipt"
                                    />
                                </v-col>                            
                            </v-row>
                        </v-container>
                    </v-card-text>
                    <v-divider></v-divider>
                    <FormFooter @close="pageData.dialog = false"/>
                </v-card>
            </v-form>
        </v-dialog>
    </v-row>
</template>

<script setup lang="ts">
import { increment, decrement } from '@/modules/helpers'
import { reactive, watch, ref } from 'vue'
import moment from 'moment'
import axios from '@/modules/axios'
const emit = defineEmits(['addProduct'])
const { employe } = defineProps(['employe'])

const position = employe.position?.at(-1).position
const form = ref()

async function getProductPrices(product){
    if(product.nomenclature.length == 7){
        const { data } = await axios.get(`employe_product/price/${product.nomenclature}`)
        product.productPrices = data.map((item) => item.price1)
    }
    else product.productPrices = []
}

const pageData = reactive({
    dialog: false,
    products: position.products.map((item) => { return {...item, name: item.product.name, count: 1, nomenclature: null, price: null , productPrices: []} }),
    rules: [(value) => value == null || value == "" ? 'toldiring' : true ],
})

const formData = reactive({
    employe_id: employe.id,
    products: [],
    date_of_receipt: moment().format('YYYY-MM-DD')
})

async function addProductEmploye() {
    const { valid } = await form.value.validate()
    if(valid == false) return
    
    axios.post('employe_product', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addProduct', data)
    })
}

watch(() => pageData.dialog, (current) => {
    if (current == false) {
        formData.employe_id = null
        formData.products = []
        formData.date_of_receipt = null
    }
    else formData.date_of_receipt = moment().format('YYYY-MM-DD')
})
</script>
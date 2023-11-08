<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="600" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" v-bind="props"></v-btn>
            </template>
            <CustomForm :submitMethod="addProductEmploye" @close="pageData.dialog = false"
                title="Xodimga asosiy vositalar biriktirish">
                <v-row>
                    <v-col cols="12" class="pt-3">
                        <v-autocomplete :rules="rules" :items="pageData.products" v-model="formData.products"
                            label="Asosiy vositalar" item-title="name" :item-value="(item) => item" multiple />
                    </v-col>
                    <v-col cols="12" class="py-4">
                        <template v-for="product in formData.products">
                            <main class="px-3 pb-3 pt-2 mb-4 bg-grey-lighten-5">
                                <div class="w-100 d-flex justify-space-between align-center mb-2">
                                    <span class="text-grey-darken-1">{{ product.name }}</span>
                                    <main class="d-flex align-center">
                                        <v-btn icon="mdi-menu-left" color="teal" density="compact" elevation="0"
                                            @click="decrement(product)" :disabled="product.count == 1"></v-btn>
                                        <span class="px-2">
                                            {{ product.count }}
                                        </span>
                                        <v-btn icon="mdi-menu-right" color="teal" density="compact" elevation="0"
                                            @click="increment(product)"></v-btn>
                                    </main>
                                </div>
                                <v-row>
                                    <v-col cols="4">
                                        <v-text-field :rules="rules" label="Nomenklatura raqami"
                                            @input="getProductPrices(product)" v-model="product.nomenclature"
                                            type="number" />
                                    </v-col>
                                    <v-col cols="4">
                                        <v-combobox :rules="rules" :items="product.productPrices"
                                            v-model="product.price" type="number" label="Mahsulot narxlari"
                                            item-title="price1" />
                                    </v-col>
                                    <v-col cols="4">
                                        <v-text-field :rules="rules" label="Topshirilgan sana" type="date"
                                            v-model="product.date_of_receipt" />
                                    </v-col>
                                </v-row>
                            </main>
                        </template>
                    </v-col>
                </v-row>
            </CustomForm>
        </v-dialog>
    </v-row>
</template>

<script setup lang="ts">
import CustomForm from '@/components/CustomForm.vue'
import { increment, decrement, rules } from '@/modules/helpers'
import { reactive } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['addProduct'])
const { employe } = defineProps(['employe'])

async function getProductPrices(product) {
    if (product.nomenclature.length == 7) {
        const { data } = await axios.get(`employe_product/price/${product.nomenclature}`)
        product.productPrices = data.map((item) => item.price1)
    }
    else product.productPrices = []
}

const pageData = reactive({
    dialog: false,
    products: null,
})



axios.get('products/main').then(({ data }) => {

    data.forEach(product => {
        product.count = 1
        product.nomenclature = null
        product.price = null
        product.productPrices = []
    })
    pageData.products = data

})

const formData = reactive({
    employe_id: employe.id,
    products: [],
})

async function addProductEmploye() {
    await axios.post('employe_product', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addProduct', data)
    })
}
</script>
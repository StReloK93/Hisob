<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="992" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
            </template>
            <v-card class="bg-white">
            <v-form ref="formTag" @submit.prevent="addPostion">
                    <v-card-title class="bg-blue-grey-lighten-5">
                        <span>Lavozim kiritish formasi</span>
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
                                        class="my-2"
                                        chips
                                        color="teal"
                                        :items="pageData.products"
                                        variant="underlined"
                                        hide-details="auto"
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
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue-gray-1" variant="text" type="button" @click="pageData.dialog = false">
                            Yopish
                        </v-btn>
                        <v-btn color="blue-darken-1" variant="text" type="submit">
                            Saqlash
                        </v-btn>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script setup lang="ts">
import { increment, decrement } from '@/modules/helpers'
import { reactive, watch, ref } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['addPosition'])
const formTag = ref()

const pageData = reactive({
    dialog: false,
    products: null,
    position_types: null,
    main_documents: null,
    working_conditions: null,
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

async function addPostion() {
    const { valid } = await formTag.value.validate()
    if (valid == false) return

    axios.post('position', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addPosition', data)
    })
}

axios.get('product').then(({data}) => pageData.products = data)
axios.get('position_type').then(({data}) => pageData.position_types = data)
axios.get('document').then(({data}) => pageData.main_documents = data)
axios.get('working_condition').then(({data}) => pageData.working_conditions = data)

watch(() => pageData.dialog, (current) => {
    if (current) {
        formData.name = null
        formData.products = []
        formData.isActive = true
        formData.number_in_document = null
    }
})
</script>
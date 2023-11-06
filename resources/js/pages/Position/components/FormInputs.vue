<template>
    <v-row>
        <v-col cols="5" class="pt-0">
            <v-autocomplete label="Biriktirilgan meyor" class="my-2" v-model="formData.main_document_id"
                :items="pageData.main_documents" item-title="name" :item-value="(item) => item.id" :rules="rules" />
            <v-autocomplete class="my-2" :items="pageData.position_types" v-model="formData.position_type_id"
                label="Lavozim turi" :item-title="(item) => `${item.code} - ${item.name}`" :item-value="(item) => item.id"
                :rules="rules" />
            <v-text-field class="my-2" label="Nomi" v-model="formData.name" :rules="rules" />
            <v-text-field class="my-2" label="Meyordagi tartib raqami" v-model="formData.number_in_document"
                :rules="rules" />
            <v-autocomplete class="my-2"
                :items="pageData.products"
                v-model="formData.products"
                label="Biriktirilgan buyumlar"
                item-title="name"
                :item-value="(item) => item"
                multiple
                :rules="rules"
                :value-comparator="(item , value) => item.id == value.id"
            />
        </v-col>
        <v-col cols="7">
            <section v-for="product in formData.products" class="bg-blue-grey-lighten-5 mb-1">
                <div class="w-100 d-flex justify-space-between align-center pt-1 px-2">
                    <span class="text-grey-darken-1 w-75 pb-1">{{ product.name }}</span>
                    <main class="d-flex align-center w-25 d-flex justify-end pb-1">
                        <v-btn icon="mdi-menu-left" density="compact" elevation="0" @click="decrement(product)"
                            :disabled="product.count == 1"></v-btn>
                        <span class="px-2">
                            {{ product.count }}
                        </span>
                        <v-btn icon="mdi-menu-right" density="compact" elevation="0" @click="increment(product)"></v-btn>
                    </main>
                </div>
                <main class="d-flex align-center">
                    <v-col cols="6" class="py-0">
                        <v-combobox density="compact" v-model="product.expiration_date" label="Muddati" :hide-details="true"
                            :rules="rules" :items="['дежурные', 'до износа']" />
                    </v-col>
                    <v-col cols="6" class="py-0">
                        <v-autocomplete class="my-2" density="compact" :items="pageData.working_conditions"
                            :hide-details="true" v-model="product.working_condition_id" label="Mehnat sharoitlari"
                            item-title="name" :item-value="(item) => item.id" :rules="rules" />
                    </v-col>
                </main>
            </section>
        </v-col>
    </v-row>
</template>

<script setup lang="ts">
import { increment, decrement, rules } from '@/modules/helpers'
const { formData, pageData } = defineProps(['formData', 'pageData'])
</script>
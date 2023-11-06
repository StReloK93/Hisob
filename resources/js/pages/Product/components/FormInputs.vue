<template>
    <v-row>
        <v-col cols="12" class="pt-0">
            <v-combobox class="mb-2" label="Nomi" v-model="formData.name" :items="pageData.products"
                :rules="rules" />
            <v-autocomplete class="mb-2" label="Turi" v-model="formData.product_type_id" :items="pageData.products_types"
                :rules="rules" item-title="name" :item-value="(item) => item.id" />
            <v-switch label="Faolligi" v-model="formData.isActive"></v-switch>
        </v-col>
    </v-row>
</template>

<script setup lang="ts">
const { formData, pageData } = defineProps(['formData', 'pageData'])
import { rules } from '@/modules/helpers'
</script>
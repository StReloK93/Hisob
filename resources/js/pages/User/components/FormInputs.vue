<template>
    <v-row>
        <v-col cols="12" class="pt-0">
            <v-text-field class="mb-2" label="Login" v-model="formData.login" :rules="rules" />
            <v-text-field class="mb-2" label="F.I.O" v-model="formData.name" :rules="rules" />
            <v-autocomplete class="mb-2" label="Bo'linmalar" v-model="formData.organizations"
                :items="pageData.organizations" item-title="short_name" :item-value="(item) => item.id" multiple />
            <v-autocomplete class="mb-2" label="Rollar" v-model="formData.roles" :items="pageData.roles" item-title="name"
                :item-value="(item) => item.id" multiple />
        </v-col>
    </v-row>
</template>

<script setup lang="ts">
const { formData, pageData } = defineProps(['formData', 'pageData'])
import { rules } from '@/modules/helpers'
</script>
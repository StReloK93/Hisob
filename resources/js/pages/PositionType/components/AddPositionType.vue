<template>
<v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <template v-slot:activator="{ props }">
            <v-btn icon="mdi-plus" v-bind="props"></v-btn>
        </template>
        <v-form @submit.prevent="addPositionType" ref="formTag" @vue:mounted="formTag.reset()">
            <v-card class="bg-white">
                <v-card-title> Ish turini kiritish </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" class="pt-0">
                                <v-text-field class="mb-2" label="Tartib raqami" v-model="formData.code" :rules="pageData.rules"/>
                                <v-text-field class="mb-2" label="Nomi" v-model="formData.name" :rules="pageData.rules"/>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <FormFooter @close="pageData.dialog = false"/>
            </v-card>
        </v-form>
    </v-dialog>
</v-row>
</template>

<script setup lang="ts">
import { reactive, ref } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['addPositionType'])
const formTag = ref()

const pageData = reactive({
    dialog: false,
    rules: [(value) => value == null || value == "" ? 'toldiring' : true],
})

const formData = reactive({ name: null, code: null })

async function addPositionType() {
    const { valid } = await formTag.value.validate()
    if (valid == false) return

    axios.post('position_type', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addPositionType', data)
    })
}
</script>
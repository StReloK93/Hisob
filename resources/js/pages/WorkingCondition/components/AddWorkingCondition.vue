<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" v-bind="props"></v-btn>
            </template>
            <v-card class="bg-white">
                <v-form @submit.prevent="addWorkingCondition" ref="formTag" @vue:mounted="formTag.reset()">
                    <v-card-title> Mehnat sharoitini kiritish </v-card-title>
                    <v-card-text class="pa-0">
                        <v-container>
                            <v-row>
                                <v-col cols="12" class="pt-0">
                                    <v-text-field label="Nomi" v-model="formData.name" :rules="pageData.rules" />
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                    <FormFooter @close="pageData.dialog = false"/>
                </v-form>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script setup lang="ts">
import { reactive, ref } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['addWorkingCondition'])
const formTag = ref()

const pageData = reactive({
    dialog: false,
    rules: [(value) => value == null || value == "" ? 'toldiring' : true],
})

const formData = reactive({ name: null })

async function addWorkingCondition() {
    const { valid } = await formTag.value.validate()
    if (valid == false) return

    axios.post('working_condition', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addWorkingCondition', data)
    })
}
</script>
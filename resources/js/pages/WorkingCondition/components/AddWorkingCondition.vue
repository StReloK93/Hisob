<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" v-bind="props"></v-btn>
            </template>
            <CustomForm :submitMethod="addWorkingCondition" @close="pageData.dialog = false" title="Mehnat sharoitini kiritish">
                <v-row>
                    <v-col cols="12" class="pt-0">
                        <v-text-field label="Nomi" v-model="formData.name" :rules="rules" />
                    </v-col>
                </v-row>
            </CustomForm>
        </v-dialog>
    </v-row>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['addWorkingCondition'])
import { rules } from '@/modules/helpers'
const pageData = reactive({
    dialog: false,
})

const formData = reactive({ name: null })

async function addWorkingCondition() {
    await axios.post('working_condition', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addWorkingCondition', data)
    })
}
</script>
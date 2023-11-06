<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
            </template>
            <CustomForm :submitMethod="addOrganization" @close="pageData.dialog = false" title="Bo'linma kiritish">
                <FormInputs :formData="formData"/>
            </CustomForm>
        </v-dialog>
    </v-row>
</template>

<script setup lang="ts">
import { reactive, watch } from 'vue'
import axios from '@/modules/axios'
import FormInputs from './FormInputs.vue'
const emit = defineEmits(['addOrganization'])
const pageData = reactive({ dialog: false })

const formData = reactive({
    name: null,
    short_name: [],
    isActive: true,
})

function addOrganization() {
    axios.post('organization', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addOrganization', data)
    })
}

watch(() => pageData.dialog, (current) => {
    if (current) {
        formData.name = null
        formData.short_name = null
        formData.isActive = true
    }
})
</script>
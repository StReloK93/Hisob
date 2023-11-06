<template>
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <CustomForm :submitMethod="editOrganization" @close="pageData.dialog = false" title="Bo'linma tahrirlash">
            <FormInputs :formData="formData" />
        </CustomForm>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive, watch } from 'vue'
import axios from '@/modules/axios'
import FormInputs from './FormInputs.vue'
const emit = defineEmits(['editOrganization'])
const { current } = defineProps(['current'])
const pageData = reactive({ dialog: false })

const formData = reactive({
    name: null,
    short_name: null,
    isActive: true,
})

async function editOrganization() {
    await axios.patch(`organization/${current.selected}`, formData).then(({ data }) => {
        pageData.dialog = false
        emit('editOrganization', data)
    })
}

function getSelectedOrganization(id) {
    axios.get(`organization/${id}`).then(({ data }) => {
        formData.name = data.name
        formData.short_name = data.short_name
        formData.isActive = Boolean(data.isActive)
    })
}

watch(() => pageData.dialog, (dialog) => {
    if (dialog) getSelectedOrganization(current.selected)
})

const toggle = () => pageData.dialog = true
defineExpose({ toggle })
</script>
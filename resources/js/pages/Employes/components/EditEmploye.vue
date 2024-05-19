<template>
    <v-dialog v-model="pageData.dialog" persistent width="768" location="right">
        <CustomForm :submitMethod="editEmploye" @close="pageData.dialog = false" title="Xodim kiritish" height="700px">
            <FormInputs :formData="formData" :pageData="pageData" />
        </CustomForm>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive, watch } from 'vue'
import FormInputs from './FormInputs.vue'
import axios from '@/modules/axios'
const emit = defineEmits(['editEmploye'])
const { current } = defineProps(['current'])

const pageData = reactive({
    dialog: false,
})

const formData = reactive({
    table_number: null,
    name: null,
    position_id: null,
    hiring_date: null,
    profession: null,
    gender: null,
    heigth: null,
    size_cloth: null,
    size_head: null,
    size_shoes: null,
    organization_id: null,
})


function getSelectedEmploye() {
    axios.get(`employe/${current.selected}`).then(({ data: employe }) => {
        const latestPosition = employe.position.at(-1)
        if (latestPosition) formData.position_id = latestPosition.position.id
        
        formData.table_number = employe.table_number
        formData.name = employe.name
        formData.hiring_date = latestPosition.hiring_date
        formData.profession = latestPosition.profession
        formData.organization_id = +latestPosition.organization_id
        formData.gender = employe.gender
        formData.heigth = employe.heigth
        formData.size_cloth = employe.size_cloth
        formData.size_head = employe.size_head
        formData.size_shoes = employe.size_shoes
    })
}

async function editEmploye() {
    await axios.patch(`employe/${current.selected}`, formData).then(({ data }) => {
        pageData.dialog = false
        emit('editEmploye', data)
    })
}

watch(() => pageData.dialog, (dialog) => {
    if (dialog) getSelectedEmploye()
})
const toggle = () => pageData.dialog = true
defineExpose({ toggle })
</script>
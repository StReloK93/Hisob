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
    organizations: null,
    positions: null,
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
        const latest = employe.position.at(-1)
        if (latest) formData.position_id = latest.position.id

        formData.table_number = employe.table_number
        formData.name = employe.name
        formData.hiring_date = employe.hiring_date
        formData.gender = employe.gender
        formData.heigth = employe.heigth
        formData.profession = employe.profession
        formData.size_cloth = employe.size_cloth
        formData.size_head = employe.size_head
        formData.size_shoes = employe.size_shoes
        formData.organization_id = employe.organization_id
    })
}

async function editEmploye() {
    await axios.patch(`employe/${current.selected}`, formData).then(({ data }) => {
        pageData.dialog = false
        emit('editEmploye', data)
    })
}

axios.all([axios.get('accessOrganizations'),axios.get('position')])
.then(axios.spread(({ data: organizations }, { data: positions }) => {
    pageData.organizations = organizations
    pageData.positions = positions
}))

watch(() => pageData.dialog, (dialog) => {
    if (dialog) getSelectedEmploye()
})
const toggle = () => pageData.dialog = true
defineExpose({ toggle })
</script>
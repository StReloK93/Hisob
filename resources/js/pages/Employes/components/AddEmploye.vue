<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="768" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
            </template>
            <CustomForm :submitMethod="addEmploye" @close="pageData.dialog = false" title="Xodim kiritish" height="700px">
                <FormInputs :formData="formData" :pageData="pageData"/> 
            </CustomForm>
        </v-dialog>
    </v-row>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import axios from '@/modules/axios'
import FormInputs from './FormInputs.vue'
const emit = defineEmits(['addEmploye'])

const pageData = reactive({
    dialog: false,
    organizations: null,
    positions: null,
    inputLoading: false,
})

const formData = reactive({
    table_number: null,
    name: null,
    position_id: null,
    hiring_date: null,
    profession: null,
    gender: false,
    heigth: null,
    size_cloth: null,
    size_head: null,
    size_shoes: null,
    organization_id: null,
})

async function addEmploye() {
    await axios.post('employe', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addEmploye', data)
    })
}

axios.all([axios.get('accessOrganizations'), axios.get('position')])
.then(axios.spread(({ data: organizations }, { data: positions }) => {
    pageData.organizations = organizations
    pageData.positions = positions
}))

</script>
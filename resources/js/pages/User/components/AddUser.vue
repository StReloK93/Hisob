<template>
<v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <template v-slot:activator="{ props }">
            <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
        </template>
        <CustomForm :submitMethod="addUser" @close="pageData.dialog = false" title="Foydalanuvchi kiritish">
            <FormInputs :formData="formData" :pageData="pageData"/> 
        </CustomForm>
    </v-dialog>
</v-row>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import axios from '@/modules/axios'
import FormInputs from './FormInputs.vue'
const emit = defineEmits(['addUser'])
const pageData = reactive({
    dialog: false,
    organizations: null,
    positions: null,
    roles: null,
})

const formData = reactive({
    name: null,
    login: null,
    organizations: [],
    roles: [],
})

async function addUser(){
    await axios.post('users', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addUser', data)
    })
}

axios.all([axios.get('organization'), axios.get('role')])
.then(axios.spread(({data:organizations}, {data:roles}) => {
    pageData.organizations = organizations
    pageData.roles = roles
}))
</script>
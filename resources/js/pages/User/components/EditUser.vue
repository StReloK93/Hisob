<template>
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <CustomForm :submitMethod="editUser" @close="pageData.dialog = false" @vue:mounted="getUser()" title="Foydalanuvchi ma'lumotlarini tahrirlash">
            <FormInputs :formData="formData" :pageData="pageData"/> 
        </CustomForm>
    </v-dialog>
</template>
<script setup lang="ts">
import { reactive } from 'vue'
import FormInputs from './FormInputs.vue'
import axios from '@/modules/axios'
const { selected } = defineProps(['selected'])
const emit = defineEmits(['editUser'])

const pageData = reactive({
    rules: [(value) => value == null || value == "" ? 'toldiring' : true ],
    dialog: false,
    organizations: [],
    roles: []
})

const formData = reactive({
    name: null,
    login: null,
    organizations: [],
    roles: [],
})

async function editUser(){
    await axios.put(`users/${selected.user.id}`, formData).then(({data}) => {
        pageData.dialog = false
        emit('editUser', data)
    })
}


function getUser(){
    const user = selected.user
    formData.login = user.login
    formData.name = user.name
    formData.organizations = user.organizations.map((item) => item.organizations_id)
    formData.roles = user.roles.map((item) => item.role_id)
}

axios.all([axios.get('organization'), axios.get('role')])
.then(axios.spread(({data:organizations}, {data:roles}) => {
    pageData.organizations = organizations
    pageData.roles = roles
}))

const toggle = () => pageData.dialog = true
defineExpose({ toggle })
</script>
<template>
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <v-card>
            <v-form ref="form" class="bg-white" @submit.prevent="editUser">
                <v-card-title> Foydalanuvchi ma'lumotlarini tahrirlash </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" class="pt-0">
                                <v-text-field class="mb-2" label="Login" v-model="formData.login" :rules="pageData.rules"/>
                                <v-text-field class="mb-2" label="F.I.O" v-model="formData.name" :rules="pageData.rules"/>
                                <v-autocomplete
                                    class="mb-2"
                                    label="Bo'linmalar"
                                    v-model="formData.organizations"
                                    :items="pageData.organizations"
                                    item-title="short_name"
                                    :item-value="(item) => item.id" multiple
                                />
                                <v-autocomplete
                                    class="mb-2"
                                    label="Rollar"
                                    v-model="formData.roles"
                                    :items="pageData.roles"
                                    item-title="name"
                                    :item-value="(item) => item.id" multiple
                                />
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <FormFooter @close="pageData.dialog = false"/>
            </v-form>
        </v-card>
    </v-dialog>
</template>
<script setup lang="ts">
import { reactive , watch, ref } from 'vue'
import axios from '@/modules/axios'
const { selected } = defineProps(['selected'])
const form = ref()

const emit = defineEmits(['editUser'])


const formData = reactive({
    name: null,
    login: null,
    organizations: [],
    roles: [],
})

function getUser(){
    const user = selected.user
    
    formData.login = user.login
    formData.name = user.name
    formData.organizations = user.organizations.map((item) => item.organizations_id)
    formData.roles = user.roles.map((item) => item.role_id)
}

async function editUser(){
    const { valid } = await form.value.validate()
    if(valid == false) return

    axios.put(`users/${selected.user.id}`, formData).then(({data}) => {
        pageData.dialog = false
        emit('editUser', data)
    })
}

const pageData = reactive({
    rules: [(value) => value == null || value == "" ? 'toldiring' : true ],
    dialog: false,
    organizations: [],
    roles: []
})

axios.all([
    axios.get('organization'), 
    axios.get('role'), 
])
.then(axios.spread(({data:organizations}, {data:roles}) => {
    pageData.organizations = organizations
    pageData.roles = roles
}))

function clear(){
    formData.name = null
    formData.login = null
    formData.organizations = []
}

const toggle = () => pageData.dialog = true
defineExpose({ toggle })

watch(() => pageData.dialog, (current) => {
    if (current) getUser()
    else  clear()
})
</script>
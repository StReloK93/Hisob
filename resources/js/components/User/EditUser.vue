<template>
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <v-card>
            <v-form ref="form" class="bg-white" @submit.prevent="editUser">
                <v-card-title class="bg-blue-grey-lighten-5">
                    <span>Xodim ma'lumotlarini o'zgartirish</span>
                </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" class="pt-0">
                                <v-text-field
                                    color="teal"
                                    label="Login"
                                    variant="underlined"
                                    disabled
                                    hide-details="auto"
                                    v-model="formData.login"
                                />
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-text-field
                                    color="teal"
                                    label="F.I.O"
                                    variant="underlined"
                                    hide-details="auto"
                                    v-model="formData.name"
                                    :rules="pageData.rules"
                                />
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-autocomplete
                                    color="teal"
                                    variant="underlined"
                                    label="Bo'linmalar"
                                    v-model="formData.organizations"
                                    :items="pageData.organizations"
                                    item-title="short_name"
                                    :item-value="(item) => item.id"
                                    multiple
                                    chips
                                />
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-autocomplete
                                    color="teal"
                                    variant="underlined"
                                    label="Rollar"
                                    v-model="formData.roles"
                                    :items="pageData.roles"
                                    item-title="name"
                                    :item-value="(item) => item.id"
                                    multiple
                                    chips
                                />
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue-gray-1" type="button" @click="pageData.dialog = false">
                        Yopish
                    </v-btn>
                    <v-btn color="blue-darken-1" type="submit">
                        Saqlash
                    </v-btn>
                </v-card-actions>
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
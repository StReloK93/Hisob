<template>
<v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <template v-slot:activator="{ props }">
            <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
        </template>
        <v-card>
            <v-form ref="form" class="bg-white" @submit.prevent="addUser">
                <v-card-title> Foydalanuvchi kiritish </v-card-title>
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
</v-row>
</template>

<script setup lang="ts">
import { reactive, watch, ref } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['addUser'])
const form = ref()

const pageData = reactive({
    dialog: false,
    organizations: null,
    positions: null,
    roles: null,
    inputLoading: false,
    rules: [(value) => value == null || value == "" ? 'toldiring' : true ]
})

const formData = reactive({
    name: null,
    login: null,
    organizations: [],
    roles: [],
})



async function addUser(){
    const { valid } = await form.value.validate()
    if(valid == false) return

    axios.post('users', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addUser', data)
    })

}



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

watch(() => pageData.dialog, (current) => {
    if (current) clear()
})
</script>
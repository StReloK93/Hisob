<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
            </template>
            <v-card>
                <v-form ref="form" class="bg-white" @submit.prevent="addUser">
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
                                    hide-details="auto"
                                    v-model="formData.login"
                                    :rules="pageData.rules"
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
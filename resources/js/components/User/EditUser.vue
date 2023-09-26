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
                                    v-model="formData.name"
                                    type="number"
                                />
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-text-field
                                    color="teal"
                                    label="F.I.O"
                                    variant="underlined"
                                    hide-details="auto"
                                    v-model="formData.name"
                                    type="number"
                                    :rules="pageData.rules"
                                />
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-autocomplete
                                    color="teal"
                                    variant="underlined"
                                    label="Bo'linmalar"
                                    :items="pageData.organizations"
                                    item-title="short_name"
                                    :item-value="(item) => item"
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
import { reactive } from 'vue'
import axios from '@/modules/axios'

const emit = defineEmits(['editUser'])
const formData = reactive({
    name: null,
    login: null,
    organizations: [],
})


function editUser(){

}

const pageData = reactive({
    rules: [(value) => value == null || value == "" ? 'toldiring' : true ],
    dialog: false,
    organizations: []
})


axios.all([
    axios.get('organization'), 
    axios.get('position')
])
.then(axios.spread(({data:organizations}, {data:positions}) => {
    pageData.organizations = organizations
}))



const toggle = () => pageData.dialog = true
defineExpose({ toggle })
</script>
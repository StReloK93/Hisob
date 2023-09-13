<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
            </template>
            <v-card tag="form" class="bg-white" @submit.prevent="addEmploye">
                <v-card-title class="bg-blue-grey-lighten-5">
                    <span>Xodim kiritish</span>
                </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" class="pt-0">
                                <v-text-field label="Tabel raqam" variant="underlined" hide-details="auto"
                                    v-model="formData.table_number" type="number" required></v-text-field>
                            </v-col>
                            <v-col cols="4" class="pt-0">
                                <v-text-field label="Familiya" variant="underlined" hide-details="auto"
                                    v-model="formData.last_name" required></v-text-field>
                            </v-col>
                            <v-col cols="4" class="pt-0">
                                <v-text-field label="Ism" variant="underlined" hide-details="auto"
                                    v-model="formData.first_name" required></v-text-field>
                            </v-col>
                            <v-col cols="4" class="pt-0">
                                <v-text-field label="Sharif" variant="underlined" hide-details="auto"
                                    v-model="formData.second_name" required></v-text-field>
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-select
                                    :items="pageData.organizations"
                                    variant="underlined"
                                    hide-details="auto"
                                    v-model="formData.organization_id"
                                    label="Ish joyi" 
                                    item-title="short_name"
                                    item-value="id"
                                    required
                                ></v-select>
                            </v-col>
                            <v-col cols="12">
                                <v-select 
                                    :items="pageData.positions" 
                                    variant="underlined"
                                    hide-details="auto"
                                    v-model="formData.position_id"
                                    label="Lavozimi"
                                    item-title="name"
                                    item-value="id"
                                    required
                                ></v-select>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field label="Ishga qabul qilingan sana" variant="underlined" hide-details="auto"
                                    v-model="formData.hiring_date" type="date"></v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0 px-1">
                                <v-radio-group small v-model="formData.gender" hide-details="auto">
                                    <template v-slot:label>
                                        <div>Jinsi</div>
                                    </template>
                                    <v-radio label="Erkak" value="1"></v-radio>
                                    <v-radio label="Ayol" value="0"></v-radio>
                                </v-radio-group>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue-gray-1" variant="text" type="button" @click="pageData.dialog = false">
                        Yopish
                    </v-btn>
                    <v-btn color="blue-darken-1" variant="text" type="submit">
                        Saqlash
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script setup lang="ts">
import { reactive, watch } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['addEmploye'])
const pageData = reactive({
    dialog: false,
    organizations: null,
    positions: null,
})

const formData = reactive({
    table_number: null,
    first_name: null,
    last_name: null,
    second_name: null,
    position_id: null,
    hiring_date: null,
    gender: null,
    organization_id: null,
})

function addEmploye() {
    axios.post('employe', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addEmploye', data)
    })
}

axios.all([
    axios.get('organization'), 
    axios.get('position')
])
.then(axios.spread(({data:organizations}, {data:positions}) => {
    pageData.organizations = organizations
    pageData.positions = positions
}))


watch(() => pageData.dialog, (current) => {
    if (current) {
        formData.table_number = null
        formData.first_name = null
        formData.last_name = null
        formData.second_name = null
        formData.position_id = null
        formData.hiring_date = null
        formData.gender = null
        formData.organization_id = null
    }
})
</script>
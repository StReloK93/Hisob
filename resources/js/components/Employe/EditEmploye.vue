<template>
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <v-card>
            <v-form ref="form" class="bg-white" @submit.prevent="editEmploye">
                <v-card-title class="bg-blue-grey-lighten-5">
                    <span>Xodim ma'lumotlarini o'zgartirish</span>
                </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" class="pt-0">
                                <v-text-field
                                    color="teal"
                                    label="Tabel raqam"
                                    variant="underlined"
                                    hide-details="auto"
                                    v-model="formData.table_number"
                                    type="number"
                                    :rules="pageData.rules"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-text-field
                                    color="teal"
                                    label="F.I.SH"
                                    variant="underlined"
                                    hide-details="auto"
                                    v-model="formData.name"
                                    :rules="pageData.rules"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" class="pt-0">
                                <v-autocomplete
                                    color="teal"
                                    :items="pageData.organizations"
                                    variant="underlined"
                                    hide-details="auto"
                                    v-model="formData.organization_id"
                                    label="Ish joyi" 
                                    item-title="short_name"
                                    item-value="id"
                                    :rules="pageData.rules"
                                ></v-autocomplete>
                            </v-col>
                            <v-col cols="12">
                                <v-autocomplete
                                    color="teal"
                                    :items="pageData.positions" 
                                    variant="underlined"
                                    hide-details="auto"
                                    v-model="formData.position_id"
                                    label="Lavozimi"
                                    item-title="name"
                                    item-value="id"
                                    :rules="pageData.rules"
                                ></v-autocomplete>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    color="teal"
                                    label="Ishga qabul qilingan sana"
                                    variant="underlined"
                                    hide-details="auto"
                                    v-model="formData.hiring_date"
                                    type="date"
                                    :rules="pageData.rules"
                                ></v-text-field>
                            </v-col>
                             <!--  -->
                             <v-col cols="6">
                                <v-text-field
                                    color="teal"
                                    label="Bo'yi"
                                    variant="underlined" hide-details="auto"
                                    v-model="formData.heigth"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field
                                    color="teal"
                                    label="Bosh o'lchami"
                                    variant="underlined" hide-details="auto"
                                    v-model="formData.size_head"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field
                                    color="teal"
                                    label="Kiyim o'lchami"
                                    variant="underlined" hide-details="auto"
                                    v-model="formData.size_cloth"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field
                                    color="teal"
                                    label="Oyoq kiyim o'lchami"
                                    variant="underlined" hide-details="auto"
                                    v-model="formData.size_shoes"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12">
                                <v-radio-group color="teal" small v-model="formData.gender" hide-details="auto">
                                    <v-radio label="Erkak" :value="true"></v-radio>
                                    <v-radio label="Ayol" :value="false"></v-radio>
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
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive, watch, ref } from 'vue'
import axios from '@/modules/axios'
const { current } = defineProps(['current'])

const form = ref()


const emit = defineEmits(['editEmploye'])
const pageData = reactive({
    dialog: false,
    organizations: null,
    positions: null,
    rules: [(value) => value == null || value == "" ? 'toldiring' : true ]
})

const formData = reactive({
    table_number: null,
    name: null,
    position_id: null,
    hiring_date: null,

    gender: null,
    heigth: null,
    size_cloth: null,
    size_head: null,
    size_shoes: null,

    organization_id: null,
})


function getSelectedEmploye(){
    axios.get(`employe/${current.selected}`).then(({data: employe}) => {
        const latest = employe.position.at(-1)
        if(latest) formData.position_id = latest.position.id


        formData.table_number = employe.table_number
        formData.name = employe.name
        formData.hiring_date = employe.hiring_date
        formData.gender = employe.gender
        formData.heigth = employe.heigth
        formData.size_cloth = employe.size_cloth
        formData.size_head = employe.size_head
        formData.size_shoes = employe.size_shoes
        formData.organization_id = employe.organization_id
    })
}




async function editEmploye() {
    const { valid } = await form.value.validate()
    if(valid == false) return

    axios.patch(`employe/${current.selected}`, formData).then(({ data }) => {
        pageData.dialog = false
        emit('editEmploye', data)
    })
}

axios.all([
    axios.get('accessOrganizations'),
    axios.get('position')
])
.then(axios.spread(({data:organizations}, {data:positions}) => {
    pageData.organizations = organizations
    pageData.positions = positions
}))


function clear(){
    formData.table_number = null
    formData.name = null
    formData.position_id = null
    formData.hiring_date = null
    formData.gender = null
    formData.heigth = null
    formData.size_cloth = null
    formData.size_head = null
    formData.size_shoes = null
    formData.organization_id = null
}

watch(() => pageData.dialog, (dialog) => {
    if (dialog) getSelectedEmploye()
    else clear()
})

const toggle = () => pageData.dialog = true
defineExpose({ toggle })
</script>
<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="768" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
            </template>
            <v-card>

                <v-form ref="form" fast-fail class="bg-white" @submit.prevent="addEmploye" @vnode-mounted="form.reset()">
                    <v-card-title class="bg-blue-grey-lighten-5">
                        <span>Xodim kiritish</span>
                    </v-card-title>
                    <v-card-text class="pa-0">
                        <v-container>
                            <v-row>
                                <v-col cols="12" class="pt-0">
                                    <v-text-field
                                        @input="inputTableNumber"
                                        :loading="pageData.inputLoading"
                                        color="teal"
                                        :rules="pageData.rules"
                                        label="Tabel raqam"
                                        variant="underlined"
                                        hide-details="auto"
                                        v-model="formData.table_number"
                                        type="number"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" class="pt-0">
                                    <v-text-field
                                        color="teal"
                                        :rules="pageData.rules"
                                        label="F.I.SH"
                                        variant="underlined"
                                        hide-details="auto"
                                        v-model="formData.name"
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
                                    />
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
                                        :rules="pageData.rules"
                                        item-value="id"
                                    />
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field
                                        color="teal"
                                        label="Ishga qabul qilingan sana"
                                        variant="underlined" hide-details="auto"
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
                                    <v-radio-group color="teal" class="" small v-model="formData.gender" hide-details="auto" :rules="pageData.rules">
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
                        <v-btn color="teal" variant="text" type="submit">
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
const emit = defineEmits(['addEmploye'])

const form = ref()

const pageData = reactive({
    dialog: false,
    organizations: null,
    positions: null,
    inputLoading: false,
    rules: [(value) => [null, ""].includes(value) ? 'toldiring' : true ]
})

const formData = reactive({
    table_number: null,
    name: null,
    position_id: null,
    hiring_date: null,

    gender: false,
    heigth: null,
    size_cloth: null,
    size_head: null,
    size_shoes: null,

    organization_id: null,
})

async function addEmploye() {
    const { valid } = await form.value.validate()
    if(valid == false) return
    
    axios.post('employe', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addEmploye', data)
    })
}


function inputTableNumber(){
    if(formData.table_number.length == 5){
        pageData.inputLoading = true
        getEmployeData()
    }
}


function getEmployeData(){
    axios.get(`employe/getdata/${formData.table_number}`).then(({data})=> {
        formData.name = data.name
        formData.organization_id = data.organization_id
        setTimeout(() => pageData.inputLoading = false, 1000)
    }).catch(() => {
        pageData.inputLoading = false
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
</script>
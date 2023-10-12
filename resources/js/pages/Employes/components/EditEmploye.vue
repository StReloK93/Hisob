<template>
    <v-dialog v-model="pageData.dialog" persistent width="768" location="right">
        <v-card>
            <v-form ref="form" class="bg-white" @submit.prevent="editEmploye">
                <v-card-title> Xodimni tahrirlash </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" class="pt-0">
                                <v-text-field
                                    class="mb-2"
                                    :rules="pageData.rules"
                                    label="Tabel raqam"
                                    v-model="formData.table_number"
                                    type="number"
                                />
                                <v-text-field class="mb-2" :rules="pageData.rules" label="F.I.SH" v-model="formData.name"/>
                                <v-autocomplete
                                    class="mb-2"
                                    :items="pageData.organizations"
                                    v-model="formData.organization_id"
                                    label="Ish joyi" 
                                    item-title="short_name"
                                    item-value="id"
                                    :rules="pageData.rules"
                                />
                                <v-autocomplete
                                    class="mb-2"
                                    :items="pageData.positions" 
                                    v-model="formData.position_id"
                                    label="Meyoriy hujjatdagi lavozimi (kasbi)"
                                    item-title="name"
                                    :rules="pageData.rules"
                                    item-value="id"
                                />
                                <v-text-field class="mb-2" label="Lavozimi (kasbi)" v-model="formData.profession" :rules="pageData.rules"/>
                                <v-text-field class="mb-2" label="Ushbu lavozim (kasb)ga tayinlangan kuni" v-model="formData.hiring_date" type="date" :rules="pageData.rules"/>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field class="mb-2" label="Bo'yi" v-model="formData.heigth" />
                                <v-text-field class="mb-2" label="Kiyim o'lchami" v-model="formData.size_cloth"/>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field class="mb-2" label="Bosh o'lchami" v-model="formData.size_head" />
                                <v-text-field class="mb-2" label="Oyoq kiyim o'lchami" v-model="formData.size_shoes"/>
                            </v-col>
                            <v-col cols="12">
                                <v-radio-group small v-model="formData.gender" :rules="pageData.rules">
                                    <v-radio label="Erkak" :value="true"></v-radio>
                                    <v-radio label="Ayol" :value="false"></v-radio>
                                </v-radio-group>
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
import { reactive, watch, ref } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['editEmploye'])
const { current } = defineProps(['current'])

const form = ref()

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
    profession: null,
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

watch(() => pageData.dialog, (dialog) => {
    if (dialog) getSelectedEmploye()
    else form.value.reset()
})

const toggle = () => pageData.dialog = true
defineExpose({ toggle })
</script>
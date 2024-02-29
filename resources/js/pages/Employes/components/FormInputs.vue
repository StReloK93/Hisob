<template>
    <v-row>
        <v-col cols="12" class="pt-0">
            <v-text-field class="mb-2" @input="inputTableNumber" :loading="pageData.inputLoading" :rules="rules"
                label="Tabel raqam" v-model="formData.table_number" type="number" />
            <v-text-field class="mb-2" :rules="rules" label="F.I.SH" v-model="formData.name" />
            <v-autocomplete class="mb-2" v-if="pageData.organizations" :items="pageData.organizations" v-model="formData.organization_id" label="Ish joyi"
                item-title="short_name" item-value="id" :rules="rules" />
            <v-autocomplete class="mb-2" v-if="pageData.positions" :items="pageData.positions" v-model="formData.position_id"
                label="Meyoriy hujjatdagi lavozimi (kasbi)" item-title="name" :rules="rules" item-value="id" />
            <v-text-field class="mb-2" label="Lavozimi (kasbi)" v-model="formData.profession" :rules="rules" />
            <v-text-field class="mb-2" label="Ushbu lavozim (kasb)ga tayinlangan kuni" v-model="formData.hiring_date"
                type="date" :rules="rules" />
        </v-col>
        <v-col cols="6">
            <v-text-field class="mb-2" label="Bo'yi" v-model="formData.heigth" />
            <v-text-field class="mb-2" label="Kiyim o'lchami" v-model="formData.size_cloth" />
        </v-col>
        <v-col cols="6">
            <v-text-field class="mb-2" label="Bosh o'lchami" v-model="formData.size_head" />
            <v-text-field class="mb-2" label="Oyoq kiyim o'lchami" v-model="formData.size_shoes" />
        </v-col>
        <v-col cols="12">
            <v-radio-group small v-model="formData.gender" :rules="rules">
                <v-radio label="Erkak" :value="true"></v-radio>
                <v-radio label="Ayol" :value="false"></v-radio>
            </v-radio-group>
        </v-col>
    </v-row>
</template>

<script setup lang="ts">
const { formData } = defineProps(['formData', 'pageData'])
import { rules } from '@/modules/helpers'
import axios from '@/modules/axios'
import { reactive } from 'vue';

const pageData = reactive({
    organizations: null,
    positions: null,
    inputLoading: false
})

function inputTableNumber() {
    if (formData.table_number.length == 5) {
        pageData.inputLoading = true
        getEmployeData()
    }
}


axios.all([axios.get('accessOrganizations'), axios.get('position')])
    .then(axios.spread(({ data: organizations }, { data: positions }) => {
        pageData.organizations = organizations
        pageData.positions = positions
    }))

function getEmployeData() {
    axios.get(`employe/getdata/${formData.table_number}`).then(({ data }) => {
        formData.name = data.name
        formData.organization_id = data.organization_id
        formData.profession = data.profession
        formData.hiring_date = data.hiring_date
        setTimeout(() => pageData.inputLoading = false, 1000)
    }).catch(() => {
        pageData.inputLoading = false
    })
}
</script>
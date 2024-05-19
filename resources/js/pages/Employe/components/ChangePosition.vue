<template>
    <v-dialog v-model="pageData.dialog" width="992" scrollable persistent>
        <template v-slot:activator="{ props }">
            <v-btn v-bind="props" class="ml-5" variant="tonal">
                Lavozimni o'zgartirish
            </v-btn>
        </template>
        <CustomForm :submitMethod="onSubmit" @close="pageData.dialog = false" title="Lavozimni o'zgartirish" height="700px">
            <v-autocomplete class="mb-2" v-if="pageData.organizations" :items="pageData.organizations"
                v-model="formData.organization_id" label="Ish joyi" item-title="short_name" item-value="id"
                :rules="rules" />
            <v-autocomplete class="mb-2" v-if="pageData.positions" :items="pageData.positions"
                v-model="formData.position_id" label="Meyoriy hujjatdagi lavozimi (kasbi)" item-title="name" :rules="rules"
                item-value="id" />
            <v-text-field class="mb-2" label="Lavozimi (kasbi)" v-model="formData.profession" :rules="rules" />
            <v-text-field class="mb-2" label="Ushbu lavozim (kasb)ga tayinlangan kuni" v-model="formData.hiring_date"
                type="date" :rules="rules" />
        </CustomForm>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import { rules } from '@/modules/helpers'
import axios from '@/modules/axios'
const props = defineProps(['employe_id'])
const emit = defineEmits(['changePosition'])
const pageData = reactive({
    dialog: false,
    organizations: null,
    positions: null,
})


const formData = reactive({
    organization_id: null,
    position_id: null,
    profession: null,
    hiring_date: null,
})


async function onSubmit() {
    await axios.post(`employe/change-position/${props.employe_id}`, formData).then(({ data }) => {
        emit('changePosition', data)
        pageData.dialog = false
    })
}


axios.all([axios.get('accessOrganizations'), axios.get('position')])
    .then(axios.spread(({ data: organizations }, { data: positions }) => {
        pageData.organizations = organizations
        pageData.positions = positions
    }))






</script>
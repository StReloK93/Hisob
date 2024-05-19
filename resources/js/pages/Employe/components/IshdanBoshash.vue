<template>
    <v-dialog v-model="pageData.dialog" width="992" scrollable persistent>
        <template v-slot:activator="{ props }">
            <v-btn v-bind="props" class="ml-5" variant="tonal">
                Ishdan bo'shash
            </v-btn>
        </template>
        <CustomForm :submitMethod="onSubmit" @close="pageData.dialog = false" title="Ishdan bo'shash" height="700px">
            <v-text-field class="mb-2" label="Ishdan boshagan kuni" type="date"  v-model="formData.ishdan_boshagan_kuni" :rules="rules" />
            <v-text-field class="mb-2" label="Buyruq raqami" v-model="formData.buyruq_raqami"  :rules="rules" />
        </CustomForm>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import { rules } from '@/modules/helpers'
import axios from '@/modules/axios'
const props = defineProps(['employe_id'])
const emit = defineEmits(['leave'])
const pageData = reactive({
    dialog: false,
    organizations: null,
    positions: null,
})


const formData = reactive({
    ishdan_boshagan_kuni: null,
    buyruq_raqami: null,
})


async function onSubmit() {
    await axios.post(`employe-ishdan-boshash/${props.employe_id}`, formData).then(({ data }) => {
        emit('leave', data)
        pageData.dialog = false
    })
}

</script>
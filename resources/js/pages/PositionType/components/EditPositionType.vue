<template>
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <v-form @submit.prevent="editPositionType" ref="formTag" @vue:mounted="onMountedForm">
            <v-card class="bg-white">
                <v-card-title> Ish turini tahrirlash </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" class="pt-0">
                                <v-text-field class="mb-2" label="Tartib raqami" v-model="formData.code" :rules="pageData.rules"/>
                                <v-text-field class="mb-2" label="Nomi" v-model="formData.name" :rules="pageData.rules"/>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <FormFooter @close="pageData.dialog = false"/>
            </v-card>
        </v-form>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive, ref } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['editPositionType'])
const { current } = defineProps(['current'])
const formTag = ref()

const pageData = reactive({
    dialog: false,
    rules: [(value) => value == null || value == "" ? 'toldiring' : true],
})

const formData = reactive({ name: null, code: null })

async function editPositionType() {
    const { valid } = await formTag.value.validate()
    if (valid == false) return

    axios.patch(`position_type/${current.selected}`, formData).then(({ data }) => {
        pageData.dialog = false
        emit('editPositionType', data)
    })
}

async function onMountedForm() {
    formTag.value.reset()
    axios.get(`position_type/${current.selected}`).then(({ data }) => {
        formData.name = data.name
        formData.code = data.code
    })
}


const toggle = () => pageData.dialog = true
defineExpose({ toggle })
</script>
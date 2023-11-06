<template>
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <CustomForm :submitMethod="editWorkingCondition" @close="pageData.dialog = false" @vue:mounted="onMountedForm"
            title="Mehnat sharoitini tahrirlash">
            <v-row>
                <v-col cols="12" class="pt-0">
                    <v-text-field label="Nomi" v-model="formData.name" :rules="rules" />
                </v-col>
            </v-row>
        </CustomForm>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import axios from '@/modules/axios'
import { rules } from '@/modules/helpers'
const emit = defineEmits(['editWorkingCondition'])
const { current } = defineProps(['current'])

const pageData = reactive({
    dialog: false,
})

const formData = reactive({ name: null })

async function editWorkingCondition() {
    await axios.patch(`working_condition/${current.selected}`, formData).then(({ data }) => {
        pageData.dialog = false
        emit('editWorkingCondition', data)
    })
}

async function onMountedForm() {
    axios.get(`working_condition/${current.selected}`).then(({ data }) => {
        formData.name = data.name
    })
}


const toggle = () => pageData.dialog = true
defineExpose({ toggle })
</script>
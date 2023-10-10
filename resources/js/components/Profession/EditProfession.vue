<template>
    <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
        <v-form @submit.prevent="editProfessionType" ref="formTag" @vue:mounted="onMountedForm">
            <v-card class="bg-white">
                <v-card-title class="bg-blue-grey-lighten-5">
                    <span>Mahsulot kiritish formasi</span>
                </v-card-title>
                <v-card-text class="pa-0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" class="pt-0">
                                <v-text-field color="teal" label="Nomi" v-model="formData.name" variant="underlined"
                                    hide-details="auto" :rules="pageData.rules" />
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
        </v-form>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive, ref } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['editProfessionType'])
const { current } = defineProps(['current'])
const formTag = ref()

const pageData = reactive({
    dialog: false,
    rules: [(value) => value == null || value == "" ? 'toldiring' : true],
})

const formData = reactive({ name: null })

async function editProfessionType() {
    const { valid } = await formTag.value.validate()
    if (valid == false) return

    axios.patch(`profession_type/${current.selected}`, formData).then(({ data }) => {
        pageData.dialog = false
        emit('editProfessionType', data)
    })
}

async function onMountedForm() {
    formTag.value.reset()
    axios.get(`profession_type/${current.selected}`).then(({ data }) => {
        formData.name = data.name
    })
}


const toggle = () => pageData.dialog = true
defineExpose({ toggle })
</script>
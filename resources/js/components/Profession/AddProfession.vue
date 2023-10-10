<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
            </template>
            <v-form @submit.prevent="addProfessionType" ref="formTag" @vue:mounted="formTag.reset()">
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
    </v-row>
</template>

<script setup lang="ts">
import { reactive, ref } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['addProfessionType'])
const formTag = ref()

const pageData = reactive({
    dialog: false,
    rules: [(value) => value == null || value == "" ? 'toldiring' : true],
})

const formData = reactive({ name: null })

async function addProfessionType() {
    const { valid } = await formTag.value.validate()
    if (valid == false) return

    axios.post('profession_type', formData).then(({ data }) => {
        pageData.dialog = false
        emit('addProfessionType', data)
    })
}
</script>
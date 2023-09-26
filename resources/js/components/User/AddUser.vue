<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="512" location="right">
            <template v-slot:activator="{ props }">
                <v-btn icon="mdi-plus" color="teal" v-bind="props"></v-btn>
            </template>
            <v-card>
                <v-form ref="formTag" fast-fail class="bg-white" @submit.prevent="addUser">
                    <v-card-title class="bg-blue-grey-lighten-5">
                        <span>Xodim kiritish</span>
                    </v-card-title>
                    <v-card-text class="pa-0">
                        <v-container>
                            <v-row>
                                <v-col cols="12" class="pt-0">
                                    <v-text-field
                                        :loading="pageData.inputLoading"
                                        color="teal"
                                        :rules="pageData.rules"
                                        label="F.I.O"
                                        variant="underlined"
                                        hide-details="auto"
                                        v-model="formData.name"
                                        type="number"
                                    ></v-text-field>
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
const emit = defineEmits(['addUser'])

function addUser(){

}

const formTag = ref()

const pageData = reactive({
    dialog: false,
    organizations: null,
    positions: null,
    inputLoading: false,
    rules: [(value) => value == null || value == "" ? 'toldiring' : true ]
})

const formData = reactive({
    name: null,
    login: null,
    organizations: [],
})

function clear(){
    formData.name = null
    formData.login = null
    formData.organizations = []

}

watch(() => pageData.dialog, (current) => {
    if (current) clear()
})
</script>
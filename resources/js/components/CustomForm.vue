<template>
    <v-form ref="formTag" @submit.prevent="Submit">
        <v-card class="bg-white">
            <v-card-title> {{ title }} </v-card-title>
            <v-divider></v-divider>
            <v-card-text class="pa-0" :style="[height ? `max-height: ${height}` : '']">
                <v-container>
                    <slot></slot>
                </v-container>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue-gray-1" type="button" @click="$emit('close')">
                    Yopish
                </v-btn>
                <v-btn type="submit" :loading="pageData?.formLoading">
                    Saqlash
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-form>
</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import { reactive, ref } from 'vue'
const { submitMethod, title, height } = defineProps(['submitMethod', 'title', 'height'])

const formTag = ref()

const pageData = reactive({
    formLoading: false,
})

async function Submit() {
    const { valid } = await formTag.value.validate()
    if (valid == false || pageData.formLoading) return
    pageData.formLoading = true


    submitMethod().then(() => {
        pageData.formLoading = false
    })
}

onMounted(() => {
    formTag.value.reset()
})
</script>
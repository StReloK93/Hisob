<template>
    <v-dialog v-model="pageData.dialog" width="992" scrollable persistent>
        <template v-slot:activator="{ props }">
            <v-btn v-bind="props" icon="mdi-image-area-close"/>
        </template>
        <form @submit.prevent="saveImages">
            <v-card @vue:mounted="customMounted" @vue:unmounted="customUnmounted">
                <v-card-title>Ilovalar</v-card-title>
                <v-divider></v-divider>
                <v-card-text style="height: 600px;">
                    <UploadImage :formData="pageData" @onload="onload"/>
                </v-card-text>
                <v-divider></v-divider>
                <FormFooter :pageData="pageData" @close="pageData.dialog = false"/>
            </v-card>
        </form>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import UploadImage from '@/components/UploadImage.vue'
import axios from '@/modules/axios'
import { ref } from 'vue';
const { employe } = defineProps(['employe'])
const emit = defineEmits(['saved'])

const pageData = reactive({
    dialog: false,
    images: [],
    formLoading: false,
})

const images = ref([])

function customUnmounted(){
    pageData.images = []
}

function onload(imagelist){
    images.value = imagelist
}

function saveImages(){
    if(pageData.formLoading) return
    pageData.formLoading = true
    const formData = new FormData()
    
    images.value.forEach(item => {
        if(item.image) formData.append('imgs[]', item.image)
        else formData.append('images[]', item.id)
    });

    axios.post(`employe_images/${employe.id}`, formData).then(({data}) => {
        emit('saved', data)
        pageData.dialog = false
        pageData.formLoading = false
    }).catch(() => pageData.formLoading = false)
}


function customMounted(){
    axios.get(`employe_images/${employe.id}`).then(({ data }) => {
        pageData.images = data
    })
}
</script>
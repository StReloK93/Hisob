<template>
    <v-dialog v-model="pageData.dialog" scrollable width="992" location="right">
        <v-form ref="formTag" @submit.prevent="editDocument">
            <v-card class="bg-white">
                <v-card-title> Normaviy hujjatni tahrirlash </v-card-title>
                <v-divider></v-divider>
                <v-card-text class="pa-0" style="height: 700px;">
                    <v-container>
                        <v-row>
                            <v-col cols="6" class="pt-0">
                                <v-textarea class="mb-2" label="Nomi" v-model="formData.name" :rules="pageData.rules"/>
                                <v-text-field class="mb-2" label="Hujjat tasdiqlangan sana" v-model="formData.confirm_date" type="date" :rules="pageData.rules" />
                                <v-file-input class="mb-2" chips v-model="formData.files" multiple label="Normaviy hujjatlar" :rules="pageData.rules" />
                                <v-textarea class="mb-2" label="Izoh" v-model="formData.description"/>
                            </v-col>
                            <v-col cols="6">
                                <h2 class="text-subtitle-1 d-flex justify-space-between align-center mb-2">
                                    <span> Ish turlari </span>
                                    <v-btn density="comfortable" icon="mdi-plus" @click="addPositionType" />
                                </h2>
                                <section class="d-flex flex-wrap bg-grey-lighten-4 mb-1" v-for="(positionType,index) in formData.positionTypes">
                                    <v-col cols="12" class="pt-1 pb-0 d-flex justify-end">
                                        <v-btn color="red" density="compact" @click="deletePositionType(index)" variant="text" icon="mdi-close"></v-btn>
                                    </v-col>
                                    <v-col cols="4" class="pb-1 pt-0">
                                        <v-text-field density="compact" class="mb-2" label="Tartib raqami" :hideDetails="true" v-model="positionType.code" :rules="pageData.rules"/>
                                    </v-col>
                                    <v-col cols="8" class="pb-1 pt-0">
                                        <v-text-field density="compact" class="mb-2" label="Nomi" :hideDetails="true" v-model="positionType.name" :rules="pageData.rules"/>
                                    </v-col>
                                </section>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-divider></v-divider>
                <FormFooter @close="pageData.dialog = false"/>
            </v-card>
        </v-form>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive, watch, ref } from 'vue'
import axios from '@/modules/axios'
const { current } = defineProps(['current'])
const emit = defineEmits(['editDocument'])
const pageData = reactive({
    dialog: false,
    rules: [(value) => [null, ""].includes(value) ? 'toldiring' : true]
})

const formData = reactive({
    name: null,
    confirm_date: null,
    description: null,
    positionTypes: [],
    files: []
})

function addPositionType(){
    formData.positionTypes.push({
        name: "",
        code: "",
    })
}

function deletePositionType(index){
    formData.positionTypes.splice(index, 1)
}



const formTag = ref()
async function editDocument() {
    const { valid } = await formTag.value.validate()
    if (valid == false) return

    const Form = new FormData()
    Form.append('name', formData.name)
    Form.append('confirm_date', formData.confirm_date)
    Form.append('description', formData.description == null? "" : formData.description)
    formData.positionTypes.forEach(type => Form.append('positionTypes[]', JSON.stringify(type)))

    formData.files.forEach(file => {
        if(file.type) Form.append('files[]', file)
        else Form.append('files[]', file.id)
    })
    
    axios.post(`document/${current.selected}`, Form).then(({ data }) => {
        pageData.dialog = false
        emit('editDocument', data)
    })
}

function getSelectedDocument(current){
    axios.get(`/document/${current}`).then(({ data }) => {
        formData.name = data.name
        formData.confirm_date = data.confirm_date
        formData.description = data.description
        formData.positionTypes = data.position_types
        console.log(data.positionTypes)
        
        data.files.forEach((file) => file.name = file.src)
        formData.files = data.files
    })
}

watch(() => pageData.dialog, (dialog) => {
    if (dialog) getSelectedDocument(current.selected)
    else formTag.value.reset()
})

const toggle = () => pageData.dialog = true
defineExpose({toggle})
</script>
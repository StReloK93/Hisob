<template>
    <v-row>
        <v-col cols="6" class="pt-0">
            <v-textarea class="mb-2" label="Nomi" v-model="formData.name" :rules="rules" />
            <v-text-field class="mb-2" label="Hujjat tasdiqlangan sana" v-model="formData.confirm_date" type="date"
                :rules="rules" />
            <v-file-input class="mb-2" chips v-model="formData.files" multiple label="Normaviy hujjatlar"
                :rules="rules" />
            <v-textarea class="mb-2" label="Izoh" v-model="formData.description" />
        </v-col>

        <v-col cols="6">
            <h2 class="text-subtitle-1 d-flex justify-space-between align-center mb-2">
                <span> Ish turlari </span>
                <v-btn density="comfortable" icon="mdi-plus" @click="addPositionType" />
            </h2>
            <section class="d-flex flex-wrap bg-grey-lighten-4 mb-1"
                v-for="(positionType, index) in formData.positionTypes">
                <v-col cols="12" class="pt-1 pb-0 d-flex justify-end">
                    <v-btn color="red" density="compact" @click="deletePositionType(index)" variant="text"
                        icon="mdi-close"></v-btn>
                </v-col>
                <v-col cols="4" class="pb-1 pt-0">
                    <v-text-field density="compact" class="mb-2" label="Tartib raqami" :hideDetails="true"
                        v-model="positionType.code" :rules="rules" />
                </v-col>
                <v-col cols="8" class="pb-1 pt-0">
                    <v-text-field density="compact" class="mb-2" label="Nomi" :hideDetails="true"
                        v-model="positionType.name" :rules="rules" />
                </v-col>
            </section>
        </v-col>
    </v-row>
</template>

<script setup lang="ts">
const { formData } = defineProps(['formData'])
import { rules } from '@/modules/helpers'


function addPositionType() {
    formData.positionTypes.push({ name: "", code: "" })
}

function deletePositionType(index) {
    formData.positionTypes.splice(index, 1)
}
</script>
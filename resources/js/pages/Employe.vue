<template>
    <section v-if="employe" class="d-flex flex-column">
        <Breadcrumbs :user="{ name: employe.name }"></Breadcrumbs>
        <v-spacer class="px-4">
            <section class="bg-white pa-6 h-100 d-flex">
                <main class="flex-fill d-flex flex-column">
                    <div class="d-flex align-center">
                        <span  class="text-blue-grey-darken-3 text-h5">
                            {{ employe.name }}
                        </span>
                        <span class="text-caption ml-10 text-grey-lighten-1 d-inline-flex align-center">
                            <v-icon class="mr-2">mdi-map-marker</v-icon> {{ employe.organization.short_name }}
                        </span>
                    </div>
                    <div v-if="position" class="text-teal">
                        {{ position.name }}
                    </div>
                    <div v-else class="text-red">
                        Lavozim biriktirilmagan
                    </div>
                    <v-tabs v-model="tab" class="mt-12" color="cyan">
                        <v-tab value="one">Oldi-berdi varaqasi</v-tab>
                        <v-tab value="two">Lavozimga tayinlangan buyumlar</v-tab>
                    </v-tabs>
                    <v-divider color="cyan -top-1px"></v-divider>
                    <v-window v-model="tab" class="flex-grow-1 py-4">
                        <v-window-item value="one" class="flex-grow-1">
                            Olingan buyumlar
                        </v-window-item>

                        <v-window-item value="two" class="flex-grow-1">
                            <AgGridVue
                                :headerHeight="34" 
                                class="ag-theme-material h-100"
                                :columnDefs="columnDefs"
                                :rowData="position?.products"
                            />
                        </v-window-item>
                    </v-window>
                </main>
            </section>
        </v-spacer>
    </section>
</template>

<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue'
import axios from '@/modules/axios'
import { AgGridVue } from 'ag-grid-vue3'
import { ref, reactive } from 'vue'
const { id } = defineProps(['id'])

const employe = ref(null)
const tab = ref(null)
const position = ref(null)
axios.get(`employe/${id}`).then(({ data: employer }) => {
    employe.value = employer
    getPosition(employer.employe_position.at(-1))
})

function getPosition(selectedPosition){
    axios.get(`position/${selectedPosition?.position.id}`).then(({data}) => {
        position.value = data
    })
}

const columnDefs = reactive([
    { field: "product.name", headerName: 'Nomi', flex: 1 },
    { field: "product.expiration_date", headerName: 'Yaroqlilik muddati', flex: 1 },
    { field: "count", headerName: 'soni'},
]);
</script>
<style src="../../css/ag-grid.css"></style>
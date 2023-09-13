<template>
    <section v-if="employe" class="d-flex flex-column">
        <Breadcrumbs :user="{ name: employe.first_name + ' ' + employe.last_name }"></Breadcrumbs>
        <v-spacer class="px-4">
            <section class="bg-white pa-6 h-100 d-flex">
                <main class="flex-fill d-flex flex-column">
                    <div class="d-flex align-center">
                        <span class="text-blue-grey-darken-3 text-h5">
                            {{ employe.last_name }} {{ employe.first_name }}
                        </span>
                        <span class="text-caption ml-10 text-grey-lighten-1 d-inline-flex align-center">
                            <v-icon class="mr-2">mdi-map-marker</v-icon> {{ employe.organization.short_name }}
                        </span>
                    </div>
                    <div class="text-teal">
                        {{ employe.position.name }}
                    </div>

                    <v-tabs v-model="tab" class="mt-12" color="cyan">
                        <v-tab value="one">Oldi-berdi varaqasi</v-tab>
                        <v-tab value="two">Lavozimga tayinlangan buyumlar</v-tab>
                    </v-tabs>
                    <v-divider color="cyan -top-1px"></v-divider>
                    <v-window v-model="tab" class="flex-grow-1 py-4">
                        <v-window-item value="one" class="flex-grow-1">
                            <AgGridVue
                                :headerHeight="34" 
                                class="ag-theme-material h-100"
                                :columnDefs="columnDefs"
                                :rowData="employe.position.products"
                            />
                        </v-window-item>

                        <v-window-item value="two" class="flex-grow-1">
                            asdawdasdawda
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
axios.get(`employe/${id}`).then(({ data: employer }) => {
    employe.value = employer
})

const columnDefs = reactive([
    { field: "product.name", headerName: 'Nomi', flex: 1 },
    { field: "product.expiration_date", headerName: 'Yaroqlilik muddati', flex: 1 },
    { field: "count", headerName: 'soni'},
]);
</script>
<style src="../../css/ag-grid.css"></style>
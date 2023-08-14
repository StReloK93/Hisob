<template>
    <section class="d-flex flex-column">
        <Breadcrumbs></Breadcrumbs>
        <v-spacer class="px-4">
            <AgGridVue
                class="ag-theme-material h-100"
                :columnDefs="columnDefs" :rowData="position"
                @rowClicked=""
                animateRows="true"
            />
        </v-spacer>
    </section>
</template>

<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue'
import { reactive, ref } from "vue"
import axios from '@/modules/axios'
import { AgGridVue } from "ag-grid-vue3"
const columnDefs = reactive([
    { field: "id", headerName: 'Kod', width: 80},
    { field: "name", headerName: 'Tabel raqami', flex: 1 },
    { field: "isActive", headerName: 'Faolligi' },

]);

const position = ref([])
axios.get('position').then(({ data }) => position.value = data)
</script>
<style src="../../css/ag-grid.css"></style>
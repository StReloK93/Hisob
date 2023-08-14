<template>
    <main class="d-flex flex-column">
        <Breadcrumbs></Breadcrumbs>
        <AddEmploye @addEmploye="addEmploye"></AddEmploye>
        <v-spacer class="px-4">
            <AgGridVue
                class="ag-theme-material h-100"
                :columnDefs="columnDefs"
                :rowData="employes"
                @grid-ready="(params) => pageData.gridApi = params.api"
                @rowClicked="(selected) => router.push({ name: 'employe', params: { id: selected.data.id } })"
                animateRows="true"
            />
        </v-spacer>
    </main>
</template>

<script setup lang="ts">
import axios from '@/modules/axios'
import Breadcrumbs from '@/components/Breadcrumbs.vue'
import AddEmploye from '@/components/AddEmploye.vue'
import { reactive, ref } from "vue"
import { AgGridVue } from "ag-grid-vue3"
import { gender } from '@/modules/gender'
import { useRouter } from 'vue-router'


const pageData = reactive({gridApi: null})

function addEmploye(employe){
    pageData.gridApi.applyTransaction({add: [employe],index: 0})
}

const router = useRouter()
const columnDefs = reactive([
    {
        headerName: 'F.I.SH',
        cellRenderer: ({ data: employe }) => {
            return `${employe.last_name} ${employe.first_name.charAt(0)}.${employe.second_name.charAt(0)}`
        }
    },
    { field: "table_number", headerName: 'Tabel raqami', flex: 1 , sortable: true,},
    { field: "organization.short_name", headerName: 'Ish joyi' },
    { field: "position.name", headerName: 'Lavozimi' },
    { field: "hiring_date", headerName: 'Ishga qabul kuni' },
    { field: "gender", headerName: 'Jinsi', cellRenderer: (data) => gender(data.value) },
]);

const employes = ref([])
axios.get('employe').then(({ data }) => employes.value = data)
</script>
<style src="../../css/ag-grid.css"></style>
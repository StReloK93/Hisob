<template>
    <main class="d-flex flex-column">
        <div class="d-flex justify-space-between items-center">
            <Breadcrumbs></Breadcrumbs>
            <AddEmploye @addEmploye="addEmploye"></AddEmploye>
            <EditEmploye @editEmploye="editEmploye" ref="editComponent" :current="pageData"></EditEmploye>
        </div>
        <v-spacer class="px-4">
            <AgGridVue
                class="ag-theme-material h-100"
                :getRowId="({data}) => data.id"
                :columnDefs="columnDefs"
                :rowData="employes"
                @grid-ready="(params) => pageData.gridApi = params.api"
                
                animateRows="true"
            />
        </v-spacer>
    </main>
</template>
<!-- @rowClicked="(selected) => router.push({ name: 'employe', params: { id: selected.data.id } })" -->
<script setup lang="ts">
import axios from '@/modules/axios'
import IconEdit from '@/components/AgGrid/IconEdit.vue'
import Breadcrumbs from '@/components/Breadcrumbs.vue'
import AddEmploye from '@/components/Employe/AddEmploye.vue'
import EditEmploye from '@/components/Employe/EditEmploye.vue'
import { reactive, ref } from "vue"
import { AgGridVue } from "ag-grid-vue3"
import { gender } from '@/modules/gender'
import { useRouter } from 'vue-router'


const editComponent = ref()

const pageData = reactive({
    gridApi: null,
    selected: null
})

function addEmploye(employe){
    pageData.gridApi.applyTransaction({add: [employe],addIndex: 0})
}

function editEmploye(employe){
    const rowNode = pageData.gridApi.getRowNode(employe.id)
    rowNode.setData(employe)
}

const router = useRouter()
const columnDefs = reactive([
    {
        headerName: 'F.I.SH',
        cellRenderer: ({ data: employe }) => {
            return `${employe.last_name} ${employe.first_name.charAt(0)}.${employe.second_name.charAt(0)}`
        }
    },
    { field: "table_number", headerName: 'Tabel raqami', flex: 1 , sortable: true},
    { field: "organization.short_name", headerName: 'Ish joyi' , sortable: true },
    { field: "position.name", headerName: 'Lavozimi' , sortable: true },
    { field: "hiring_date", headerName: 'Ishga qabul kuni' , sortable: true },
    { field: "gender", headerName: 'Jinsi', cellRenderer: (data) => gender(data.value) , sortable: true },
    {
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2' ,'bg-gray-100'],
        headerName: '',
        width: 60,
        cellRenderer: IconEdit,
        headerClass: ['px-2'],
        onCellClicked: ({data}) => {
            pageData.selected = data.id
            editComponent.value.toggle()
        }
    },
]);

const employes = ref([])
axios.get('employe').then(({ data }) => employes.value = data)
</script>
<style src="../../css/ag-grid.css"></style>
<template>
    <section class="d-flex flex-column">
        <div class="d-flex justify-space-between items-center">
            <Breadcrumbs></Breadcrumbs>
            <AddOrganization @addOrganization="addOrganization" />
            <EditOrganization @editOrganization="editOrganization" ref="editComponent" :current="pageData" />
        </div>
        <v-spacer class="px-4">
            <AgGridVue
                :defaultColDef="{sortable: true}"
                :headerHeight="34"
                class="ag-theme-material h-100"
                :getRowId="({data}) => data.id"
                :columnDefs="columnDefs"
                :rowData="pageData.organization"
                @grid-ready="(params) => pageData.gridApi = params.api"
                animateRows="true"
            />
        </v-spacer>
    </section>
</template>

<script setup lang="ts">
import IconEdit from '@/components/AgGrid/IconEdit.vue'
import Button from '@/components/AgGrid/Button.vue'

import AddOrganization from './components/AddOrganization.vue'
import EditOrganization from './components/EditOrganization.vue'

import { reactive, ref } from "vue"
import axios from '@/modules/axios'

const editComponent = ref()

const pageData = reactive({
    gridApi: null,
    organization: [],
    selected: null
})

function addOrganization(organization){
    pageData.gridApi.applyTransaction({add: [organization]})
}

function editOrganization(organization){
    const rowNode = pageData.gridApi.getRowNode(organization.id)
    rowNode.setData(organization)
}


const columnDefs = reactive([
    { field: "id", headerName: '№', width: 65 },
    { field: "name", headerName: 'Nomi', flex: 1 },
    { field: "short_name", headerName: 'Qisqa nomi', flex: 1 },
    {
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2' ,'bg-gray-100'],
        field: "isActive",
        headerName: 'Faolligi',
        cellRenderer: Button,
        width: 60,
        headerClass: ['px-2'],
        onCellClicked: (params) => {
            const current = +
            axios.post(`organization/set_activate/${params.data.id}`, { active: !params.value }).then(() => {
                params.node.setDataValue('isActive', !params.value)
            })
        }
    },
    {
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2' ,'bg-gray-100'],
        headerName: '',
        width: 60 ,
        cellRenderer: IconEdit,
        headerClass: ['px-2'],
        onCellClicked: ({ data }) => {
            pageData.selected = data.id
            editComponent.value.toggle()
        }
    },
]);

axios.get('organization').then(({ data }) => pageData.organization = data)
</script>
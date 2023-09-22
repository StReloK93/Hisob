<template>
    <section class="d-flex flex-column">
        <div class="d-flex justify-space-between items-center">
            <Breadcrumbs></Breadcrumbs>
            <!-- <AddOrganization @addOrganization="addOrganization" /> -->
            <!-- <EditOrganization @editOrganization="editOrganization" ref="editComponent" :current="pageData" /> -->
        </div>
        <v-spacer class="px-4">
            <AgGridVue
                class="ag-theme-material h-100"
                :getRowId="({data}) => data.id"
                :columnDefs="columnDefs"
                :rowData="pageData.users"
                @grid-ready="(params) => pageData.gridApi = params.api"
                animateRows="true"
            />
        </v-spacer>
    </section>
</template>

<script setup lang="ts">
import IconEdit from '@/components/AgGrid/IconEdit.vue'
import Button from '@/components/AgGrid/Button.vue'
import Breadcrumbs from '@/components/Breadcrumbs.vue'
import AddOrganization from '@/components/Organization/AddOrganization.vue'
import EditOrganization from '@/components/Organization/EditOrganization.vue'

import { reactive, ref } from "vue"
import axios from '@/modules/axios'
import { AgGridVue } from "ag-grid-vue3"

const editComponent = ref()

const pageData = reactive({
    gridApi: null,
    users: [],
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
    { field: "login", headerName: 'Login' },
    {
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2' ,'bg-gray-100'],
        field: "isActive",
        headerName: 'Faolligi',
        cellRenderer: Button,
        width: 60,
        headerClass: ['px-2'],
        onCellClicked: (params) => {
            const current = +!params.value
            axios.post(`organization/set_activate/${params.data.id}`, { active: current }).then(() => {
                params.node.setDataValue('isActive', current)
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

axios.get('users').then(({ data }) => pageData.users = data)
</script>
<style src="../../css/ag-grid.css"></style>
<template>
    <section class="d-flex flex-column">
        <div class="d-flex justify-space-between items-center">
            <Breadcrumbs></Breadcrumbs>
            <AddUser @addUser="addUser" />
            <EditUser @editUser="editUser" ref="editUserComp" :current="pageData" />
        </div>
        <v-spacer class="px-4">
            <AgGridVue
                :headerHeight="34"
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
import AddUser from '@/components/User/AddUser.vue'
import EditUser from '@/components/User/EditUser.vue'

import { reactive, ref } from "vue"
import axios from '@/modules/axios'
import { AgGridVue } from "ag-grid-vue3"

const editUserComp = ref()

const pageData = reactive({
    gridApi: null,
    users: [],
    selected: null
})


function addUser(){
    
}


function editUser(){
    
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
            editUserComp.value.toggle()
        }
    },
]);

axios.get('users').then(({ data }) => pageData.users = data)
</script>
<style src="../../css/ag-grid.css"></style>
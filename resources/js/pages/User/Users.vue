<template>
    <section class="d-flex flex-column">
        <div class="d-flex justify-space-between items-center">
            <Breadcrumbs></Breadcrumbs>
            <AddUser @addUser="addUser" />
            <EditUser @editUser="editUser" ref="editUserComp" :selected="pageData" />
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
import UserRoles from '@/components/AgGrid/UserRoles.vue'
import AddUser from './components/AddUser.vue'
import EditUser from './components/EditUser.vue'

import { reactive, ref } from "vue"
import axios from '@/modules/axios'

const editUserComp = ref()

const pageData = reactive({
    gridApi: null,
    users: [],
    user: null
})


function addUser(user){
    pageData.gridApi.applyTransaction({add: [user]})
}

function editUser(user){
    const rowNode = pageData.gridApi.getRowNode(user.id)
    rowNode.setData(user)
}

const columnDefs = reactive([
    { field: "id", headerName: '№', width: 65 },
    { field: "login", headerName: 'Login' },
    { field: "name", headerName: 'Nomi', flex: 1 },
    { field: "roles", headerName: 'Rollari', flex: 1, cellRenderer: UserRoles, valueFormatter: null },
    {
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2' ,'bg-gray-100'],
        headerName: '',
        width: 60 ,
        cellRenderer: IconEdit,
        headerClass: ['px-2'],
        onCellClicked: ({ data }) => {
            pageData.user = data
            editUserComp.value.toggle()
        }
    },
]);

axios.get('users').then(({ data }) => pageData.users = data)
</script>
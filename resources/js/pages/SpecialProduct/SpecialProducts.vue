<template>
    <section class="d-flex flex-column">
        <div class="d-flex justify-space-between items-center">
            <Breadcrumbs></Breadcrumbs>
        </div>
        <v-spacer class="px-4">
            <AgGridVue
                :headerHeight="34"
                class="ag-theme-material h-100"
                :getRowId="({data}) => data.id"
                :columnDefs="columnDefs"
                :rowData="pageData.specialProduct"
                @grid-ready="(params) => pageData.gridApi = params.api"
                animateRows="true"
            />
        </v-spacer>
    </section>
</template>

<script setup lang="ts">
import axios from '@/modules/axios'
import IconEdit from '@/components/AgGrid/IconEdit.vue'
import UserRoles from '@/components/AgGrid/UserRoles.vue'
import { reactive, ref } from "vue"

const editUserComp = ref()

const pageData:any = reactive({
    gridApi: null,
    users: [],
    user: null
})


axios.get(`employe_product`).then(({ data }) => {
    pageData.specialProduct = data
})


const columnDefs = reactive([
    { field: "id", headerName: '№', width: 65 },
    { field: "position_product.product.name", headerName: 'SH.X.V Nomi', flex: 1 , minWidth: 200},
    { field: "employe.name", headerName: "F.I.SH"},
    { field: "timer", headerName: "Q.Muddati (Kun)"},
    { field: "date_of_receipt", headerName: "Topshirildi"},
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
</script>
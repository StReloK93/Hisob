<template>
    <section class="d-flex flex-column">
        <div class="d-flex justify-space-between items-center">
            <Breadcrumbs></Breadcrumbs>
        </div>
        <v-spacer class="px-4">
            <AgGridVue
                :getRowClass="getRowClass"
                :headerHeight="34"
                :defaultColDef="{sortable: true}"
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
import { reactive } from "vue"

const pageData:any = reactive({
    gridApi: null,
    users: [],
    user: null
})

function getRowClass(params){
    if (params.data.timer < 30) return 'bg-red-lighten-4';
}

axios.get(`employe_product`).then(({ data }) => {
    pageData.specialProduct = data
})


const columnDefs = reactive([
    { field: "id", headerName: '№', width: 65 },
    { field: "position_product.product.name", headerName: 'SH.X.V Nomi', flex: 1 , minWidth: 200},
    { field: "position_product.expiration_date", headerName: 'Muddati (Oy)', flex: 1 , minWidth: 200},
    { field: "nomenclature", headerName: "Nomenklatura"},
    { field: "employe.name", headerName: "F.I.SH"},
    { field: "employe.organization.name", headerName: "Bo'linma nomi"},
    { field: "timer", headerName: "Q.Muddati (Kun)", width: 75},
    { field: "date_of_receipt", headerName: "Topshirildi"},
    
]);
</script>
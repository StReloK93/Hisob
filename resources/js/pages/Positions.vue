<template>
    <section class="d-flex flex-column">
        <div class="d-flex justify-space-between items-center">
            <Breadcrumbs></Breadcrumbs>
            <AddPosition @addPosition="addPosition"></AddPosition>
            <EditPosition @editPosition="editPosition" ref="editComponent" :current="pageData"></EditPosition>
        </div>
        <v-spacer class="px-4">
            <AgGridVue
                :headerHeight="34"
                class="ag-theme-material h-100"
                :getRowId="({data}) => data.id"
                :columnDefs="columnDefs"
                :rowData="pageData.positions"
                @grid-ready="(params) => pageData.gridApi = params.api"
                :animateRows="true"
            />
        </v-spacer>
    </section>
</template>

<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue'
import AddPosition from '@/components/Position/AddPosition.vue'
import EditPosition from '@/components/Position/EditPosition.vue'
import PositionProducts from '@/components/AgGrid/PositionProducts.vue'
import Button from '@/components/AgGrid/Button.vue'
import IconEdit from '@/components/AgGrid/IconEdit.vue'
import { reactive, ref } from "vue"
import axios from '@/modules/axios'
import { AgGridVue } from "ag-grid-vue3"

const editComponent = ref()

const pageData = reactive({
    gridApi: null,
    selected: null,
    positions: []
})


function addPosition(position){
    pageData.gridApi.applyTransaction({add: [position],addIndex: 0})
}

function editPosition(position){
    const rowNode = pageData.gridApi.getRowNode(position.id)
    rowNode.setData(position)
}

const columnDefs = reactive([
    { field: "id", headerName: '№', width: 65 },
    { field: "name", headerName: 'Nomi', width: 200 },
    {
        headerName: 'Biriktirilgan maxsulotlar',
        flex: 1,
        cellRenderer: PositionProducts,
    },
    {
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2' ,'bg-gray-100'],
        field: "isActive",
        headerName: 'Faolligi',
        cellRenderer: Button,
        width: 60,
        headerClass: ['px-2'],
        onCellClicked: (params) => {
            axios.post(`position/set_activate/${params.data.id}`, { active: !params.value }).then(() => {
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
        onCellClicked: ({data}) => {
            pageData.selected = data.id
            editComponent.value.toggle()
        }
    },
]);

axios.get('position').then(({ data }) => pageData.positions = data)
</script>
<style src="../../css/ag-grid.css"></style>
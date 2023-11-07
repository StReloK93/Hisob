<template>
    <section class="d-flex flex-column">
        <div class="d-flex justify-space-between items-center">
            <Breadcrumbs></Breadcrumbs>
            <AddDocument @addDocument="addDocument" />
            <EditDocument @editDocument="editDocument" ref="editComponent" :current="pageData" />
        </div>
        <v-spacer class="px-4">
            <AgGridVue
                :defaultColDef="{sortable: true}"
                :headerHeight="34"
                class="ag-theme-material h-100"
                :getRowId="({data}) => data.id"
                :columnDefs="columnDefs"
                :rowData="pageData.Document"
                @grid-ready="(params) => pageData.gridApi = params.api"
                animateRows="true"
            />
        </v-spacer>
    </section>
</template>

<script setup lang="ts">
import IconEdit from '@/components/AgGrid/IconEdit.vue'
import FileIcons from '@/components/AgGrid/FileIcons.vue'

import AddDocument from './components/AddDocument.vue'
import EditDocument from './components/EditDocument.vue'
import { reactive, ref } from "vue"
import axios from '@/modules/axios'

const editComponent = ref()

const pageData = reactive({
    gridApi: null,
    Document: [],
    selected: null
})

function addDocument(Document){
    pageData.gridApi.applyTransaction({add: [Document]})
}

function editDocument(Document){
    const rowNode = pageData.gridApi.getRowNode(Document.id)
    rowNode.setData(Document)
}


const columnDefs = reactive([
    { field: "id", headerName: '№', width: 65 },
    { field: "name", headerName: 'Nomi' },
    { field: "files", headerName: "Hujjatlar", cellRenderer: FileIcons , valueFormatter: null, cellClass: ['d-flex', 'align-center'],},
    { field: "confirm_date", headerName: "Tasdiqdan o'tgan sana" },
    { field: "description", headerName: "Izoh" , flex: 1},
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

axios.get('document').then(({ data }) => pageData.Document = data)
</script>
<template>
    <section class="d-flex flex-column">
        <div class="d-flex justify-space-between items-center">
            <Breadcrumbs></Breadcrumbs>
            <AddPosition v-if="(store.userRoles.includes(4) || store.userRoles.includes(1))" @addPosition="addPosition"></AddPosition>
            <EditPosition @editPosition="editPosition" ref="editComponent" :current="pageData"></EditPosition>
        </div>
        <v-spacer class="px-4">
            <AgGridVue
                :headerHeight="34"
                :defaultColDef="{sortable: true}"
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
import swal from '@/modules/swal'
import AddPosition from './components/AddPosition.vue'
import EditPosition from './components/EditPosition.vue'
import PositionProducts from '@/components/AgGrid/PositionProducts.vue'
import Icon from '@/components/AgGrid/Icon.vue'
import { reactive, ref } from "vue"
import axios from '@/modules/axios'
import { auth } from '@/store/auth'
const store = auth()


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
    { field: "number_in_document", headerName: '№', width: 65 },
    { field: "name", headerName: 'Nomi', width: 200 },
    {
        headerName: 'Biriktirilgan maxsulotlar',
        flex: 1,
        cellRenderer: PositionProducts,
    },
    {
        hide: (store.userRoles.includes(4) || store.userRoles.includes(1)) == false,
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2' ,'bg-gray-100'],
        width: 60 ,
        cellRenderer: Icon,
        cellRendererParams: { icon: 'mdi-pencil-outline'},
        headerClass: ['px-2'],
        onCellClicked: ({data}) => {
            pageData.selected = data.id
            editComponent.value.toggle()
        }
    },
    {
        hide: (store.userRoles.includes(1)) == false,
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2' ,'bg-gray-100'],
        width: 60,
        cellRenderer: Icon,
        cellRendererParams: { icon: 'mdi-delete-empty', color: 'red' },
        headerClass: ['px-2'],
        onCellClicked: ({data}) => {
            swal.fire({
                title: "Aniq o'chirmoqchimisiz?",
                text: "Malumotni qayta tiklab bo'lmaydi",
                icon: 'warning',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`position/${data.id}`).then(() => {
                        pageData.gridApi.applyTransaction({ remove: [data] })
                    })
                }
            })
        }
    },
]);

axios.get('position').then(({ data }) => pageData.positions = data)
</script>
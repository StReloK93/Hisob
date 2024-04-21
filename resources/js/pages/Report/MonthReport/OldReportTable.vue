<template>
    <AgGridVue :headerHeight="34" :defaultColDef="{ sortable: true }" class="ag-theme-material h-100"
        :getRowId="({ data }) => data.id" :columnDefs="columnDefs" :rowData="pageData.reports"
        @grid-ready="(params) => pageData.gridApi = params.api" :animateRows="true" />
</template>

<script setup lang="ts">
import swal from '@/modules/swal'
import { reactive } from 'vue'
import Icon from '@/components/AgGrid/Icon.vue'
import axios from 'axios'
import { auth } from '@/store/auth'
import Button from '@/components/AgGrid/Button.vue';

const store = auth()
const { report_id } = defineProps(['report_id'])
const pageData = reactive({
    gridApi: null,
    reports: [],
})

const columnDefs = reactive([
    { field: "id", headerName: '№', width: 65 },
    { field: "name", headerName: 'Nomi', width: 200 },
    { field: "user.name", headerName: 'Yaratdi', },
    { field: "created_at", headerName: 'Vaqti', flex: 1, },
    {
        cellClass: ['d-flex', 'justify-center', 'align-center'],
        field: "file_source",
        headerName: '',
        width: 60,
        cellRenderer: Icon,
        cellRendererParams: { icon: 'mdi-microsoft-excel' },
        onCellClicked: ({ data }) => {
            window.open(`/storage/${data.file_source}`, "_blank");
        }
    },
    {
        hide: store.userRoles.includes(3) == false,
        cellClass: ['d-flex', 'justify-center', 'align-center'],
        field: "file_source",
        headerName: 'Tasdiqlash',
        width: 90,
        cellRenderer: Icon,
        cellRendererParams: { icon: 'mdi-checkbox-marked-outline', isBlocked: true },
        onCellClicked: ({ data, node }) => {
            if(data.confirmed) return 
            swal.fire({
                title: "Ushbu amalni aniq bajarmoqchimisiz?",
                icon: 'warning',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get(`report_success/${data.id}`).then(({data}) => {
                        node.setData(data)
                    })
                }
            })
            
        }
    },
    {
        cellClass: ['d-flex', 'justify-center', 'align-center'],
        field: "",
        headerName: '',
        width: 60,
        cellRenderer: Icon,
        cellRendererParams: { icon: 'mdi-delete-empty', color: 'red', isBlocked: true },
        onCellClicked: ({data}) => {
            if(data.confirmed) return 
            swal.fire({
                title: "Aniq o'chirmoqchimisiz?",
                text: "Malumotni qayta tiklab bo'lmaydi",
                icon: 'warning',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`report/${data.id}`).then(() => {
                        pageData.gridApi.applyTransaction({ remove: [data] })
                    })
                }
            })
        }
    },

]);

axios.get(`report_type/${report_id}`).then(({ data }) => {
    pageData.reports = data
})



// function addPosition(position) {
//     pageData.gridApi.applyTransaction({ add: [position], addIndex: 0 })
// }

// function editPosition(position) {
//     const rowNode = pageData.gridApi.getRowNode(position.id)
//     rowNode.setData(position)
// }

defineExpose({ pageData })
</script>
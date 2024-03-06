<template>
    <main class="d-flex flex-column">
        <div class="d-flex justify-space-between items-center">
            <Breadcrumbs></Breadcrumbs>
            <AddEmploye v-if="(store.userRoles.includes(4) || store.userRoles.includes(1))" @addEmploye="addEmploye">
            </AddEmploye>
            <EditEmploye @editEmploye="editEmploye" ref="editComponent" :current="pageData"></EditEmploye>
        </div>
        <div class="px-4 mb-2">
            <v-row class="d-flex justify-end">
                <v-col cols="3">
                    <v-text-field prepend-inner-icon="mdi-magnify"
                        @input="(event) => pageData.gridApi.setQuickFilter(event.target.value)"
                        label="Qidiruv"></v-text-field>
                </v-col>
            </v-row>
        </div>
        <v-spacer class="px-4">
            <AgGridVue :defaultColDef="{ sortable: true }" class="ag-theme-material h-100" :headerHeight="34"
                :getRowId="({ data }) => data.id" :columnDefs="columnDefs" :rowData="employes"
                @grid-ready="(params) => pageData.gridApi = params.api"
                @rowDoubleClicked="(selected) => router.push({ name: 'employe', params: { id: selected.data.id } })"
                animateRows="true" />
        </v-spacer>
    </main>
</template>

<script setup lang="ts">
import swal from '@/modules/swal'
import Icon from '@/components/AgGrid/Icon.vue'
import axios from '@/modules/axios'
import AddEmploye from './components/AddEmploye.vue'
import EditEmploye from './components/EditEmploye.vue'
import { reactive, ref } from "vue"
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/store/useAuthStore'
const store = useAuthStore()

const editComponent = ref()

const pageData = reactive({
    gridApi: null,
    selected: null
})

function addEmploye(employe) {
    pageData.gridApi.applyTransaction({ add: [employe], addIndex: 0 })
}

function editEmploye(employe) {
    const rowNode = pageData.gridApi.getRowNode(employe.id)
    rowNode.setData(employe)
}

const router = useRouter()
const columnDefs = reactive([
    {
        width: 65,
        field: "id",
    },
    { field: "table_number", headerName: 'Tabel №', sortable: true, width: 65, headerClass: ['px-2'], cellClass: ['px-2'] },
    { field: "name", headerName: 'F.I.SH', sortable: true, flex: 1, minWidth: 275 },
    { field: "organization.short_name", headerName: 'Ish joyi', sortable: true },
    {
        field: "profession",
        headerName: 'Lavozimi',
        sortable: true,
    },
    {
        headerName: 'Yoriqnoma №',
        sortable: true,
        cellRenderer: (row) => {
            const pos = row.data.position.at(-1).position
            return `${pos.position_type_id} - ${pos.number_in_document}`
        }
    },
    { field: "hiring_date", headerName: 'Ishga qabul kuni', sortable: true, width: 160 },

    {
        hide: (store.userRoles.includes(4) || store.userRoles.includes(1)) == false,
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2', 'bg-gray-100'],
        headerName: '',
        width: 60,
        cellRenderer: Icon,
        cellRendererParams: { icon: 'mdi-eye-outline' },
        headerClass: ['px-2'],
        onCellClicked: ({ data }) => router.push({ name: 'employe', params: { id: data.id } })
    },
    {
        hide: (store.userRoles.includes(4) || store.userRoles.includes(1)) == false,
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2', 'bg-gray-100'],
        headerName: '',
        width: 60,
        cellRenderer: Icon,
        cellRendererParams: { icon: 'mdi-pencil-outline' },
        headerClass: ['px-2'],
        onCellClicked: ({ data }) => {
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
                    axios.delete(`employe/${data.id}`).then(() => {
                        pageData.gridApi.applyTransaction({ remove: [data] })
                    })
                }
            })
        }
    },
        // { field: "gender", headerName: 'Jinsi', cellRenderer: (data) => gender(data.value), sortable: true, width: 60, headerClass: ['px-2'], cellClass: ['px-2'] },
    // { field: "heigth", headerName: "Bo'yi (sm)", sortable: true, width: 85, headerClass: ['px-2'], cellClass: ['px-2'] },
    // { field: "size_head", headerName: "Bosh o'lch..", sortable: true, width: 105, headerClass: ['px-2'], cellClass: ['px-2'] },
    // { field: "size_cloth", headerName: "Kiyim o'lch..", sortable: true, width: 105, headerClass: ['px-2'], cellClass: ['px-2'] },
    // { field: "size_shoes", headerName: "Oyoq kiyim o'lch..", sortable: true, width: 125, headerClass: ['px-2'], cellClass: ['px-2'] },
])

const employes = ref([])
axios.get('employe').then(({ data }) => employes.value = data)
</script>
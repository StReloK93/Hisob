<template>
    <AgGridVue
        :defaultColDef="{ sortable: true }"
        :getRowId="({ data }) => data.id"
        :headerHeight="34" 
        animateRows="true"
        :rowSelection="'multiple'"
        class="ag-theme-material h-100"
        :columnDefs="ColumnDefs"
        :rowData="pageData.products"
        @selection-changed="onSelection"
        @grid-ready="(params) => pageData.gridApi = params.api"
    />
    <main class="absolute grid-button">
        <Scud
            v-if="pageData.selectedRows.length && store.userRoles.includes(2)"
            @confirm_products=confirm_mainproducts
            :employe="employe"
            :selected="pageData"
        />
        <span v-else></span>
        <AddMainProduct v-if="store.userRoles.includes(2) && main" @addProduct="addProduct" :employe="employe" />
        <AddSpecialProduct v-else :employe="employe" @addProduct="addProduct" />
    </main>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import { useAuthStore } from '@/store/useAuthStore'
import Scud from './Scud.vue'
import Icon from '@/components/AgGrid/Icon.vue'
import axios from '@/modules/axios'
import swal from '@/modules/swal'
import Checkbox from '@/components/AgGrid/Checkbox.vue'
import AddMainProduct from './AddMainProduct.vue'
import AddSpecialProduct from './AddSpecialProduct.vue'
const emit = defineEmits(['requestLoad'])
const { employe, request , main } = defineProps(['employe', 'request', 'main'])

const store = useAuthStore()
const pageData = reactive({
    gridApi: null,
    selectedRows: [],
    products: []
})


function onSelection() {
    pageData.selectedRows = pageData.gridApi.getSelectedRows()
}

axios.get(request).then(({ data }) => {
    pageData.products = data
    emit('requestLoad', data)
    
})


function changeTab(){
    pageData.gridApi?.deselectAll()
}

function confirm_mainproducts(arrayId) {
    const itemsToUpdate = []

    arrayId.forEach(id => {
        const rowNode = pageData.gridApi.getRowNode(id)
        const data = rowNode.data
        data.toggle_confirmation = true
        itemsToUpdate.push(data);
    })

    setTimeout(() => {
        pageData.gridApi.applyTransaction({ update: itemsToUpdate })
        changeTab()
    }, 500)
}

function addProduct(data) {
    pageData.gridApi.applyTransaction({ add: data })
}
// Машинист помощник машиниста экскаватора ЭКГ,RH
const ColumnDefs = reactive([
    { headerName: '№', width: 50, cellRenderer: (data) => data.rowIndex + 1},
    {
        headerClass: ['px-3'],
        cellClass: ['px-3'],
        field: "product.name",
        headerName: 'Nomi',
        flex: 1,
        minWidth: 300,
        headerCheckboxSelection: store.userRoles.includes(2),
        checkboxSelection: store.userRoles.includes(2),
        showDisabledCheckboxes: store.userRoles.includes(2),
    },
    { field: "count", headerName: 'soni', width: 50, headerClass: ['px-2'], cellClass: ['px-2']},
    { field: "product_data.expiration_date", headerName: 'Muddati (oy)', width: 90, headerClass: ['px-2'], cellClass: ['px-2'] },
    { field: "price", headerName: 'Narxi', width: 120, headerClass: ['px-2'], cellClass: ['px-2'] },
    { field: "nomenclature", headerName: 'Nomenklatura', width: 120, headerClass: ['px-2'], cellClass: ['px-2'] },
    {
        headerClass: ['px-2'],
        cellClass: ['d-flex', 'align-center', 'px-2', 'bg-gray-100'],
        field: "toggle_confirmation",
        headerName: 'Topshirildi',
        width: 130,
        cellRenderer: Checkbox
    },
    {
        headerClass: ['px-2'],
        cellClass: ['d-flex', 'align-center', 'px-2', 'bg-gray-100'],
        field: "toggle_write_off",
        headerName: 'Xisobdan chiqariladi',
        cellRenderer: Checkbox,
        width: 145,
        cellRendererParams: { color: 'blue' }
    },
    // {
    //     headerClass: ['px-2'],
    //     cellClass: ['d-flex', 'align-center', 'px-2', 'bg-gray-100', 'justify-center'],
    //     field: "timer",
    //     cellRenderer: ({value}) => {
    //         return  `${value} Kun` 
    //     },
    //     headerName: 'Q.Muddati',
    //     width: 75,
    // },
    {
        hide: (store.userRoles.includes(4) || store.userRoles.includes(1)) == false,
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2' ,'bg-gray-100'],
        headerName: '',
        width: 60,
        cellRenderer: Icon,
        cellRendererParams: { icon: 'mdi-delete-empty', color: 'red', isBlocked: true },
        headerClass: ['px-2'],
        onCellClicked: ({ data }) => {
            if(data.toggle_write_off) return
            swal.fire({
                title: "Aniq o'chirmoqchimisiz?",
                text: "Malumotni qayta tiklab bo'lmaydi",
                icon: 'warning',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`employe_product/${data.id}`).then(() => {
                        pageData.gridApi.applyTransaction({ remove: [data] })
                    })
                }
            })
        }
    },
])
</script>
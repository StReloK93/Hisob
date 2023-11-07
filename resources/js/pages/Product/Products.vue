<template>
    <section class="d-flex flex-column">
        <div class="d-flex justify-space-between items-center">
            <Breadcrumbs></Breadcrumbs>
            <AddProduct @addProduct="addProduct"></AddProduct>
            <EditProduct @editProduct="editProduct" ref="editComponent" :current="pageData"></EditProduct>
        </div>
        <v-spacer class="px-4">
            <AgGridVue
                :headerHeight="34"
                :defaultColDef="{sortable: true}"
                class="ag-theme-material h-100"
                :getRowId="({data}) => data.id"
                :columnDefs="columnDefs" :rowData="position"
                @grid-ready="(params) => pageData.gridApi = params.api"
                animateRows="true"
            />
        </v-spacer>
    </section>
</template>

<script setup lang="ts">
import swal from '@/modules/swal'
import AddProduct from './components/AddProduct.vue'
import EditProduct from './components/EditProduct.vue'
import Icon from '@/components/AgGrid/Icon.vue'
import IconEdit from '@/components/AgGrid/IconEdit.vue'
import { reactive, ref } from "vue"
import axios from '@/modules/axios'
import { useAuthStore } from '@/store/useAuthStore'
const store = useAuthStore()

const editComponent = ref()

const pageData = reactive({
    selected: null,
    gridApi: null
})


function addProduct(Product){
    pageData.gridApi.applyTransaction({add: [Product],addIndex: 0})
}

function editProduct(Product){
    const rowNode = pageData.gridApi.getRowNode(Product.id)
    rowNode.setData(Product)
}

const columnDefs = reactive([
    { field: "id", headerName: 'Kod', width: 80 },
    { field: "name", headerName: 'Nomi', flex: 1 },
    { field: "product_type.name", headerName: 'Turi' },
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
    {
        hide: (store.userRoles.includes(1)) == false,
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2' ,'bg-gray-100'],
        headerName: '',
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
                    axios.delete(`product/${data.id}`).then(() => {
                        pageData.gridApi.applyTransaction({ remove: [data] })
                    })
                }
            })
        }
    },
]);

const position = ref([])
axios.get('product').then(({ data }) => position.value = data)
</script>
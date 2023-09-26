<template>
    <section class="d-flex flex-column">
        <div class="d-flex justify-space-between items-center">
            <Breadcrumbs></Breadcrumbs>
            <AddProduct @addProduct="addProduct"></AddProduct>
            <EditProduct @editProduct="editProduct" ref="editComponent" :current="pageData"></EditProduct>
        </div>
        <v-spacer class="px-4">
            <AgGridVue
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
import AddProduct from '@/components/Product/AddProduct.vue'
import EditProduct from '@/components/Product/EditProduct.vue'
import Breadcrumbs from '@/components/Breadcrumbs.vue'
import Button from '@/components/AgGrid/Button.vue'
import IconEdit from '@/components/AgGrid/IconEdit.vue'
import { reactive, ref } from "vue"
import axios from '@/modules/axios'
import { AgGridVue } from "ag-grid-vue3"

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
    { field: "expiration_date", headerName: 'Muddati (Oy)' },
    { field: "product_type.name", headerName: 'Turi' },
    {
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2' ,'bg-gray-100'],
        field: "isActive",
        headerName: 'Faolligi',
        cellRenderer: Button,
        width: 60,
        headerClass: ['px-2'],
        onCellClicked: (params) => {
            axios.post(`product/set_activate/${params.data.id}`, { active: !params.value }).then(() => {
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

const position = ref([])
axios.get('product').then(({ data }) => position.value = data)
</script>
<style src="../../css/ag-grid.css"></style>
<template>
    <section v-if="pageData.employe" class="d-flex flex-column">

        <Breadcrumbs :user="{ name: pageData.employe.name }"></Breadcrumbs>
        <v-spacer class="px-4">
            <section class="bg-white pa-6 h-100 d-flex">
                <main class="flex-fill d-flex flex-column">
                    <div class="d-flex align-center justify-space-between">
                        <span class="text-blue-grey-darken-3 text-h5">
                            {{ pageData.employe.name }} <span class="ml-4 text-body-1">№ {{ pageData.employe.table_number
                            }}</span>
                        </span>
                        <span class="text-grey d-inline-flex align-center">
                            <v-icon class="mr-2">mdi-texture-box</v-icon> {{ pageData.employe.organization.short_name }}
                        </span>
                    </div>
                    <p class="text-grey-lighten-1 text-caption">
                        Lavozim
                    </p>

                    <div v-if="pageData.position" class="text-teal">
                        {{ pageData.position.name }}
                    </div>
                    <div v-else class="text-red">
                        Lavozim biriktirilmagan
                    </div>
                    <v-tabs v-model="pageData.tab" @update:modelValue="changeTab" class="mt-12" color="cyan">
                        <v-tab value="one">Maxsus kiyimlar</v-tab>
                        <v-tab value="two">Asosiy buyumlar</v-tab>
                    </v-tabs>
                    <v-divider color="cyan -top-1px"></v-divider>
                    <v-window v-model="pageData.tab" v-if="pageData.position" class="flex-grow-1">
                        <v-window-item value="one" class="flex-grow-1">
                            <main class="h-100 d-flex flex-column">
                                <aside class="py-4">
                                    <p class="text-grey-lighten-1 text-caption pb-1">
                                        Biriktirilgan buyumlar
                                    </p>
                                    <v-chip size="small" color="teal" class="mr-4 px-4 mb-2" v-for="item in pageData.position.products">
                                        {{ item.product.name }} <span class="ml-2">x</span>{{ item.count }}
                                    </v-chip>
                                </aside>
                                <v-spacer class="relative">
                                    <AgGridVue
                                        :getRowId="({ data }) => data.id"
                                        :headerHeight="34"
                                        class="ag-theme-material h-100"
                                        animateRows="true"
                                        :rowSelection="'multiple'"
                                        :columnDefs="ColumnDefs"
                                        :rowData="pageData.products"
                                        @grid-ready="(params) => pageData.productGridApi = params.api"
                                        @selection-changed="onSelectionChanged"
                                    />
                                    <main class="absolute grid-button">
                                        <Scud
                                            v-if="pageData.selectedRows.length"
                                            @confirm_products=confirm_products
                                            :employe="pageData.employe"
                                            :selected="pageData"
                                        />
                                        <span v-else></span>
                                        <AddProduct
                                            @addProduct="addProduct"
                                            :employe="pageData.employe"
                                        />
                                    </main>
                                </v-spacer>
                            </main>
                        </v-window-item>

                        <v-window-item value="two" class="flex-grow-1 pt-5">
                                <AgGridVue
                                    :getRowId="({ data }) => data.id"
                                    :headerHeight="34"
                                    animateRows="true"
                                    :rowSelection="'multiple'"
                                    class="ag-theme-material h-100"
                                    :columnDefs="ColumnDefs"
                                    :rowData="pageData.mainProducts"
                                    @selection-changed="onSelection"
                                    @grid-ready="(params) => pageData.mainGridApi = params.api"
                                />
                                <main class="absolute grid-button">
                                    <Scud
                                        v-if="pageData.selectedRows.length"
                                        @confirm_products=confirm_mainproducts
                                        :employe="pageData.employe"
                                        :selected="pageData"
                                    />
                                    <span v-else></span>
                                    <AddMainProduct
                                        @addProduct="addMainProduct"
                                        :employe="pageData.employe"
                                    />
                                </main>
                        </v-window-item>
                    </v-window>
                </main>
            </section>
        </v-spacer>
    </section>
</template>

<script setup lang="ts">
import AddProduct from '@/components/Employe/AddProduct.vue'
import AddMainProduct from '@/components/Employe/AddMainProduct.vue'
import Breadcrumbs from '@/components/Breadcrumbs.vue'
import Checkbox from '@/components/AgGrid/Checkbox.vue'
import Scud from '@/components/Employe/Scud.vue'
import axios from '@/modules/axios'
import { AgGridVue } from 'ag-grid-vue3'
import { reactive } from 'vue'
const { id } = defineProps(['id'])

const pageData = reactive({
    productGridApi: null,
    mainGridApi: null,
    products: [],
    selectedRows: [],
    employe: null,
    tab: null,
    position: null,
    mainProducts: null,
})



function changeTab(){
    pageData.productGridApi?.deselectAll()
    pageData.mainGridApi?.deselectAll()
}

function confirm_products(arrayId) {
    const itemsToUpdate = []

    arrayId.forEach(id => {
        const rowNode = pageData.productGridApi.getRowNode(id)
        const data = rowNode.data
        data.toggle_confirmation = true
        itemsToUpdate.push(data);
    })

    setTimeout(() => {
        pageData.productGridApi.applyTransaction({ update: itemsToUpdate })
        changeTab()
    }, 500)
}

function confirm_mainproducts(arrayId) {
    const itemsToUpdate = []

    arrayId.forEach(id => {
        const rowNode = pageData.mainGridApi.getRowNode(id)
        const data = rowNode.data
        data.toggle_confirmation = true
        itemsToUpdate.push(data);
    })

    setTimeout(() => {
        pageData.mainGridApi.applyTransaction({ update: itemsToUpdate })
        changeTab()
    }, 500)
}




axios.get(`employe/${id}`).then(({ data: employer }) => {
    pageData.employe = employer
    const lastPosition = employer.position.at(-1)
    if (lastPosition) pageData.position = lastPosition.position
})




function onSelectionChanged() {
    pageData.selectedRows = pageData.productGridApi.getSelectedRows()
}

function onSelection() {
    pageData.selectedRows = pageData.mainGridApi.getSelectedRows()
}

axios.get(`employe_product/products/${id}`).then(({ data }) => {
    pageData.products = data
})

axios.get(`employe_product/mainproducts/${id}`).then(({ data }) => {
    pageData.mainProducts = data
})

function addProduct(data) {
    pageData.productGridApi.applyTransaction({ add: data })
}

function addMainProduct(data) {
    pageData.mainGridApi.applyTransaction({ add: data })
}

const ColumnDefs = reactive([
    {
        headerClass: ['px-3'],
        cellClass: ['px-3'],
        field: "product.name",
        headerName: 'Nomi',
        flex: 1,
        headerCheckboxSelection: true,
        checkboxSelection: true,
        showDisabledCheckboxes: true,
    },
    { field: "count", headerName: 'soni', width: 85 },
    { field: "product.expiration_date", headerName: 'Muddati (oy)', width: 120 },
    { field: "price", headerName: 'Narxi', width: 120 },
    { field: "nomenclature", headerName: 'Nomenklatura', width: 120 },
    {
        headerClass: ['px-2'],
        cellClass: ['d-flex', 'align-center', 'px-2', 'bg-gray-100'],
        field: "toggle_confirmation",
        headerName: 'Topshirildi',
        width: 145,
        cellRenderer: Checkbox
    },
    {
        headerClass: ['px-2'],
        cellClass: ['d-flex', 'align-center', 'px-2', 'bg-gray-100'],
        field: "toggle_write_off",
        headerName: 'Xisobdan chiqarildi',
        cellRenderer: Checkbox,
        width: 145,
        cellRendererParams: { color: 'red' }
    },
])

</script>
<style src="../../css/ag-grid.css"></style>
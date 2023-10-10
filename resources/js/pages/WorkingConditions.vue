<template>
    <section class="d-flex flex-column">
        <div class="d-flex justify-space-between items-center">
            <Breadcrumbs></Breadcrumbs>
            <AddWorkingCondition @addWorkingCondition="addWorkingCondition"></AddWorkingCondition>
            <EditWorkingCondition @editWorkingCondition="editWorkingCondition" ref="editComponent" :current="pageData"></EditWorkingCondition>
        </div>
        <v-spacer class="px-4">
            <AgGridVue
                :headerHeight="34"
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
import AddWorkingCondition from '@/components/WorkingCondition/AddWorkingCondition.vue'
import EditWorkingCondition from '@/components/WorkingCondition/EditWorkingCondition.vue'
import IconEdit from '@/components/AgGrid/IconEdit.vue'
import { reactive, ref } from "vue"
import axios from '@/modules/axios'
import { AgGridVue } from "ag-grid-vue3"

const editComponent = ref()

const pageData = reactive({
    selected: null,
    gridApi: null
})


function addWorkingCondition(Profession){
    pageData.gridApi.applyTransaction({add: [Profession],addIndex: 0})
}

function editWorkingCondition(Profession){
    const rowNode = pageData.gridApi.getRowNode(Profession.id)
    rowNode.setData(Profession)
}

const columnDefs = reactive([
    { field: "id", headerName: 'Kod', width: 80 },
    { field: "name", headerName: 'Nomi', flex: 1 },
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
axios.get('working_condition').then(({ data }) => position.value = data)
</script>
<style src="../../css/ag-grid.css"></style>
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
import Icon from '@/components/AgGrid/Icon.vue'
import axios from '@/modules/axios'
import AddEmploye from './components/AddEmploye.vue'
import EditEmploye from './components/EditEmploye.vue'
import { reactive, ref } from "vue"
import { gender } from '@/modules/gender'
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
    { field: "table_number", headerName: 'Tabel №', sortable: true, width: 65, headerClass: ['px-2'], cellClass: ['px-2'] },
    { field: "name", headerName: 'F.I.SH', sortable: true, flex: 1, minWidth: 275 },
    { field: "organization.short_name", headerName: 'Ish joyi', sortable: true },
    // {
    //     field: "position",
    //     headerName: 'Lavozimi',
    //     sortable: true,
    //     valueFormatter: (data) => {
    //         if (data.value.at(-1)) return data.value.at(-1).position.name
    //         else return ""
    //     }
    // },
    { field: "hiring_date", headerName: 'Ishga qabul kuni', sortable: true, width: 160 },
    // { field: "gender", headerName: 'Jinsi', cellRenderer: (data) => gender(data.value), sortable: true, width: 60, headerClass: ['px-2'], cellClass: ['px-2'] },
    // { field: "heigth", headerName: "Bo'yi (sm)", sortable: true, width: 85, headerClass: ['px-2'], cellClass: ['px-2'] },
    // { field: "size_head", headerName: "Bosh o'lch..", sortable: true, width: 105, headerClass: ['px-2'], cellClass: ['px-2'] },
    // { field: "size_cloth", headerName: "Kiyim o'lch..", sortable: true, width: 105, headerClass: ['px-2'], cellClass: ['px-2'] },
    // { field: "size_shoes", headerName: "Oyoq kiyim o'lch..", sortable: true, width: 125, headerClass: ['px-2'], cellClass: ['px-2'] },
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
]);



function toExcel(){
    let table = divToTable('.sheshengami')
    exportExcel(table)
}


//Div to table generate
function divToTable(selector){
    let header = document.querySelector('.ag-header-container > .ag-header-row.ag-header-row-column')
    let thead = ''

    for (let i = 0; i < header.children.length; i++) {
        const col:any = header.children[i];
        thead += `<th>${col.innerText}</th>`
    }

    var rows = document.querySelectorAll(selector)
    let table = ''
    rows.forEach(row => {
        if (row.children.length != 0) {
            let textrow = ''
            for (let i = 0; i < row.children.length; i++) {
                const col = row.children[i];
                textrow += `<td>${col.innerHTML}</td>`
            }
            table += `<tr> ${textrow} </tr>`
        }
    });
    return `<table><tr>${thead}</tr>${table}</table>`
}
//table to excel
function exportExcel(table){
    var tableToExcel = (function () {
        var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
            , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function (s, c) {
                return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; })
            }
            , downloadURI = function (uri, name) {
                var link = document.createElement("a");
                link.download = name;
                link.href = uri;
                link.click();
            }

        return function (table, name, fileName) {
            var ctx = { worksheet: name || 'Worksheet', table: table }
            var resuri = uri + base64(format(template, ctx))
            downloadURI(resuri, fileName);
        }
    })();

    var date = new Date()
    var namedate = `${date.getUTCDate()}-${date.getUTCMonth() + 1}-${date.getUTCFullYear()}`
    tableToExcel(table, 'Olinganlar', namedate)
}










const employes = ref([])
axios.get('employe').then(({ data }) => employes.value = data)
</script>
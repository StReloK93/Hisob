<template>
    <v-row justify="end" class="flex-0-0 ma-0 pb-2 px-4 overflow-y-auto">
        <v-dialog v-model="pageData.dialog" persistent width="768" location="right">
            <template v-slot:activator="{ props }">
                <v-btn  v-bind="props" color="pink" icon="mdi-credit-card-outline"></v-btn>
            </template>
            <v-card>
                <v-card-title> Qabul qilish </v-card-title>
                <v-card-text class="pa-0">
                    <div class="text-center">
                        <img src="/images/scud.avif" class="w-50" style="position: relative; right: 20px;">
                    </div>
                    <div class="px-6">
                        <v-table class="w-100">
                            <thead>
                                <tr>
                                    <td>Nomi</td>
                                    <td>Nomenklatura</td>
                                    <td>Soni</td>
                                    <!-- <td>Narxi</td> -->
                                </tr>
                            </thead>
                            <tbody>                                
                                <tr v-for="item in selected.selectedRows">
                                    <td>{{item.product.name}}</td>
                                    <td>{{item.nomenclature}}</td>
                                    <td>{{item.count}}</td>
                                    <!-- <td>{{item.price}}</td> -->
                                </tr>
                            </tbody>
                        </v-table>
                    </div>
                </v-card-text>
                <FormFooter @close="pageData.dialog = false"/>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script setup lang="ts">
import { reactive, watch } from 'vue'
import axios from '@/modules/axios'
import Swal from 'sweetalert2'
const emit = defineEmits(['confirm_products'])
const { selected, employe } = defineProps(['selected', 'employe'])


const pageData = reactive({
    snackbar: false,
    dialog: false,
    organizations: null,
    positions: null,
    rules: [(value) => value == null || value == "" ? 'toldiring' : true ]
})



function scanCode(sScancode, iQuantity) {
    const idList = selected.selectedRows.map((item) => item.id)

    const numberCard = sScancode.detail.scanCode

    const cards = employe.cards.map((card) => +card)

    if(cards.includes(+numberCard)){
        axios.post('employe_product/confirm', idList).then(({data}) => {
            if(data) {
                Swal.fire({position: 'center', icon: 'success', title: 'Tasdiqlandi', showConfirmButton: false,timer: 1500}).then(() => {
                    emit('confirm_products', idList)
                    pageData.dialog = false
                })
            }
        })
    }
    else Swal.fire({position: 'center', icon: 'warning', title: 'Hodim karta raqami mos kelmadi', showConfirmButton: false,timer: 1500})
}







watch(() => pageData.dialog, (current) => {
    //@ts-ignore
    if (current) document.addEventListener('scan', scanCode)
    //@ts-ignore
    else document.removeEventListener('scan', scanCode)
})
</script>
<style scoped>
    .v-table tbody td, .v-table thead td{
        border-bottom: 1px solid rgb(223, 223, 223);
    }
</style>
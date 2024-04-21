import { createApp } from 'vue'
import { auth } from './store/auth'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import vuetify from './modules/vuetify'
import onScan from 'onscan.js'

import "ag-grid-community/styles/ag-grid.css"
import "ag-grid-community/styles/ag-theme-material.css"
import '@sweetalert2/theme-material-ui/material-ui.css'
import '../css/app.css'
import Breadcrumbs from '@/components/Breadcrumbs.vue'
import FormFooter from '@/components/FormFooter.vue'
import CustomForm from '@/components/CustomForm.vue'
import { AgGridVue } from 'ag-grid-vue3'
onScan.attachTo(document)


const pinia = createPinia()
const app = createApp(App)
app.component('Breadcrumbs', Breadcrumbs)
app.component('FormFooter', FormFooter)
app.component('CustomForm', CustomForm)
app.component('AgGridVue', AgGridVue)
app.use(vuetify)
app.use(pinia)
const store = auth()

async function init() {
	await store.getUser()
	app.use(router)
	app.mount("#app")
}
init()


//  TB
// 1 - Ko'rish
// 2 - Muddatidan oldin hisobdan chiqarishga ruxsat berish (Hisobdan chiqarishni bosib akt skaner variantini yuklaydi)
// 1 yil oldindan Hisobdan chiqariladigan mahsulotlarni ruyhatini shakllantirish
// Muddati tugayotgan buyumlarni ogohlantirib turish

// Omborchi faqat topshiradi
// Hisobdan chiqarilgan buyumlarni ruyhatini qilib beradi

// Buxgalterni roli Nazorat
//Ish o'rni
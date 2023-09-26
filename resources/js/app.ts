import { createApp } from 'vue'
import { useAuthStore } from './store/useAuthStore'

import App from './App.vue'
import router from './router'

// Vuetify
import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
import "ag-grid-community/styles/ag-grid.css"
import "ag-grid-community/styles/ag-theme-material.css"
import '@sweetalert2/theme-material-ui/material-ui.css'

import { createPinia } from 'pinia'

import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import onScan from 'onscan.js'
onScan.attachTo(document)

const vuetify = createVuetify({
  components,
  directives,
})

const pinia = createPinia()
const app = createApp(App)
app.use(vuetify)
app.use(pinia)

const store = useAuthStore()

async function init() {
  await store.getUser()
  app.use(router)
  app.mount("#app")
}
init()



// SELECT
//       [TabelniyNomer]
//       ,[NomerKarti]     
//   FROM [SCUD].[dbo].[KartiSotrudnikov] where TabelniyNomer='12928' and DeletedTime is null

// SELECT DISTINCT a.N, a.name, a.price1, a.measure FROM nmmc.v_rests_bso a WHERE a.N='2515075' AND a.in_balance='Y'






//  TB
// 1 - Ko'rish
// 2 - Muddatidan oldin hisobdan chiqarishga ruxsat berish (Hisobdan chiqarishni bosib akt skaner variantini yuklaydi)
// 1 yil oldindan Hisobdan chiqariladigan mahsulotlarni ruyhatini shakllantirish
// Muddati tugayotgan buyumlarni ogohlantirib turish


// Omborchi faqat topshiradi
// Hisobdan chiqarilgan buyumlarni ruyhatini qilib beradi



// Buxgalterni roli Nazorat








//Ish o'rni

//buyi
//kiyim o'lchami
//bosh kiyimi o'lchami
//oyoq kiyim o'lchami
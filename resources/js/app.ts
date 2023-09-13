import { createApp } from 'vue'
import { useAuthStore } from './store/useAuthStore'

import App from './App.vue'
import router from './router'

// Vuetify
import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
import "ag-grid-community/styles/ag-grid.css"
import "ag-grid-community/styles/ag-theme-material.css"
import { createPinia } from 'pinia'

import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

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
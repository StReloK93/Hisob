import { createApp } from 'vue'

import App from './App.vue'
import router from './router'

// Vuetify
import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
import "ag-grid-community/styles/ag-grid.css"
import "ag-grid-community/styles/ag-theme-material.css"
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
  components,
  directives,
})

createApp(App)
.use(router)
.use(vuetify)
.mount('#app')
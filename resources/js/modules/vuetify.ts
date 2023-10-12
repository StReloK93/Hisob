import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
const color = 'teal'
const variant = 'underlined'

const defaultInputParams = { color: color, variant: variant, hideDetails: "auto" }

export default createVuetify({
	components,
	directives,
	defaults: {
        VList: { color: color },
		VTextarea: { ...defaultInputParams, rows: 3 },
		VTextField: defaultInputParams,
		VFileInput: defaultInputParams,
		VBtn: { color: color },
		VAutocomplete: { ...defaultInputParams, chips: true },
		VRadioGroup: defaultInputParams,
		VCombobox: defaultInputParams,
		VSwitch: defaultInputParams,
		VCheckbox: defaultInputParams,
        VCardTitle: { class:"bg-blue-grey-lighten-5" },
	},
})
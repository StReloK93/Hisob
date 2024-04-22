import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import { createVueI18nAdapter } from "vuetify/locale/adapters/vue-i18n";
import { createI18n, useI18n } from 'vue-i18n'
import { ru, uz } from "@/localization/index";
import "vuetify/styles";
import "@mdi/font/css/materialdesignicons.css";

export const i18n = createI18n({
    legacy: false, // Vuetify does not support the legacy mode of vue-i18n
    locale: "uz",
    fallbackLocale: "uz",
    messages: {
        ru: ru,
        uz: uz,
    },
});

const color = "teal";
const variant = "underlined";

const defaultInputParams = {
    color: color,
    variant: variant,
    hideDetails: "auto",
    noDataText: "Qo'llanma to'ldirilmagan",
};

export const vuetify =  createVuetify({
    locale: {
        adapter: createVueI18nAdapter({ i18n, useI18n }),
    },
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
        VCardTitle: { class: "bg-blue-grey-lighten-5" },
    },
});

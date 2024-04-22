<template>
    <Navigator ref="nav"></Navigator>
    <v-app-bar color="teal-darken-1" prominent>
        <v-app-bar-nav-icon variant="text" class="mr-8" color="white"  @click.stop="toggleNavigator"></v-app-bar-nav-icon>
        <v-btn size="small" class="mr-2" color="white" icon="" v-if="store.userRoles.includes(1)">
            <v-icon>mdi-shield-crown</v-icon>
            <v-tooltip activator="parent" location="bottom">Admin</v-tooltip>
        </v-btn>
        <v-btn size="small" class="mr-2" color="white" icon="" v-if="store.userRoles.includes(2)">
            <v-icon text="white">mdi-clipboard-list</v-icon>
            <v-tooltip activator="parent" location="bottom">Omborchi</v-tooltip>
        </v-btn>
        <v-btn size="small" class="mr-2" color="white" icon="" v-if="store.userRoles.includes(3)">
            <v-icon>mdi-point-of-sale</v-icon>
            <v-tooltip activator="parent" location="bottom">Buxgalter</v-tooltip>
        </v-btn>
        <v-btn size="small" class="mr-2" color="white" icon="" v-if="store.userRoles.includes(4)">
            <v-icon>mdi-security</v-icon>
            <v-tooltip activator="parent" location="bottom">ММваХТ muxandis</v-tooltip>
        </v-btn>
        <v-spacer></v-spacer>

        <v-btn :active="current == 'uz'" color="white" stacked @click="setLocale('uz')">
			uz
		</v-btn>
		<v-btn :active="current == 'ru'" color="white" stacked @click="setLocale('ru')">
			ru
		</v-btn>
        <v-btn color="white" class="text-none" stacked>
            <v-badge :content="10" color="error">
                <v-icon>mdi-bell</v-icon>
            </v-badge>
        </v-btn>
    </v-app-bar>
</template>

<script setup lang="ts">
import { ref } from "vue"
import Navigator from "./Navigator.vue"
import { auth } from '@/store/auth'
import { useLocale } from 'vuetify'
const { t, current  } = useLocale()
const nav = ref(null)
const store = auth()

function toggleNavigator() {
    nav.value.toggle()
}
// 2089


function setLocale(locale) {
    localStorage.setItem('locale', locale)
    current.value = locale
}
// 943780031
</script>


<template>
    <Navigator ref="nav"></Navigator>
    <v-app-bar color="teal-darken-1" prominent>
        <v-app-bar-nav-icon variant="text" @click.stop="toggleNavigator"></v-app-bar-nav-icon>
        <v-spacer></v-spacer>
        <v-btn class="text-none" stacked>
            <v-badge :content="10" color="error">
                <v-icon>mdi-bell</v-icon>
            </v-badge>
        </v-btn>
    </v-app-bar>
</template>

<script setup lang="ts">
import { ref } from "vue"
import Navigator from "./Navigator.vue"
const nav = ref(null)

function toggleNavigator() {
    nav.value.toggle()
}

</script>
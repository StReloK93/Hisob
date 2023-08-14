<template>
    <v-navigation-drawer v-model="driwer" location="left">
        <template v-slot:prepend>
          <v-list-item
            class="bg-teal-lighten-5"
            lines="two"
            prepend-avatar="/images/profile.png"
            title="Soliyev Aziz"
            subtitle="Dasturchi"
          ></v-list-item>
        </template>
        <v-list color="transparent">
            <v-list-item color="teal" prepend-icon="mdi-home" title="Bosh sahifa" to="/"></v-list-item>
            <v-list-item color="teal" prepend-icon="mdi-account-hard-hat" title="Lavozimlar" to="/positions"></v-list-item>
            <v-list-item color="teal" prepend-icon="mdi-texture-box" title="Bo'linmalar" to="/organizations"></v-list-item>
            <v-list-item color="teal" prepend-icon="mdi-tshirt-crew" title="Mahsulotlar" to="/products"></v-list-item>
            <v-list-item color="teal" prepend-icon="mdi-tshirt-crew" title="Y.M.M hisoboti" to="/fuel"></v-list-item>
        </v-list>
        <template v-slot:append>
            <div class="pa-2">
                <v-btn color="red-accent-3" block append-icon="mdi-logout">
                    Chiqish
                </v-btn>
            </div>
        </template>
    </v-navigation-drawer>
</template>

<script setup lang="ts">
import { ref } from 'vue'
const driwer = ref(true)

function toggle(){
    driwer.value = !driwer.value
}
defineExpose({toggle})
</script>
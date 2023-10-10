<template>
    <v-navigation-drawer v-model="driwer" location="left">
        <template v-slot:prepend>
          <v-list-item
            class="bg-teal-lighten-5"
            lines="two"
            prepend-avatar="/images/profile.png"
            :title="store.user.name"
            :subtitle="store.user.login"
          />
        </template>
        <v-list color="transparent">
            <v-list-item color="teal" prepend-icon="mdi-home" title="Bosh sahifa" :to="{name: 'index'}" />
            <v-list-item color="teal" prepend-icon="mdi-account-group" title="Hodimlar" :to="{name: 'employes'}"/>
            <!-- <v-list-item color="teal" prepend-icon="mdi-tshirt-crew" title="Y.M.M hisoboti" to="/fuel"/> -->
            <v-divider></v-divider>
            <div>
                <p class="px-4 mt-3 text-caption text-blue-grey-lighten-3">Umumiy</p>
                <v-list-item color="teal" prepend-icon="mdi-texture-box" title="Normaviy hujjatlar" :to="{name: 'maindocuments'}"/>
                <v-list-item color="teal" prepend-icon="mdi-format-list-bulleted-type" title="Lavozim turlari" :to="{name: 'positiontype'}"/>
                <v-list-item color="teal" prepend-icon="mdi-tshirt-crew" title="Mahsulotlar" :to="{name: 'products'}"/>
                <v-list-item color="teal" prepend-icon="mdi-weather-hail" title="Mehnat sharoitlari" :to="{name: 'workingconditions'}"/>
                <v-list-item color="teal" prepend-icon="mdi-account-hard-hat" title="Lavozimlar" :to="{name: 'positions'}"/>
                <!-- <v-list-item color="teal" prepend-icon="mdi-briefcase" title="Kasblar" :to="{name: 'mainprofessions'}"/> -->

                
            </div>
            <v-divider></v-divider>
            <div v-if="store.userRoles.includes(1)">
                <p class="px-4 mt-3 text-caption text-blue-grey-lighten-3">Admin</p>
                <v-list-item color="teal" prepend-icon="mdi-account-network" title="Foydalanuvchilar" :to="{name: 'users'}"/>
                <v-list-item color="teal" prepend-icon="mdi-texture-box" title="Bo'linmalar" :to="{name: 'organizations'}"/>
            </div>

        </v-list>
        <template v-slot:append>
            <div class="pa-2">
                <v-btn @click="store.logout()" color="red-accent-3" block append-icon="mdi-logout">
                    Chiqish
                </v-btn>
            </div>
        </template>
    </v-navigation-drawer>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useAuthStore } from '@/store/useAuthStore'
const driwer = ref(true)

const store = useAuthStore()

function toggle(){ driwer.value = !driwer.value }
defineExpose({toggle})
</script>


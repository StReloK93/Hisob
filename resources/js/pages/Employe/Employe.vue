<template>
    <section v-if="pageData.employe" class="d-flex flex-column">
        <Breadcrumbs :user="{ name: pageData.employe.name }"></Breadcrumbs>
        <v-spacer class="px-4">
            <section class="bg-white pa-6 h-100 d-flex">
                <main class="flex-fill d-flex flex-column">
                    <div class="d-flex align-center justify-space-between">
                        <main class="text-blue-grey-darken-3 text-h5 d-flex align-center">
                            {{ pageData.employe.name }} 
                            <span class="ml-4 text-body-1">№ {{ pageData.employe.table_number }}</span>
                        </main>
                        <main>
                            <ImageUpload :employe="pageData.employe"/>
                            <v-btn icon="mdi-printer" class="ml-4"/>
                        </main>
                    </div>
                    <div class="text-grey my-2 d-inline-flex align-center">
                        <v-icon class="mr-2">mdi-texture-box</v-icon> {{ pageData.employe.organization.short_name }}
                    </div>
                    <p class="text-grey-lighten-1 text-caption">
                        Lavozim
                    </p>

                    <div v-if="pageData.position" class="text-teal">
                        {{ pageData.position?.name }}
                    </div>
                    <div v-else class="text-red">
                        Lavozim biriktirilmagan
                    </div>
                    <main></main>
                    <v-tabs v-model="pageData.tab" class="mt-12" color="cyan">
                        <v-tab value="one">Maxsus kiyimlar</v-tab>
                        <!-- <v-tab value="two">Asosiy buyumlar</v-tab> -->
                    </v-tabs>
                    <v-divider color="cyan -top-1px"></v-divider>
                    <v-window v-model="pageData.tab" v-if="pageData.position" class="flex-grow-1">
                        <v-window-item value="one" class="flex-grow-1">
                            <main class="h-100 d-flex flex-column">
                                <aside class="py-4">
                                    <p class="text-grey-lighten-1 text-caption pb-1">
                                        Lavozimga biriktirilgan buyumlar
                                    </p>
                                    <v-chip size="small" color="teal" class="mr-2 px-4 mb-2" v-for="item in pageData.position.products">
                                        <v-tooltip activator="parent" location="bottom">{{ item.working_condition.name }}</v-tooltip>
                                        {{ item.product?.name }} <span class="ml-2">x</span>{{ item?.count }}
                                        <v-icon class="ml-2">mdi-texture-box</v-icon>
                                    </v-chip>
                                </aside>
                                <v-spacer class="relative">
                                    <Grid :employe="pageData.employe" :request="`employe_product/products/${id}`"/>
                                </v-spacer>
                            </main>
                        </v-window-item>
<!-- 
                        <v-window-item value="two" class="flex-grow-1 pt-5">
                            <Grid :main="true" :employe="pageData.employe" :request="`employe_product/mainproducts/${id}`"/>
                        </v-window-item> -->
                    </v-window>
                </main>
            </section>
        </v-spacer>
    </section>
</template>

<script setup lang="ts">
import Grid from './components/Grid.vue'
import axios from '@/modules/axios'
import { reactive } from 'vue'
import ImageUpload from './components/ImageUpload.vue'
const { id } = defineProps(['id'])
const pageData = reactive({
    image: "",
    employe: null,
    tab: null,
    position: null,
    inputImage: null
})


axios.get(`employe/${id}`).then(({ data: employer }) => {
    pageData.employe = employer
    const lastPosition = employer.position.at(-1)
    if (lastPosition) pageData.position = lastPosition.position
})
</script>
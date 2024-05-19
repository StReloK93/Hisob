<template>
	<v-navigation-drawer v-model="driwer" location="left">
		<v-list-item class="bg-teal-lighten-5" lines="two" prepend-avatar="/images/profile.png" :title="store.user?.name"
			:subtitle="store.user?.login" />
		<v-list density="comfortable">
			<!-- <v-list-item  prepend-icon="mdi-home" title="Bosh sahifa" :to="{ name: 'index' }" /> -->
			<v-list-item prepend-icon="mdi-account-group" :title="t('employe')" :to="{ name: 'employes' }" />
			<!-- <v-list-item prepend-icon="mdi-hard-hat" title="Himoya vositalar muddatlari" :to="{ name: 'specialproduct' }" /> -->

			<v-divider></v-divider>
			<v-list-subheader title="Umumiy" />
			<v-list-item prepend-icon="mdi-texture-box" :title="t('normative')" :to="{ name: 'maindocuments' }">
				<v-tooltip activator="parent" location="bottom">{{ t('normative') }}</v-tooltip>
			</v-list-item>

			<v-list-item prepend-icon="mdi-tshirt-crew" :title="t('personal_products')" :to="{ name: 'products' }">
				<v-tooltip activator="parent" location="bottom">{{ t('personal_products') }}</v-tooltip>
			</v-list-item>
			
			<v-list-item prepend-icon="mdi-weather-hail" :title="t('working_condition')" :to="{ name: 'workingconditions' }" />
			<v-list-item prepend-icon="mdi-account-hard-hat" :title="t('positions')" :to="{ name: 'positions' }" />
			<v-list-item prepend-icon="mdi-microsoft-excel" :title="t('reports')" :to="{ name: 'report' }" />


			<v-divider></v-divider>
			<div v-if="store.userRoles?.includes(1)">
				<v-list-subheader title="Admin" />
				<v-list-item prepend-icon="mdi-account-network" :title="t('users')" :to="{ name: 'users' }" />
				<v-list-item prepend-icon="mdi-texture-box" :title="t('organizations')" :to="{ name: 'organizations' }" />
			</div>

		</v-list>
		<template v-slot:append>
			<div class="pa-2">
				<v-btn @click="logout" color="red-accent-3" block append-icon="mdi-logout">
					Chiqish
				</v-btn>
			</div>
		</template>
	</v-navigation-drawer>
</template>
<script setup lang="ts">

import { useLocale } from 'vuetify'


import { ref } from 'vue'
import { auth } from '@/store/auth'
import swal from '@/modules/swal'
const driwer = ref(true)

const store = auth()





function toggle() { driwer.value = !driwer.value }
defineExpose({ toggle })


function logout() {
	swal.fire({
		title: "Tizimdan chiqmoqchimisiz?",
		icon: 'warning',
	}).then((result) => {
		if (result.isConfirmed) {
			store.logout()
		}
	})
}


const { t } = useLocale()

</script>


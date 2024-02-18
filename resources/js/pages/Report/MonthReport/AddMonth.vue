<template>
	<v-dialog v-model="pageData.dialog" persistent width="600" location="right">
		<template v-slot:activator="{ props }">
			<v-list-item v-bind="props">
				{{ report.name }}
			</v-list-item>
		</template>
		<CustomForm :submitMethod="getReport" @close="pageData.dialog = false" :title="report.name">
			<v-row>
				<v-col cols="12" class="pt-3">
					<v-text-field :rules="rules" v-model="formData.name" label="Hisobot nomi" />
				</v-col>
			</v-row>
		</CustomForm>
	</v-dialog>
</template>

<script setup lang="ts">
import CustomForm from '@/components/CustomForm.vue'
import { rules } from '@/modules/helpers'
import { reactive } from 'vue'
import axios from '@/modules/axios'
const emit = defineEmits(['addProduct'])
const { report } = defineProps(['report'])

const formData = reactive({
	name: null
})

async function getReport() {
	console.log('test');
}
const pageData = reactive({
	dialog: false,
	products: null,
})
</script>
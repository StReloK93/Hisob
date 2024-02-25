<template>
	<v-dialog v-model="pageData.dialog" persistent width="600" location="right">
		<template v-slot:activator="{ props }">
			<v-btn prepend-icon="mdi-timeline-clock-outline" class="text-capitalize ml-4" variant="tonal" v-bind="props">
				Harakat
			</v-btn>
		</template>
		<CustomForm :submitMethod="addReport" @close="pageData.dialog = false" title="Belgilangan vaqtda muddati o'tadiganlar">
			<v-row>
				<v-col>
					<v-text-field :rules="rules"  v-model="formData.name" label="Nomi" />
				</v-col>
				<v-col cols="12" class="pt-3">
					<v-autocomplete 
						:rules="rules" 
						:items="pageData.products" 
						v-model="formData.products"
						label="Himoya vositalari" 
						item-title="name" 
						:item-value="(item) => item" 
						multiple
					/>
				</v-col>
				<v-col>
					<v-text-field :rules="rules" type="date" v-model="formData.start" label="Dan" />
				</v-col>
				<v-col>
					<v-text-field :rules="rules" type="date" v-model="formData.end" label="Gacha" />
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
const emit = defineEmits(['addMovement'])
const { report } = defineProps(['report'])


const formData = reactive({
	name: null,
	start: null,
	end: null,
	products: [],
	report_type_id: report.id,
})

async function addReport() {
	await axios.post('report', formData).then(({ data }) => {
		emit('addMovement', { report_type_id: report.id, report: data, old: true })
		pageData.dialog = false
	})
}
const pageData = reactive({
	dialog: false,
	products: null,

})

axios.get('product').then(({data}) => {
	pageData.products = data
})
</script>
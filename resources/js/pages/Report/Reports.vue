<template>
	<section class="d-flex flex-column">
		<v-menu>
			<template v-slot:activator="{ props }">
				<div>
					<v-btn append-icon="mdi-chevron-down" class="text-capitalize" color="blue-grey" variant="tonal"
						v-bind="props">
						Hisobotlar
					</v-btn>
					<Movement v-if="pageData.report_types.length" @addMovement="addMovement"
						:report="pageData.report_types[2]" />
					<v-btn @click="downloadExcel" prepend-icon="mdi-book-account" class="text-capitalize ml-4" variant="tonal">
						Umumiy malumotlar
					</v-btn>
				</div>
			</template>
			<v-list class="py-1">
				<div v-for="report in pageData.report_types">
					<template v-if="report.id != 3">
						<component :is="report.component" @addReport="addReport" :report="report" />
					</template>
				</div>
			</v-list>
		</v-menu>

		<v-spacer class="mt-4">
			<v-card class="h-100 d-flex flex-column">
				<v-tabs v-model="pageData.tab">
					<v-tab v-for="(report, index) in pageData.report_types" :value="index" class="text-capitalize">
						{{ report.name }}
					</v-tab>
				</v-tabs>
				<v-card-text class="flex-grow-1">
					<v-window v-model="pageData.tab" class="h-100">
						<v-window-item class="h-100">
							<OldReportTable ref="oldTable" :report_id="1" />
						</v-window-item>
						<v-window-item class="h-100">
							<CurrentReportTable ref="currentTable" :report_id="2" />
						</v-window-item>
						<v-window-item class="h-100">
							<MovementTable ref="movementTable" :report_id="3" />
						</v-window-item>
					</v-window>
				</v-card-text>
			</v-card>
		</v-spacer>
	</section>
</template>

<script setup lang="ts">
import { reactive, shallowRef, ref } from 'vue'
import AddMonthReport from './MonthReport/AddMonthReport.vue'
import AddMonth from './MonthReport/AddMonth.vue'
import Movement from './MonthReport/Movement.vue'
import MovementTable from './MonthReport/MovementTable.vue'
import OldReportTable from './MonthReport/OldReportTable.vue'
import CurrentReportTable from './MonthReport/CurrentReportTable.vue'
import axios from 'axios'



const oldTable = ref()
const currentTable = ref()
const movementTable = ref()

function addMovement(params) {
	movementTable.value.pageData.gridApi.applyTransaction({ add: [params.report] })
	pageData.tab = 2
}

function addReport(params) {
	if (params.report_type_id == 1) {
		pageData.tab = 0
		oldTable.value.pageData.gridApi.applyTransaction({ add: [params.report] })
	}
	else if (params.report_type_id == 2) {
		pageData.tab = 1
		currentTable.value.pageData.gridApi.applyTransaction({ add: [params.report] })
	}
}

axios.get('report_type').then(({ data }) => {
	const result = data.map(report => {
		if (report.id == 1) report.component = shallowRef(AddMonthReport)
		if (report.id == 2) report.component = shallowRef(AddMonth)
		return report
	})
	pageData.report_types = result
})
const pageData = reactive({ tab: 0, report_types: [] })

function downloadExcel() {
	axios.get('umumiy/employes', { responseType: 'blob' }).then((response) => {
		const url = window.URL.createObjectURL(new Blob([response.data]));

		const link = document.createElement('a');
		link.href = url;
		link.setAttribute('download', 'umumiy.xlsx');  // Указываем имя файла
		document.body.appendChild(link);
		link.click();
		window.URL.revokeObjectURL(url);

		document.body.removeChild(link);
	})
}
</script>
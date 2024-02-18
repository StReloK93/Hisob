<template>
	<section class="d-flex flex-column">
		<v-menu>
			<template v-slot:activator="{ props }">
				<div>
					<v-btn prepend-icon="mdi-microsoft-excel" class="text-capitalize" color="blue-grey" variant="tonal" v-bind="props">
						Hisobotlar
					</v-btn>
				</div>
			</template>
			<v-list class="py-1">
				<div v-for="report in pageData.report_types">
					<component :is="report.component" @addReport="addReport" :report="report" />
				</div>
			</v-list>
		</v-menu>
		<v-spacer class="mt-4">
			<v-card class="h-100 d-flex flex-column">
				<v-tabs v-model="pageData.tab">
					<v-tab v-for="(report, index) in pageData.report_types" :value="index" class="text-capitalize">
						{{report.name}}
					</v-tab>
				</v-tabs>
				<v-card-text class="flex-grow-1">
					<v-window v-model="pageData.tab" class="h-100">
						<v-window-item value="one" class="h-100">
							<MonthReportTable ref="monthTable" :report_id="1" />
						</v-window-item>

						<!-- <v-window-item value="two" class="h-100">
                            Two 
                        </v-window-item> -->
					</v-window>
				</v-card-text>
			</v-card>
		</v-spacer>
		<!-- <v-btn tag="a" href="/employe/export" color="success" target="_blank">
            Hisobotni yuklash
        </v-btn> -->
	</section>
</template>

<script setup lang="ts">
import { reactive, shallowRef, ref } from 'vue'
import AddMonthReport from './MonthReport/AddMonthReport.vue'
import AddMonth from './MonthReport/AddMonth.vue'
import MonthReportTable from './MonthReport/MonthReportTable.vue'
import axios from 'axios'

const monthTable = ref()

function addReport(params) {
	if (params.report_type_id == 1) {
		monthTable.value.pageData.gridApi.applyTransaction({ add: [params.report] })
	}
}

axios.get('report_type').then(({ data }) => {
	const result = data.map(report => {
		if(report.id == 1) report.component = shallowRef(AddMonthReport) 
		if(report.id == 2) report.component = shallowRef(AddMonth)
		return report
	})
	pageData.report_types = result
})
const pageData = reactive({ tab: 0, report_types: []})

</script>
<template>
	<section class="relative h-full flex items-start">
		<input
			class="absolute top-1/2 left-1/2 transform -translate-x-2/4 opacity-0 -translate-y-2/4" 
			accept="image/*"
			@input="onchange" 
			ref="fileInput"
			id="fileinp" 
			type="file"
			multiple
		/>
		<div class="flex flex-wrap -mx-1 w-full">
			<main class="w-1/2 relative mb-2 after:content-[''] after:float-left after:pt-[80%]" v-for="(img, index) in PageProps.images" :key="img">
				<i @click="deleteImage(index)" class="fa-light fa-xmark absolute mix-blend-difference text-white z-20 top-0 right-2 px-2 py-1.5 cursor-pointer hover:text-red-600"></i>
				<div class="absolute top-0 left-0 w-full h-full px-1">
					<img :src="img.blob" class="object-cover w-full h-full">
				</div>
			</main>
			<main class="w-1/2 relative mb-2 after:content-[''] after:float-left after:pt-[80%]" >
				<label for="fileinp" class="absolute top-0 left-0 w-full h-full px-1">
					<aside class="w-full h-full bg-gray-100 hover:bg-gray-50 flex-center border-2 border-dashed border-gray-200">
						<i class="fa-sharp fa-solid fa-image-landscape text-pink-500 mr-2"></i>
						<span class="text-gray-500 text-xs">
							Hujjat ilovasini <br> tanlang
						</span>
					</aside>
				</label>
			</main>
		</div>

	</section>
</template>
<script lang="ts" setup>
import { ref , reactive } from 'vue'



const emit = defineEmits(['change-file'])
const { formData } = defineProps(['formData'])
const fileInput = ref() // input file
const PageProps: any = reactive({
	bool: true,
	images: []
})

if(formData.images.length){
	formData.images.forEach(images => {
		PageProps.images.push({image: null ,  blob: '/img/'+images.path })
	});
}

function onchange() {
	const InputFile = fileInput.value.files
	
	if(InputFile.length == 0) return
	
	for (let i = 0; i < InputFile.length; i++) {

		PageProps.images.push({ image: InputFile[i], blob: URL.createObjectURL(InputFile[i])})

		formData.images.push(InputFile[i])

	}
	
	fileInput.value.value = []

	emit('change-file')
}

function deleteImage(index){
	PageProps.images.splice(index, 1)
	formData.images.splice(index, 1)
}

</script>
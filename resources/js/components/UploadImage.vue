<template>
	<section class="relative h-100 d-flex align-start">
		<input
			class="absolute ruz-input" 
			accept="image/*"
			@input="onchange"
			ref="fileInput"
			id="fileinp" 
			type="file"
			multiple
			hidden
		/>
		<div class="d-flex flex-wrap w-100">
			<transition-group name="fade">
				<div class="w-25 mb-2" v-for="(img, index) in images" :key="index">
					<main style="aspect-ratio: auto 1/1;"  class="relative">
						<div style="top: 0; left: 0;" class="absolute w-100 h-100 px-1">
							<v-btn @click="deleteImage(index)" variant="plain" color="white" icon="mdi-close" class="absolute" style="right: 5px;"/>
							<v-btn variant="tonal" color="white" icon="mdi-eye-outline" class="absolute ruz-input"/>
							<img :src="img.blob" class="object-cover w-100 h-100 object-fit">
						</div>
					</main>
				</div>
			</transition-group>
			<main style="aspect-ratio: auto 1/1;" class="w-25 relative mb-2">
				<label for="fileinp" style="top: 0; left: 0;" class="absolute w-100 h-100 px-1">
					<aside class="w-100 h-100 d-flex justify-center align-center border  label-input">
						<v-icon color="teal" size="x-large">
							mdi-image-area
						</v-icon>
						<span class="text-gray-500 text-xs ml-2">
							Rasmlarni tanlang
						</span>
					</aside>
				</label>
			</main>
		</div>
	</section>
</template>
<script lang="ts" setup>
import { ref , computed, watch } from 'vue'
const emit = defineEmits(['change-file', 'onload'])
const { formData } = defineProps(['formData'])
const fileInput = ref() // input file

const images = computed(() => {
	return formData.images.map((image) => {
		if(image.type) return { image: image, blob: URL.createObjectURL(image)}
		else return { id: image.id, blob: '/img/'+image.src, }
	})
})

function onchange() {
	const InputFile = fileInput.value.files
	if(InputFile.length == 0) return
	
	for (let i = 0; i < InputFile.length; i++) {
		formData.images.push(InputFile[i])
	}
	
	fileInput.value.value = []
	emit('change-file', images.value)
}

function deleteImage(index){
	formData.images.splice(index, 1)
}

watch(() => images.value , (current) => {
	emit('onload', current)
})
</script>
<style scoped>
.relative{
	position: relative;
}
.absolute{
	position: absolute;
}
.ruz-input{
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}

.object-fit{
	object-fit: cover;
}

.label-input{
	cursor: pointer;
}
.label-input:hover{
	background: rgb(228, 228, 228);
}
</style>
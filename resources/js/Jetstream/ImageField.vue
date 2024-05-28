<template>
	<label
		v-if="!image_preview && !image"
		class="bg-gray-100 text-gray-200 w-full h-56 flex items-center justify-center cursor-pointer transition duration-200 hover:text-gray-300">
		<span class="text-4xl leading-none"><i class="ci-image"></i></span>
		<input type="file" @input="imagePreview" class="hidden" />
	</label>
	
	<div
		v-if="image_upload_limit"
		class="text-red-600 text-xs font-semibold mt-1">La imagen supera los 2Mb</div>
	
	<div v-if="image_preview || image" class="relative">
		
		<img :src="image ? image.thumb_src : image_preview" class="w-full h-56 object-cover" />
		<div class="bg-gradient-to-b from-gray-900 rounded-t-md text-white text-xs font-semibold w-full p-2 pb-6 absolute top-0">{{ image ? image.name : image_preview.name }}</div>
		
		<div class="w-full p-2 absolute bottom-0 flex justify-end">
			<button
				type="button"
				class="bg-red-600 border border-red-600 text-white text-xl leading-none py-1 px-2 hover:bg-red-700"
				@click="imageClear"><i class="ci-trash_empty"></i></button>
		</div>
	
	</div>
</template>


<script>
	import { defineComponent } from 'vue'
	
	export default defineComponent({
		props: [
			'model',
			'image_prop'
		],


		data() {
			return {
				image_preview: null,
				image : this.image_prop ? this.image_prop : null,
				// image_preview: null,
				upload_limit: 2000,
				image_upload_limit: null

			}
		},
		
		emits: ['getImageData'],

		mounted() {
			// console.log(this.image)
		},
		
		methods: {

			imagePreview(event){
				var input = event.target
				
				if( input.files ){
					
					if( (input.files[0].size / 1024) > this.upload_limit ){
						this.image_upload_limit = true
						return
					}

					this.image_upload_limit = null

					var reader = new FileReader()
					reader.onload = (e) => {
						this.image_preview = e.target.result
					}
					this.image_preview = input.files[0]
					reader.readAsDataURL(input.files[0])

					this.$emit('getImageData', {img: this.image_preview, model: this.model})
					
				}
			},


			imageClear(){
				this.image_preview = null
				this.image = null;
				this.$emit('getImageData', {img: null, model: this.model})
			},
			
		}
	})
</script>
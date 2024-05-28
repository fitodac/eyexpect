<template>
	<div class="text-gray-400 w-full mt-10 flex justify-center items-center">
		<Link
			v-if="prev_page_url"
			:href="prev()"
			class="text-gray-500 font-medium leading-none tracking-wide uppercase mr-4 flex items-center hover:text-primary"><i class="ci-chevron_big_left"></i> Anterior</Link>
		
		<span v-if="current_page">{{ current_page }}</span>
		<span v-if="current_page && total_pages" class="px-2">de</span>
		<span v-if="total_pages">{{ total_pages }}</span>
		
		<Link
			v-if="next_page_url"
			:href="next()"
			class="text-gray-500 font-medium leading-none tracking-wide uppercase ml-4 flex items-center hover:text-primary">Siguiente <i class="ci-chevron_big_right"></i></Link>
	</div>
</template>


<script>
	import { defineComponent } from 'vue'
	import { Link } from '@inertiajs/inertia-vue3';
	
	export default defineComponent({
		components: {
			Link
		},
		
		
		props: {
			'prev_page_url' : String,
			'next_page_url' : String,
			'current_page' : Number,
			'total_pages': Number,
			'params': Object
		},
		
		
		methods:{
			getParams(){
				let _prms = ''

				for( let idx in this.params ){
					if( this.params[idx] ){ _prms += `&filter[${idx}]=`; _prms += this.params[idx]; }
				}
				
				return _prms
			},
			
			prev(){
				return this.prev_page_url + this.getParams()
			},
			
			next(){
				return this.next_page_url + this.getParams()
			}
		}
	})
</script>
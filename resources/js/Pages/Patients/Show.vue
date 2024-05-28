<template>
	<app-layout title="Paciente">
		<section class="max-w-7xl px-4 mx-auto py-12 sm:px-6 lg:px-8">
			<div class="grid gap-y-10 mb-20 md:grid-cols-7 md:gap-10 lg:grid-cols-10">
				
				<div class="order-2 md:col-span-4 lg:col-span-8 lg:col-span-8">
					
					<div class="grid lg:grid-cols-3 gap-6">
						<div v-for="(pic, idx) in filter.images" :key="idx">
							<img :src="pic" class="h-96 object-cover">
							<!--<UnavailableImage/>-->
							<strong v-if="0 === idx" class="text-gray-400 text-sm uppercase tracking-wider mt-1.5 block">Visita inicial</strong>
							<strong v-if="1 === idx" class="text-gray-400 text-sm uppercase tracking-wider mt-1.5 block">Post-tratamiento</strong>
							<strong v-if="2 === idx" class="text-gray-400 text-sm uppercase tracking-wider mt-1.5 block">Seguimiento</strong>
						</div>
					</div>
					
				</div>
				
				
				<div class="sm:max-w-xs sm:mx-auto md:col-span-3 lg:col-span-2">
					<div class="text-primary font-bold uppercase block cursor-pointer mb-5">Ficha del paciente</div>
					
					<div class="grid gap-2.5">
						<div>
							<div class="uppercase"><span class="text-gray-500">Look:</span> {{ patient.look.name }}</div>
							<div class="text-sm leading-tight">Depresiones infraorbitarias moderadas-graves + Presencia de patas de gallo + líneas glabelares</div>
						</div>
						<div class=""><span class="text-gray-500">Edad:</span> {{ patient.age.name }}</div>
						<div class="capitalize"><span class="text-gray-500">Sexo:</span> {{ patient.gender.name }}</div>
						<div class=""><span class="text-gray-500">Tratamiento:</span> Otros</div>
						
						<div class="mt-1">
							<select class="w-full focus:ring-transparent focus:border-primary" v-model="filter.img_type" @change="filter.images = getImages(filter.img_type)">
								<option value="front">Mirando hacia el frente</option>
								<option value="right">Perfil derecho</option>
								<option value="left">Perfil izquierdo</option>
								<option value="threequarters">Tres cuartos</option>
								<option value="smiling">Sonriendo</option>
								<option value="angry">Expresión de enfado</option>
							</select>
						</div>
						
						<div class="my-2">
							<Link
								:href="route('dashboard')"
								class="uppercase flex items-center hover:text-primary"><i class="ci-chevron_big_left text-lg mr-0.5"></i> Volver</Link>
						</div>
						
						<div if="can_admin" class="mt-3">
							<Link
								:href="route('pacientes.edit', [patient])"
								class="bg-primary text-white font-medium leading-none uppercase py-1.5 px-3 flex items-center justify-center flex-1 hover:bg-primary-dark"><i class="ci-edit text-lg mr-1"></i> Editar</Link>
						</div>
					</div>
				</div>
				
			</div>
		</section>
		
		
	</app-layout>
</template>


<script>
	import { defineComponent, reactive } from 'vue'
	import AppLayout from '@/Layouts/AppLayout.vue'
	import ImageField from '@/Jetstream/ImageField.vue'
	import UnavailableImage from '@/Components/UnavailableImage.vue'

	import { Link } from '@inertiajs/inertia-vue3'

	export default defineComponent({

		components: {
			AppLayout,
			Link,
			ImageField,
			UnavailableImage
		},

		props: ['patient', 'can_admin'],
		
		setup(props){
			
			let filter = reactive({
				img_type: 'front',
				images: null
			});
			
			const getImages = (_type) => {

				_type = !_type ? 'front' : _type
				let _resp = []

				for( let idx in props.patient.phases ){
					for( let key in props.patient.phases[idx].images ){
						if( _type === key ) _resp.push(props.patient.phases[idx].images[key].full_src)
					}
				}

				return _resp
			}

			filter.images = getImages(filter.img_type)

			return {filter, getImages}
		},
		
		methods: {
		
		
		
		}
		
	})
</script>
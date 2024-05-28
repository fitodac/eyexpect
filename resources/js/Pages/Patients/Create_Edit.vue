<template>
	<app-layout>
		
		<template #header>
			<div class="flex justify-between items-center">
				<div>
					<h2 class="text-primary font-medium text-3xl text-gray-800 leading-tight" v-if="!patient">Nuevo paciente</h2>
					<h2 class="text-primary font-medium text-3xl text-gray-800 leading-tight" v-if="patient">Paciente {{ patient.uuid }}</h2>
				</div>
				
				<div class="flex gap-3">
					<Link
						v-if="patient"
						:href="route('pacientes.create')"
						class="bg-primary text-white text-sm text-center font-bold leading-none uppercase py-3 px-6 hover:bg-primary-dark">Nuevo paciente</Link>
				</div>
			</div>
		</template>
		
		
		
		<section class="max-w-7xl mx-auto px-6 py-12 pb-28 sm:px-6 lg:px-8">
			<form @submit.prevent="submit()">
				
				<div class="grid grid-cols-8 gap-4">
					
					<div class="col-span-2">
						<span class="pb-1 block">Look</span>
						<select v-model="form.look" class="w-full focus:ring-transparent focus:border-primary">
							<option value=""></option>
							<option v-for="l in look" :key="look.id" :value="l.id">{{ l.name }}</option>
						</select>
						<span v-if="errors.look" class="text-red-600 font-medium">{{ errors.look }}</span>
					</div>
					
					
					<div class="col-span-1">
						<span class="pb-1 block">Edad</span>
						<select v-model="form.age" class="w-full focus:ring-transparent focus:border-primary">
							<option value=""></option>
							<option v-for="a in age_selector" :key="a.id" :value="a.id">{{ a.name }}</option>
						</select>
						<span v-if="errors.age" class="text-red-600 font-medium">{{ errors.age }}</span>
					</div>
					
					
					<div class="col-span-1">
						<span class="pb-1 block">Sexo</span>
						<select v-model="form.gender" class="w-full focus:ring-transparent focus:border-primary">
							<option value=""></option>
							<option value="m" >Masculino</option>
							<option value="f" >Femenino</option>
						</select>
						<span v-if="errors.gender" class="text-red-600 font-medium">{{ errors.gender }}</span>
					</div>
					
					
					<div class="col-span-2">
						<span class="pb-1 block">Tratamiento</span>
						<select v-model="form.treatment" class="w-full focus:ring-transparent focus:border-primary">
							<option value=""></option>
							<option v-for="t in treatments" :key="t.id" :value="t.id">{{ t.name }}</option>
						</select>
						<span v-if="errors.treatment" class="text-red-600 font-medium">{{ errors.treatment }}</span>
					</div>
					
					<div class="col-span-2 text-right mt-7">
						<button @click="submit" class="bg-primary text-white text-sm font-bold leading-none uppercase tracking-wider py-3.5 px-14 hover:bg-primary-dark">Guardar</button>
					</div>
				
				</div>
				
				
				
			
				<div class="flex items-center gap-x-5 mt-12 mb-3">
					<h3 class="text-lg font-semibold tracking-wider">
						FASE INICIAL
					</h3>
					<span v-if="errors['phases.initial.images.front']" class="text-red-600 font-medium">{{ errors['phases.initial.images.front'] }}</span>
				</div>
				
				<div class="grid gap-x-4 gap-y-7 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-6">
					<div>
						<div :class="errors['phases.initial.images.front'] ? 'border border-red-600 shadow-xl' : ''">
							<image-field model="initial_front" @get-image-data="getImgData" :image_prop="(patient && patient.phases.initial) ? patient.phases.initial.images.front : null"/>
						</div>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Frente</div>
					</div>
					
					<div>
						<image-field model="initial_right" @get-image-data="getImgData" :image_prop="(patient && patient.phases.initial) ? patient.phases.initial.images.right : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Derecha</div>
					</div>
					
					<div>
						<image-field model="initial_left" @get-image-data="getImgData" :image_prop="(patient && patient.phases.initial) ? patient.phases.initial.images.left : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Izquierda</div>
					</div>
					
					<div>
						<image-field model="initial_threequarters" @get-image-data="getImgData" :image_prop="(patient && patient.phases.initial) ? patient.phases.initial.images.threequarters : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Tres cuartos</div>
					</div>
					
					<div>
						<image-field model="initial_smiling" @get-image-data="getImgData" :image_prop="(patient && patient.phases.initial) ? patient.phases.initial.images.smiling : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Sonriendo</div>
					</div>
					
					<div>
						<image-field model="initial_angry" @get-image-data="getImgData" :image_prop="(patient && patient.phases.initial) ? patient.phases.initial.images.angry : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Enfadado</div>
					</div>
				</div>
				
				
				
				
				<h3 class="text-lg font-semibold tracking-wider mt-12 mb-3">FASE MEDIA</h3>
				
				<div class="grid gap-x-4 gap-y-7 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-6">
					<div>
						<image-field model="middle_front" @get-image-data="getImgData" :image_prop="(patient && patient.phases.middle) ? patient.phases.middle.images.front : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Frente</div>
					</div>
					
					<div>
						<image-field model="middle_right" @get-image-data="getImgData" :image_prop="(patient && patient.phases.middle) ? patient.phases.middle.images.right : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Derecha</div>
					</div>
					
					<div>
						<image-field model="middle_left" @get-image-data="getImgData" :image_prop="(patient && patient.phases.middle) ? patient.phases.middle.images.left : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Izquierda</div>
					</div>
					
					<div>
						<image-field model="middle_threequarters" @get-image-data="getImgData" :image_prop="(patient && patient.phases.middle) ? patient.phases.middle.images.threequarters : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Tres cuartos</div>
					</div>
					
					<div>
						<image-field model="middle_smiling" @get-image-data="getImgData" :image_prop="(patient && patient.phases.middle) ? patient.phases.middle.images.smiling : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Sonriendo</div>
					</div>
					
					<div>
						<image-field model="middle_angry" @get-image-data="getImgData" :image_prop="(patient && patient.phases.middle) ? patient.phases.middle.images.angry : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Enfadado</div>
					</div>
				</div>
				
				
				<h3 class="text-lg font-semibold tracking-wider mt-12 mb-3">FASE FINAL</h3>
				
				<div class="grid gap-x-4 gap-y-7 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-6">
					<div>
						<image-field model="final_front" @get-image-data="getImgData" :image_prop="(patient && patient.phases.final) ? patient.phases.final.images.front : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Frente</div>
					</div>
					
					<div>
						<image-field model="final_right" @get-image-data="getImgData" :image_prop="(patient && patient.phases.final) ? patient.phases.final.images.right : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Derecha</div>
					</div>
					
					<div>
						<image-field model="final_left" @get-image-data="getImgData" :image_prop="(patient && patient.phases.final) ? patient.phases.final.images.left : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Izquierda</div>
					</div>
					
					<div>
						<image-field model="final_threequarters" @get-image-data="getImgData" :image_prop="(patient && patient.phases.final) ? patient.phases.final.images.threequarters : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Tres cuartos</div>
					</div>
					
					<div>
						<image-field model="final_smiling" @get-image-data="getImgData" :image_prop="(patient && patient.phases.final) ? patient.phases.final.images.smiling : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Sonriendo</div>
					</div>
					
					<div>
						<image-field model="final_angry" @get-image-data="getImgData" :image_prop="(patient && patient.phases.final) ? patient.phases.final.images.angry : null"/>
						<div class="text-gray-500 font-bold tracking-wider mt-1.5">Enfadado</div>
					</div>
				</div>
				
				
				<div class="mt-10 flex justify-between">
					<div>
						<button
							class="bg-red-600 text-white text-sm font-bold leading-none uppercase py-2 px-6 inline-flex items-center hover:bg-red-700"
							@click="deletePatient(patient.id)"
							v-if="patient">
							<i class="ci-trash_empty text-lg mr-2"></i> Eliminar paciente
						</button>
					</div>
					
					
					<div class="">
						<button @click="submit" class="bg-primary text-white text-sm font-bold leading-none uppercase tracking-wider py-4 px-10 hover:bg-primary-dark">Guardar</button>
					</div>
				</div>
			
			</form>
		</section>
		
		
		<Loader v-if="loading"/>
		
	</app-layout>
</template>



<script>
	import { defineComponent, reactive } from 'vue'
	import axios from 'axios'
	import AppLayout from '@/Layouts/AppLayout.vue'
	import ImageField from '@/Jetstream/ImageField.vue'
	
	import { useForm, Link } from '@inertiajs/inertia-vue3'
	import { Inertia } from '@inertiajs/inertia'

	import Loader from '@/Components/Loader.vue'
	import ToastDelete from '@/Components/ToastDelete.vue'
	

	export default defineComponent({
		
		components: {
			AppLayout,
			Link,
			ImageField,
			Loader,
			axios,
			ToastDelete
		},
		
		props: {
			patient: null,
			look: null,
			ages: null,
			treatments: null,
			errors: null
		},
		

		data(){
			return {
				loading: false,
				deleteToastStatus: false,
			}
		},
		
		setup(props){
			
			let form = reactive({
				look: props.patient ? props.patient.look.id : null,
				age: props.patient ? props.patient.age.id : null,
				gender: props.patient ? props.patient.gender.code : null,
				treatment: props.patient ? props.patient.treatment.id : null,
				phases: props.patient ? props.patient.phases : {
					initial: {},
					middle: {},
					final: {}
				},
				_method: props.patient ? 'PUT' : 'POST'
			})
			
			
			function submit(){
				// this.loading = true
				
				if( props.patient ){
					Inertia.post(route('pacientes.update', {paciente: props.patient}), form)
				}else{
					Inertia.post(route('pacientes.store'), {
						data: form,
						succes: ()=>{ alert('x')}
					})
				}
				
				// if( this.errors ) this.loading = false
			}
			

			var age_selector = {}
			
			if( props.ages ){
				props.ages.forEach((a, idx) => {
					if( a.name.includes('<') ){
						a.name = a.name.replace('<', 'menos de')
					}
	
					if( a.name.includes('>') ){
						a.name = a.name.replace('>', 'más de ')
					}
					
					age_selector[idx] = a
				})
			}
			
			
			return {form, submit, age_selector}
		},
		
		
		
		methods: {

			getImgData(event){
				let model = event.model.split('_')
				
				if( !this.form.phases[model[0]] ) this.form.phases[model[0]] = {}
				if( !this.form.phases[model[0]].images ) this.form.phases[model[0]].images = {}
				
				this.form.phases[model[0]].images[model[1]] = event.img
			},


			deletePatient(elem){
				this.loading = true

				axios
					.delete( route('pacientes.destroy', {paciente: elem}) )
					.then(resp => {
						Inertia.get( route('pacientes.index') )
					})

			},
			
			fixErrors(){
				let err = Object.values(this.errors)
				if( !err.phases ) this.errors.phases = {initial: {images:{front:null}}}
			}
			
		}
	})
</script>
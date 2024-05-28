<template>
	<app-layout title="Pacientes">
		<section class="max-w-7xl px-4 mx-auto py-12 mb-20 sm:px-6 lg:px-8">
			
			<toast-delete
				:visible="deleteToastStatus"
				:patient="selectedPatient"
				@patientToDelete="deletePatient"/>
			
			<div class="grid gap-y-10 md:grid-cols-7 md:gap-10">
				<section class="col-span-6 order-2">
					<div class="grid grid-cols-4 gap-x-4 gap-y-6">
						<div
							v-for="(pic, idx) in pictures"
							:key="pic.id"
							class="group bg-gray-100 border border-gray-100 relative"
							data-aos="fade-in">
							
							<Link :href="route('pacientes.show', [pic])" class="block relative">
								<div class="overflow-hidden">
									<img
										:src="`storage/${pic.thumb.id}/responsive-images/${pic.thumb.src}`"
										:alt="`patient-${pic.id}`"
										class="w-full h-80 object-cover transition-all duration-300 group-hover:scale-110">
								</div>
							
							
								<div class="bg-gradient-to-t from-gray-800 text-white py-3 px-4 bottom-0 inset-x-0 absolute">
									<div class="flex gap-6">
										<div>
											<span class="text-gray-300 text-xs font-extrabold leading-none uppercase block mb-1">ID</span>
											<div><span class="text-sm leading-none block">{{ pic.id }}</span></div>
										</div>
										
										<div>
											<span class="text-gray-300 text-xs font-extrabold leading-none uppercase block mb-1">Look</span>
											<div><span class="text-sm leading-none block">{{ pic.look }}</span></div>
										</div>
										
										<div>
											<span class="text-gray-300 text-xs font-extrabold leading-none uppercase block mb-1">Edad</span>
											<div><span class="text-sm leading-none block">{{ pic.age }}</span></div>
										</div>
										
										<div>
											<span class="text-gray-300 text-xs font-extrabold leading-none uppercase block mb-1">Sexo</span>
											<div><span class="text-sm leading-none uppercase block">{{ pic.gender }}</span></div>
										</div>
									</div>
								</div>
							</Link>
							
							
							<div
								class="bg-gradient-to-b from-gray-800 border-t w-full flex top-0 absolute opacity-0 transition duration-300 group-hover:opacity-100"
								v-if="can_admin">
								
								<Link
									:href="route('pacientes.edit', [pic])"
									class="text-white text-xs font-medium leading-none uppercase py-1 px-3 flex items-center justify-center flex-1 transition duration-200 hover:text-white hover:bg-primary hover:border-primary"><i class="ci-edit text-lg mr-2"></i> Editar</Link>
								
								<button
									class="text-white text-xs font-medium leading-none uppercase py-1 px-3 flex items-center justify-center flex-1 transition duration-200 hover:text-white hover:bg-primary hover:border-primary"
									@click="deleteToast(pic)"><i class="ci-trash_empty text-lg mr-2"></i> Eliminar</button>
							</div>
							
						</div>
					</div>
				</section>
				
				
				<section class="col-span-1 md:order-2">
					<Link
						v-if="can_admin"
						:href="route('pacientes.create')"
						class="bg-primary text-white text-sm text-center font-bold leading-none uppercase block py-3 px-6 mb-5 hover:bg-primary-dark">Nuevo paciente</Link>
					
					<button class="text-lg font-medium uppercase hover:text-primary" @click="activeSidebar = !activeSidebar">Filtros</button>
					
					<div v-if="filter_info" class="font-bold leading-none uppercase mt-3" v-html="filter_info"></div>
					
					<div class="mt-5" v-if="filter">
						<button class="text-gray-400 text-lg font-medium uppercase hover:text-gray-500" @click="filterClear">Borrar filtros</button>
					</div>
					
				</section>
				
			</div>
			
			
			<Pagination
				:prev_page_url="patients.prev_page_url"
				:next_page_url="patients.next_page_url"
				:current_page="patients.current_page"
				:total_pages="patients.last_page"
				:params="dataFilter"/>
			
			
			
			<div
				id="filter"
				class="bg-white bg-opacity-90 w-72 right-0 top-0 bottom-0 fixed transition-all duration-300 shadow-lg z-50 lg:w-80"
				:class="{'-mr-72 lg:-mr-80' : !activeSidebar}">
				<FilterSidebar
					@sidebar-status="activeSidebar = !activeSidebar"
					@filter="filterPosts"
					:filterFields="dataFilter"/>
			</div>
			
			
			<div
				class="bg-white bg-opacity-40 inset-0 fixed transition-all duration-400 z-40"
				v-if="activeSidebar"
				@click="activeSidebar = false"></div>
			
			
		</section>
		
		<Loader v-if="loading"/>
		
	</app-layout>
</template>


<script>
	import { defineComponent } from 'vue'
	import axios from 'axios'
	import AppLayout from '@/Layouts/AppLayout.vue'
	import { Head, Link } from '@inertiajs/inertia-vue3';
	import { Inertia } from '@inertiajs/inertia'
	import FilterSidebar from '@/Components/FilterSidebar.vue'
	import Pagination from '@/Components/Pagination.vue'
	import Loader from '@/Components/Loader.vue'
	import ToastDelete from '@/Components/ToastDelete.vue'
	

	export default defineComponent({
		components: {
			AppLayout,
			Link,
			FilterSidebar,
			Pagination,
			Loader,
			axios,
			ToastDelete
		},
		
		props: [
			'pictures',
			'patients',
			'can_admin',
			'filter',
			'filter_info'
		],
		
		data(){
			return {
				activeSidebar: false,
				loading: false,
				
				deleteToastStatus: false,
				selectedPatient: null,
				
				dataFilter: this.filter ? this.filter : {
																									look: null,
																									age: null,
																									gender: null,
																									phase: null,
																									treatment: null,
																									pic_angle: null
																								}
			}
		},
		
		methods: {
			deleteToast(elem){
				this.deleteToastStatus = true
				this.selectedPatient = elem
				return false
			},
			
			deletePatient(event){
				this.deleteToastStatus = false
				this.loading = true
				
				axios
				.delete( route('pacientes.destroy', {paciente: event}) )
				.then(resp => {
					Inertia.get( route('pacientes.index') )
				})
				
			},

			filterPosts(event){
				this.loading = true
				this.dataFilter[event[0]] = event[1]
				Inertia.get(route('pacientes.index'), {filter: this.dataFilter})
			},

			filterClear(){
				this.loading = true
				Inertia.get(route('pacientes.index'))
			}
		}
	})
</script>
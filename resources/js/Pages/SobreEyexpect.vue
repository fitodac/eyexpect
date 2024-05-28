<template>
	<app-layout title="Sobre Eyexpect" page_class="page-about">
		<section class="max-w-4xl mx-auto px-6 py-28 sm:px-6 md:py-40 lg:px-8 lg:py-52">
			
			<div class="h-full">
				<div class="text-center">
					<div class="font-montserrat text-primary text-sm font-semibold mb-12">EYEXPECT es una base de datos de fotografías de
						“antes y después” con la que médicos y pacientes puedan mejorar su comunicación,
						entender y compartir tanto las expectativas personales como los resultados “realistas”
						del tratamiento estético de las ojeras.</div>
					
					<Link :href="route('dashboard')" class="text-black text-lg font-medium uppercase -ml-3 hover:text-primary">
						<span class="sm:text-primary">
							<i class="ci-chevron_big_right"></i>
							<i class="ci-chevron_big_right -ml-2.5"></i>
						</span>
						<span class="pl-1 -top-0.5 relative">Acceder al catálogo fotográfico</span>
					</Link>
				</div>
			</div>
		
		</section>
	</app-layout>
</template>


<script>
	import { defineComponent } from 'vue'
	import AppLayout from '@/Layouts/AppLayout.vue'
	import { Head, Link } from '@inertiajs/inertia-vue3';
	import { Inertia } from '@inertiajs/inertia'

	export default defineComponent({
		components: {
			AppLayout,
			Link
		},


		methods: {}
	})
</script>
<template>
	<app-layout title="Nota legal">
		
		<section class="max-w-7xl mx-auto px-6 py-28 sm:px-6 md:py-40 lg:px-8 lg:py-32">
			<p>Nota legal lorem ipsum dolor sit amet...</p>
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
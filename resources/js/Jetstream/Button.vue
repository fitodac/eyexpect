<template>
	<button :type="type" class="inline-flex items-center px-6 py-2 bg-primary border border-transparent font-bold text-sm text-white uppercase tracking-widest hover:bg-primary-dark active:bg-primary-dark focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
		<slot></slot>
	</button>
</template>

<script>
	import { defineComponent } from 'vue'

	export default defineComponent({
		props: {
			type: {
				type: String,
				default: 'submit',
			},
		}
	})
</script>

<template>
	<label class="block text-base font-bold tracking-wide text-gray-700">
		<span v-if="value">{{ value }}</span>
		<span v-else><slot></slot></span>
	</label>
</template>

<script>
	import { defineComponent } from 'vue'

	export default defineComponent({
		props: ['value']
	})
</script>

<template>
	<Link :href="'/'">
		<img class="w-48 h-16 block md:w-64 md:h-24" src="/img/eyexpect-brand.svg" alt="EYExpect">
	</Link>
</template>

<script>
	import { defineComponent } from 'vue'
	import { Link } from '@inertiajs/inertia-vue3';

	export default defineComponent({
		components: {
			Link,
		},
	})
</script>

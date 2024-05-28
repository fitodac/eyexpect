<template>
	<Link :href="href" :class="classes">
		<slot />
	</Link>
</template>

<script>
	import { defineComponent } from 'vue'
	import { Link } from '@inertiajs/inertia-vue3';

	export default defineComponent({
		components: {
			Link,
		},
		props: ['href', 'active'],

		computed: {
			classes() {
				return this.active
						? 'inline-flex items-center px-1 pt-1 font-medium leading-5 text-primary uppercase focus:outline-none transition'
						: 'inline-flex items-center px-1 pt-1 font-medium leading-5 text-black uppercase hover:text-primary focus:outline-none focus:text-primary transition'
			}
		}
	})
</script>

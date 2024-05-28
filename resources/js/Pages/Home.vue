<template>
	<Head title="Welcome" />
	
	<div id="homePage" class="h-screen p-4">
		<div class="border border-white h-full relative sm:border-primary">
			
			<div class="text-center mb-14 sm:text-left sm:px-7">
				<img class="w-48 h-16 inline-block hidden sm:inline-block md:w-64 md:h-24" src="/img/eyexpect-brand.svg" alt="EYExpect">
				<img class="w-40 h-14 inline-block sm:hidden" src="/img/eyexpect-brand-white.svg" alt="EYExpect">
			</div>
			
			<div v-if="canLogin" class="text-center px-10 sm:text-left md:px-8">
				<Link v-if="$page.props.user" :href="route('dashboard')" class="text-white text-lg font-medium uppercase -ml-3 hover:text-primary sm:text-black">
					<span class="sm:text-primary">
							<i class="ci-chevron_big_right"></i>
							<i class="ci-chevron_big_right -ml-2.5"></i>
						</span>
					<span class="pl-1 -top-0.5 relative">Catálogo / Fotografías</span>
				</Link>
				
				<template v-else>
					<Link :href="route('login')" class="text-white text-lg font-medium uppercase -ml-3 hover:text-primary sm:text-black">
						<span class="sm:text-primary">
							<i class="ci-chevron_big_right"></i>
							<i class="ci-chevron_big_right -ml-2.5"></i>
						</span>
						<span class="pl-1 -top-0.5 relative">Entrar</span>
					</Link>
					
					<!--<Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">Register</Link>-->
				</template>
			</div>
			
			<div class="text-center w-full py-4 bottom-0 absolute sm:text-left sm:px-7">
				<img class="w-40 h-10 inline-block hidden sm:inline-block md:w-56 md:h-14" src="/img/galderma-brand.svg" alt="Galderma est. 1981">
				<img class="w-32 h-7 inline-block sm:hidden" src="/img/galderma-brand-white.svg" alt="Galderma est. 1981">
			</div>
			
		</div>
	</div>
</template>



<script>
	import { defineComponent } from 'vue'
	import { Head, Link } from '@inertiajs/inertia-vue3';

	export default defineComponent({
		components: {
			Head,
			Link,
		},

		props: {
			canLogin: Boolean,
			canRegister: Boolean,
			laravelVersion: String,
			phpVersion: String,
		}
	})
</script>

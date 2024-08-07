<script>
import { defineComponent, onMounted } from 'vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'

export default defineComponent({
	components: {
		Head,
		JetAuthenticationCard,
		JetAuthenticationCardLogo,
		JetButton,
		JetInput,
		JetCheckbox,
		JetLabel,
		JetValidationErrors,
		Link
	},

	props: {
		canResetPassword: Boolean,
		status: String
	},

	setup() {
		const form = useForm({
			email: '',
			password: '',
			remember: false
		})

		onMounted(() => {
			const emailTxt = 'admin@eyexpect.com'
			const passwordTxt = 'password'

			let time = 0

			emailTxt.split('').forEach((e) => {
				setTimeout(() => {
					form.email += e
				}, time + 100)
				time += 100
			})

			passwordTxt.split('').forEach((e) => {
				setTimeout(() => {
					form.password += e
				}, time + 100)
				time += 100
			})
		})

		const submit = () => {
			form
				.transform((data) => ({
					...data,
					remember: form.remember ? 'on' : ''
				}))
				.post(route('login'), {
					onFinish: () => form.reset('password')
				})
		}

		return {
			form,
			submit
		}
	}
})
</script>

<template>
	<Head title="Log in" />

	<jet-authentication-card>
		<template #logo>
			<jet-authentication-card-logo />
		</template>

		<jet-validation-errors class="mb-4" />

		<div v-if="status" class="mb-4 font-medium text-sm text-green-600">
			{{ status }}
		</div>

		<form @submit.prevent="submit">
			<div>
				<jet-label for="email" value="Email" />
				<jet-input
					id="email"
					type="email"
					class="mt-1 block w-full"
					v-model="form.email"
					required
					autofocus
				/>
			</div>

			<div class="mt-4">
				<jet-label for="password" value="Contraseña" />
				<jet-input
					id="password"
					type="password"
					class="mt-1 block w-full"
					v-model="form.password"
					required
					autocomplete="current-password"
				/>
			</div>

			<div class="block mt-4">
				<label class="flex items-center">
					<jet-checkbox name="remember" v-model:checked="form.remember" />
					<span class="ml-2 text-sm text-gray-600">Recordarme</span>
				</label>
			</div>

			<div class="flex items-center justify-end mt-4">
				<Link
					v-if="canResetPassword"
					:href="route('password.request')"
					class="underline text-sm text-gray-600 hover:text-gray-900"
				>
					¿Olvidaste tu contraseña?
				</Link>

				<jet-button
					class="ml-4"
					:class="{ 'opacity-25': form.processing }"
					:disabled="form.processing"
				>
					Entrar
				</jet-button>
			</div>
		</form>
	</jet-authentication-card>
</template>

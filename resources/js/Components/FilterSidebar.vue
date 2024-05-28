<template>
	<div id="sidebarFilter" class="text-base leading-none font-medium uppercase h-full pl-7 pt-14 pb-8 relative">
		<button class="top-3 right-2 absolute hover:text-primary" @click="$emit('sidebarStatus', false)">
			<i class="ci-close_big text-2xl"></i>
		</button>
		
		
		<div class="h-full pr-7 -mr-4 overflow-y-auto">
			<div class="text-primary font-semibold uppercase mb-1.5">Perfil del paciente</div>
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('look', $event.target.value)"
						type="radio"
						class="input-radio"
						id="profile__tired"
						value="1"
						v-model="filterFields.look">
					<span/>
				</div>
				<div>
					<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="profile__tired">Look cansado</label>
					<span class="text-sm block">(Depresiones infraorbitarias moderadas-graves)</span>
				</div>
			</div>
			
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('look', $event.target.value)"
						type="radio"
						class="input-radio"
						id="profile__angry"
						value="2"
						v-model="filterFields.look">
					<span/>
				</div>
				<div>
					<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="profile__angry">Look enfadado</label>
					<span class="text-sm block">(Depresiones infraorbitarias moderadas-graves + Presencia de patas de gallo + líneas glabelares)</span>
				</div>
			</div>
			
			<div class="flex mb-4">
				<div class="mr-2 relative">
					<input
						@change="sendChange('look', $event.target.value)"
						type="radio"
						class="input-radio"
						id="profile__aging"
						value="3"
						v-model="filterFields.look">
					<span/>
				</div>
				<div>
					<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="profile__aging">Look aging</label>
					<span class="text-sm block">(Depresiones infraorbitarias moderadas-graves + Presencia de patas de gallo + líneas glabelares + Falta de volumen en el tercio medio facial y área temporal)</span>
				</div>
			</div>
			
			
			
			<div class="text-primary font-semibold uppercase mb-1.5">Edad del paciente</div>
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('age', $event.target.value)"
						type="radio"
						class="input-radio"
						id="age__40"
						value="1"
						v-model="filterFields.age">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="age__40">&lt; 40 años</label>
			</div>
			
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('age', $event.target.value)"
						type="radio"
						class="input-radio"
						id="age__41-50"
						value="2"
						v-model="filterFields.age">
					<span/>
				</div>
				<span class="block"></span>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="age__41-50">41-50 años</label>
			</div>
			
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('age', $event.target.value)"
						type="radio"
						class="input-radio"
						id="age__51-60"
						value="3"
						v-model="filterFields.age">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="age__51-60">51-60 años</label>
			</div>
			
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('age', $event.target.value)"
						type="radio"
						class="input-radio"
						id="age__61-70"
						value="4"
						v-model="filterFields.age">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="age__61-70">61-70 años</label>
			</div>
			
			<div class="flex mb-4">
				<div class="mr-2 relative">
					<input
						@change="sendChange('age', $event.target.value)"
						type="radio"
						class="input-radio"
						id="age__71"
						value="5"
						v-model="filterFields.age">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="age__71">&gt;71 años</label>
			</div>
			
			
			
			
			<div class="text-primary font-semibold uppercase mb-1.5">Género del paciente</div>
			
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('gender', $event.target.value)"
						type="radio"
						class="input-radio"
						id="gender__f"
						value="f"
						v-model="filterFields.gender">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="gender__f">Femenino</label>
			</div>
			
			<div class="flex mb-4">
				<div class="mr-2 relative">
					<input
						@change="sendChange('gender', $event.target.value)"
						type="radio"
						class="input-radio"
						id="gender__m"
						value="m"
						v-model="filterFields.gender">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="gender__m">Masculino</label>
			</div>
			
			
			
			
			<div class="text-primary font-semibold uppercase mb-1.5">Visita</div>
			
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('phase', $event.target.value)"
						type="radio"
						class="input-radio"
						id="visit__initial"
						value="initial"
						v-model="filterFields.phase">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="visit__initial">Inicial</label>
			</div>
			
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('phase', $event.target.value)"
						type="radio"
						class="input-radio"
						id="visit__postTreatment"
						value="middle"
						v-model="filterFields.phase">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="visit__postTreatment">Post-tratamiento</label>
			</div>
			
			<div class="flex mb-4">
				<div class="mr-2 relative">
					<input
						@change="sendChange('phase', $event.target.value)"
						type="radio"
						class="input-radio"
						id="visit__monitoring"
						value="final"
						v-model="filterFields.phase">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="visit__monitoring">Seguimiento</label>
			</div>
			
			
			
			
			<div class="text-primary font-semibold uppercase mb-1.5">Tratamiento/s utilizado/s</div>
			
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('treatment', $event.target.value)"
						type="radio"
						class="input-radio"
						id="treatment__hyaluronic_acid"
						value="1"
						v-model="filterFields.treatment">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="treatment__hyaluronic_acid">Ácido hialurónico</label>
			</div>
			
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('treatment', $event.target.value)"
						type="radio"
						class="input-radio"
						id="treatment__botulinum_toxin"
						value="2"
						v-model="filterFields.treatment">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="treatment__botulinum_toxin">Toxina botulínica</label>
			</div>
			
			<div class="flex mb-4">
				<div class="mr-2 relative">
					<input type="radio" class="input-radio" id="treatment__others" name="visit">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="treatment__others">Otros</label>
			</div>
			
			
			
			
			<div class="text-primary font-semibold uppercase mb-1.5">Ángulo de la fotografía</div>
			
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('pic_angle', $event.target.value)"
						type="radio"
						class="input-radio"
						id="angle__front"
						value="front"
						v-model="filterFields.pic_angle">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="angle__front">Mirando hacia el frente</label>
			</div>
			
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('pic_angle', $event.target.value)"
						type="radio"
						class="input-radio"
						id="angle__rightProfile"
						value="right"
						v-model="filterFields.pic_angle">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="angle__rightProfile">Perfil derecho</label>
			</div>
			
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('pic_angle', $event.target.value)"
						type="radio"
						class="input-radio"
						id="angle__leftProfile"
						value="left"
						v-model="filterFields.pic_angle">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="angle__leftProfile">Perfil izquierdo</label>
			</div>
			
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('pic_angle', $event.target.value)"
						type="radio"
						class="input-radio"
						id="angle__threeQuarters"
						value="threequarters"
						v-model="filterFields.pic_angle">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="angle__threeQuarters">Tres cuartos</label>
			</div>
			
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('pic_angle', $event.target.value)"
						type="radio"
						class="input-radio"
						id="angle__smiling"
						value="smiling"
						v-model="filterFields.pic_angle">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="angle__smiling">Sonriendo</label>
			</div>
			
			<div class="flex mb-2">
				<div class="mr-2 relative">
					<input
						@change="sendChange('pic_angle', $event.target.value)"
						type="radio"
						class="input-radio"
						id="angle__angry"
						value="angry"
						v-model="filterFields.pic_angle">
					<span/>
				</div>
				<label class="font-medium uppercase block cursor-pointer hover:text-primary" for="angle__angry">Expresión de enfado</label>
			</div>
		</div>
	</div>
</template>


<script>
	import { defineComponent } from 'vue'

	export default defineComponent({
		
		props: ['filterFields'],
		
		emmits: ['sidebarStatus', 'filter'],
		
		methods: {
			sendChange(_idx, _value){
				this.$emit('filter', [_idx, _value])
			}
		}
	})
</script>
<template>
	<div class="bg-white bg-opacity-70 items-center justify-center inset-0 absolute z-50" :class=" visible ? 'flex' : 'hidden' ">
		<div class="bg-white text-center py-8 px-14 shadow-xl">
			<div class="text-red-600 font-bold uppercase">Estás a punto de borrar un paciente</div>
			<p>¿Estás seguro? Esta acción no podrá deshacerse.</p>
			<div class="flex justify-center gap-5 mt-5">
				<button class="bg-gray-200 text-gray-400 text-sm font-bold uppercase px-8 py-2 inline-block hover:bg-gray-400 hover:text-white">Cancelar</button>
				<button
					@click="confirmDeletion"
					class="bg-red-600 text-white text-sm font-bold uppercase px-8 py-2 inline-block" >Si, bórralo</button>
			</div>
		</div>
	</div>
</template>

<script>
	export default({
		props: {
			visible: false,
			patient: null
		},
		
		methods: {
			confirmDeletion(){
				if( this.patient ){
					this.$emit('patientToDelete', this.patient)
				}
			}
		}
	})
</script>
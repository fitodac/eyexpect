<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;


class Patient extends Model
{
	use HasFactory;
	// use SoftDeletes;
	// use CascadeSoftDeletes;


	protected $fillable = [
		'look',
		'age',
		'gender',
		'treatment'
	];


	/**
	 * Mutators
	 * @var array
	 */
	protected $appends = [
		'uuid',
		'phases'
	];


	protected $cascadeDeletes = ['phases'];


	public function look(){ return $this->belongsTo(Look::class); }
	public function age(){ return $this->belongsTo(Age::class); }
	public function phases(){ return $this->hasMany(Phase::class); }
	public function treatment(){ return $this->belongsTo(Treatment::class); }



	public function getUuidAttribute()
	{
		return sprintf('%05d', $this->id);
	}


	public function getLookAttribute($val)
	{
		return Look::find($val);
	}


	public function getAgeAttribute($val)
	{
		return Age::find($val);
	}


	public function getTreatmentAttribute($val)
	{
		return Treatment::find($val);
	}


	public function getGenderAttribute($val)
	{
		if( 'm' === $val ){
			return ['code' => $val, 'name' => 'masculino'];
		}else{
			return ['code' => $val, 'name' => 'femenino'];
		}
	}


	/**
	 * Devuelve las fases
	 * @return mixed
	 */
	public function getPhasesAttribute()
	{
		return Phase::where('patient_id', $this->id)->get()->keyBy('code');
	}



	/**
	 * Filtra las imágenes de pacientes en la página de lista
	 * @param $patients
	 */
	public function filter($patients, $filter_phase = null, $filter_pic_angle = null)
	{
		$resp = [];


		foreach($patients as $patient){
			foreach($patient->phases as $phase){
				foreach($phase->media as $media){
		// dd($media->responsive_images);

					if( $filter_phase and $phase->code !== $filter_phase ) continue;
					if( $filter_pic_angle and $media->collection_name !== $filter_pic_angle ) continue;
					// Imágenes sin filtro solo toman el 'front'
					if( !$filter_phase and !$filter_pic_angle and $media->collection_name != 'front' ) continue;


					array_push($resp, [
						'id' => $patient->id,
						'thumb' => [
							'id' => $media->id,
							'src' => $media->responsive_images['media_library_original']['urls'][0],
							'pic_angle' => $media->collection_name
						],
						'look' => $patient->look->name,
						'phase' => $phase->code,
						'age' => $patient->age->name,
						'gender' => $patient->gender['code']
					]);
				}
			}
		}

		return $resp;
	}




	/**
	 * Inidcadores de filtros
	 */
	public function filterMessage($filter_type, $filter_text)
	{
		switch($filter_type){
			case 'look': return "<span class='block mb-1.5'>Look $filter_text</span>"; break;
			case 'age': return "<span class='block mb-1.5'>$filter_text años</span>"; break;
			case 'gender':
				if( $filter_text === 'f' ) return "<span class='block mb-1.5'>Mujer</span>";
				if( $filter_text === 'm' ) return "<span class='block mb-1.5'>Hombre</span>";
			break;
			case 'phase':
				if( $filter_text === 'initial' ) return "<span class='block mb-1.5'>Visita Inicial</span>";
				if( $filter_text === 'middle' ) return "<span class='block mb-1.5'>Post-tratamiento</span>";
				if( $filter_text === 'final' ) return "<span class='block mb-1.5'>Seguimiento</span>";
			break;
			case 'treatment': return "<span class='block mb-1.5'>$filter_text</span>"; break;
			case 'pic_angle':
				if( $filter_text === 'front' ) return "<span class='block mb-1.5'>Mirando hacia el frente</span>";
				if( $filter_text === 'right' ) return "<span class='block mb-1.5'>Perfil derecho</span>";
				if( $filter_text === 'left' ) return "<span class='block mb-1.5'>Perfil izquierdo</span>";
				if( $filter_text === 'threequarters' ) return "<span class='block mb-1.5'>Tres cuartos</span>";
				if( $filter_text === 'smiling' ) return "<span class='block mb-1.5'>Sonriendo</span>";
				if( $filter_text === 'angry' ) return "<span class='block mb-1.5'>Expresión de enfado</span>";
			break;
		}

	}


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Illuminate\Support\Facades\Storage;


use Illuminate\Database\Eloquent\SoftDeletes;



class Phase extends Model implements HasMedia
{
	use HasFactory, InteractsWithMedia;
	// use SoftDeletes;

	public $timestamps = false;


	protected $fillable = [
		'code',
		'name',
		'patient_id'
	];


	/**
	 * Relations
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function patient()
	{
		return $this->belongsTo(Patient::class);
	}



	/**
	 * Mutators
	 * @var array
	 */
	protected $appends = [
		'images'
	];


	public $pics = ['front', 'right', 'left', 'threequarters', 'smiling', 'angry'];


	/**
	 * Crea un array de imágenes
	 * @return array
	 */
	public function getImagesAttribute()
	{
		$resp = [];

		foreach ($this->pics as $pic) {
			$img = $this->getMedia($pic);
			$resp[$pic] = isset($img[0]) ? [
				'id' => $img[0]->id,
				'name' => $img[0]->file_name,
				'thumb_src' => $img[0]->getUrl('thumb'),
				'full_src' => $img[0]->getUrl()
			] : null;
		}

		return $resp;
	}


	/**
	 * Recorre $pics y va almacenando las imagenes que se envían en el request
	 * @param $request
	 * @param $phase
	 * @param $type
	 */
	private function fetch_store_images($request, $phase, $type)
	{
		foreach ($this->pics as $pic) {
			if (isset($request->file('phases')[$type]['images'][$pic])) {
				$phase->addMedia($request->file('phases')[$type]['images'][$pic])
					->setFileName(substr(md5(time()), 0, 16) . '.' . $request->file('phases')[$type]['images'][$pic]->extension())
					->withResponsiveImages()
					->toMediaCollection($pic);
			}
		}
	}


	/**
	 * Esta función se usa en el controlador para guardar las imágenes de las diferentes fases
	 * @param $request
	 * @param $patient_id
	 */
	public function store_images($request, $patient_id)
	{

		if (!empty($request['phases']['initial'])) {
			$initial = Phase::create(['code' => 'initial', 'name' => 'Inicial', 'patient_id' => $patient_id]);
			$this->fetch_store_images($request, $initial, 'initial');
		}

		if (!empty($request['phases']['middle'])) {
			$middle = Phase::create(['code' => 'middle', 'name' => 'Media', 'patient_id' => $patient_id]);
			$this->fetch_store_images($request, $middle, 'middle');
		}

		if (!empty($request['phases']['final'])) {
			$final = Phase::create(['code' => 'final', 'name' => 'Final', 'patient_id' => $patient_id]);
			$this->fetch_store_images($request, $final, 'final');
		}
	}




	public function update_images($request)
	{

		foreach ($request['phases'][$this->code]['images'] as $idx => $image) {

			$key = array_search($idx, array_column($request['phases'][$this->code]['media'], 'collection_name'));

			if ($image) {
				if (isset($request->file('phases')[$this->code]['images'][$idx])) {
					if (is_numeric($key)) {
						$img = $this->getMedia($idx)->where('id', $request['phases'][$this->code]['media'][$key]['id']);
						if (isset($img[0])) $img[0]->delete();
						// var_dump($img);
						// var_dump($key);
					}

					$this->addMedia($request->file('phases')[$this->code]['images'][$idx])
						->setFileName(substr(md5(time()), 0, 16) . '.' . $request->file('phases')[$this->code]['images'][$idx]->extension())
						->withResponsiveImages()
						->toMediaCollection($idx);
				}
			} else {

				if (is_numeric($key)) {
					$img = $this->getMedia($idx)->where('id', $request['phases'][$this->code]['media'][$key]['id']);
					if (isset($img[0])) $img[0]->delete();
				}
			}
		}
	}




	/**
	 * Miniaturas
	 * @param $id
	 * @return array
	 */
	public function get_minies()
	{
		$resp = [];
		foreach ($this->pics as $pic) {
			$img = $this->getMedia($pic);
			if (!empty($img[0])) array_push($resp, $img[0]->getUrl('minnie'));
		}
		return $resp;
	}




	/**
	 * Crea las variantes para la imagen principal
	 * @param Media|null $media
	 * @throws \Spatie\Image\Exceptions\InvalidManipulation
	 */
	public function registerMediaConversions(Media $media = null): void
	{
		$this->addMediaConversion('minnie')->width(100)->height(100);
		$this->addMediaConversion('thumb')->width(300)->height(300);
	}
}

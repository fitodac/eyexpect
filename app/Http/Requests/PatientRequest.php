<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
	    'look' => ['required'],
	    'age' => ['required'],
	    'gender' => ['required'],
	    'treatment' => ['required'],
			'phases.initial.images.front' => ['required']
    ];
  }


  public function messages()
  {
		return [
			'look.required' => 'Debes elegir una opción de look',
			'age.required' => 'Debes elegir una edad',
			'gender.required' => 'Debes elegir un género',
			'treatment.required' => 'Debes elegir un tratamiento',
			'phases.initial.images.front.required' => 'La imagen para la fase inicial de frente es obligatoria'
		];
  }

}

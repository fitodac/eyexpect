<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Patient;
use App\Models\Phase;
use App\Models\User;
use App\Models\Look;
use App\Models\Age;
use App\Models\Treatment;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\PatientRequest;


class PatientController extends Controller
{

	private $pag = 8;

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request, User $user)
  {

  	$model = new Patient;
	  $filter_phase = null;
	  $filter_pic_angle = null;
	  $filter_info = '';

  	if( $request->filter ){
  		$patients = Patient::query();

  		if( isset($request->filter['look']) ){
			  $filter_look = $request->filter['look'];
  			$look = Look::find($filter_look);
			  $filter_info .= $model->filterMessage('look', $look->name);
			  $patients = $patients->where('look', $filter_look);
		  }

  		if( isset($request->filter['age']) ){
			  $filter_age = $request->filter['age'];
  			$age = Age::find($filter_age);
			  $filter_info .= $model->filterMessage('age', $age->name);
			  $patients = $patients->where('age', $filter_age);
		  }

  		if( isset($request->filter['gender']) ){
			  $filter_gender = $request->filter['gender'];
			  $filter_info .= $model->filterMessage('gender', $filter_gender);
			  $patients = $patients->where('gender', $filter_gender);
		  }


  		if( isset($request->filter['phase']) ){
			  $filter_phase = $request->filter['phase'];
			  $filter_info .= $model->filterMessage('phase', $filter_phase);
		  }


  		if( isset($request->filter['treatment']) ){
			  $filter_treatment = $request->filter['treatment'];
  			$ttmnt = Treatment::find($filter_treatment);
			  $filter_info .= $model->filterMessage('treatment', $ttmnt->name);
			  $patients = $patients->where('treatment', $filter_treatment);
		  }


		  if( isset($request->filter['pic_angle']) ){
			  $filter_pic_angle = $request->filter['pic_angle'];
			  $filter_info .= $model->filterMessage('pic_angle', $filter_pic_angle);
		  }

		  $patients = $patients->orderByRaw('id DESC');
		  $patients = $patients->paginate($this->pag);

	  }else{
  		$patients = Patient::orderByRaw('id DESC')->paginate($this->pag);
	  }


    return Inertia::render('Patients/Index', [
      'pictures' => $model->filter($patients, $filter_phase, $filter_pic_angle),
			'patients' => $patients,
	    'can_admin' => Auth::user()->hasRole(['Admin', 'Superadmin']),
	    'filter' => $request->filter ? $request->filter : null,
	    'filter_info' => $filter_info
    ]);
  }





  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
	  return Inertia::render('Patients/Create_Edit', [
		  'look' => Look::all(),
		  'ages' => Age::all(),
		  'treatments' => Treatment::all()
	  ]);
  }



  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(PatientRequest $request, Phase $phase)
  {
	  $patient = Patient::create($request->all());
	  $phase->store_images($request, $patient->id);
  	return redirect(route('pacientes.index'));
  }



  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
  	$patient = Patient::find($id);

	   return Inertia::render('Patients/Show', [
	  	'patient' => $patient,
		  'can_admin' => Auth::user()->hasRole(['Admin', 'Superadmin'])
	  ]);
  }



  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

  	$patient = Patient::find($id);

		if( !$patient ) return redirect(route('pacientes.index'));

	  return Inertia::render('Patients/Create_Edit', [
	  	'patient' => Patient::find($id),
		  'look' => Look::all(),
		  'ages' => Age::all(),
		  'treatments' => Treatment::all()
	  ]);
  }



  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(PatientRequest $request, $id)
  {

// dd($request->all());

  	// Actualiza el paciente
  	$patient = Patient::find($id);
  	$patient->update($request->all());

  	// Actualiza las fases
	  foreach( $request->phases as $item ){
		  $phase = Phase::where('patient_id', $id)->firstOrCreate(['code' => $item['code'], 'name' => $item['name'], 'patient_id' => $id]);
		  $phase->update_images($request);
	  }

	  return redirect(route('pacientes.index'));

  }



  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
  	Phase::where('patient_id', $id)->get()->each->delete();
		return Patient::find($id)->delete();
  }
}

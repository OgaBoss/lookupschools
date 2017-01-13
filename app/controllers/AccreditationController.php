<?php

class AccreditationController extends \BaseController {


	/**
	 * Store a newly created resource in storage.
	 * POST /accreditation
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		if(Session::token() !== Input::get('_token') && Input::get('id') == ''){
			return Response::json(array(
				'error_msg' => 'Unauthorized attempt to create setting'
			));
		}

		$school =  School::find(Input::get('id'));
		$accreditation =  new Accreditation;
		if(Input::get('accreditation_1') != '' ||
			Input::get('accreditation_2') != '' ||
			Input::get('accreditation_3') != '' ||
			Input::get('accreditation_4') != '' ||
			Input::get('accreditation_5') != ''
		){
			$accreditation = $accreditation->where('school_id', '=', Input::get('id'))->first();
			if(count($accreditation) > 0){
				$this->allFields($accreditation);
				if($school->accreditation()->save($accreditation)){
					return Response::json(array(
						'save' => 'Accreditation(s) successfully Updated'
					));
				}else{
					return Response::json(array(
						'error_msg' => 'Something went wrong'
					));
				}
			}else{
				$accreditation = new Accreditation(array(
					'accreditations_1' => Input::get('accreditation_1'),
					'accreditations_2' => Input::get('accreditation_2'),
					'accreditations_3' => Input::get('accreditation_3'),
					'accreditations_4' => Input::get('accreditation_4'),
					'accreditations_5' => Input::get('accreditation_5'),
				));
				if($school->accreditation()->save($accreditation)){
					return Response::json(array(
						'save' => 'Accreditation(s) successfully Created'
					));
				}else{
					return Response::json(array(
						'error_msg' => 'Something went wrong'
					));
				}
			}
		}else{
			return Response::json(array(
				'error_msg' => 'Please fill some or all the fields'
			));
		}
	}

	/**
	 * Display the specified resource.
	 * GET /accreditation/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$school = School::findBySlug($id);
		$accreditation = $school->accreditation;
		return View::make('school-admin.school-accreditation')->with('accreditation', $accreditation)->with('school', $school);
	}

	/**
	 * @param $accreditation
	 */
	public function allFields($accreditation)
	{
		$accreditation->accreditations_1 = Input::get('accreditation_1');
		$accreditation->accreditations_2 = Input::get('accreditation_2');
		$accreditation->accreditations_3 = Input::get('accreditation_3');
		$accreditation->accreditations_4 = Input::get('accreditation_4');
		$accreditation->accreditations_5 = Input::get('accreditation_5');
	}


}
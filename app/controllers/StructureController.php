<?php

class StructureController extends \BaseController {

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		//
		$school = School::findBySlug($slug);
		$structure = $school->structure;
		return View::make('school-admin.school-structure')->with('structure', $structure)->with('school', $school);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Session::token() !== Input::get('_token') && Input::get('id') == ''){
			return Response::json(array(
				'error_msg' => 'Unauthorized attempt to create setting'
			));
		}

		$school =  School::find(Input::get('id'));
		$structure = new Structure;
		if(Input::get('dob') != '' ||
			Input::get('school_head') != '' ||
			Input::get('sex') != '' ||
			Input::get('ownership') != '' ||
			Input::get('public') != '' ||
			Input::get('military') != '' ||
			Input::get('private') != '' ||
			Input::get('religion') != '' ||
			Input::get('school_type') != '' ||
			Input::get('tertiary') != '' ||
			Input::get('preschool') != '' ||
			Input::get('range_2') != ''
		){
			$structure = $structure->where('school_id', '=', Input::get('id'))->first();
			if(count($structure) > 0){
				$this->allFields($structure);
				if($school->structure()->save($structure)){
					return Response::json(array(
						'save' => 'School data successfully Updated'
					));
				}else{
					return Response::json(array(
						'error_msg' => 'Something went wrong'
					));
				}
			}else{
				$range = explode(';', Input::get('range_2'));
				$min = $range[0];
				$max = $range[1];
				$structure = new Structure(array(
					'dob' => Input::get('dob'),
					'school_head' => Input::get('school_head'),
					'sex' => Input::get('sex'),
					'ownership' =>Input::get('ownership'),
					'public' => Input::get('public'),
					'military' => Input::get('military'),
					'religion' => Input::get('religion'),
					'school_type' => Input::get('school_type'),
					'tertiary' => Input::get('tertiary'),
					'preschool' => Input::get('preschool'),
					'max' => $max,
					'min' => $min
				));
				if($school->structure()->save($structure)){
					return Response::json(array(
						'save' => 'School data successfully Created'
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
	 * @param $structure
	 */
	public function allFields($structure)
	{
		$range = explode(';', Input::get('range_2'));
		$min = $range[0];
		$max = $range[1];
		$structure->dob = Input::get('dob');
		$structure->school_head = Input::get('school_head');
		$structure->sex = Input::get('sex');
		$structure->ownership = Input::get('ownership');
		$structure->public = Input::get('public');
		$structure->military = Input::get('military');
		$structure->private = Input::get('private');
		$structure->religion = Input::get('religion');
		$structure->school_type = Input::get('school_type');
		$structure->preschool = Input::get('preschool');
		$structure->tertiary = Input::get('tertiary');
		$structure->max = $max;
		$structure->min = $min;
	}


}

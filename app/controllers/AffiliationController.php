<?php

class AffiliationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /affiliation
	 *
	 * @return Response
	 */
	public function show($slug)
	{
		//
		$school = School::findBySlug($slug);
		$affiliation = $school->affiliation;
		return View::make('school-admin.school-affiliation')->with('affiliation', $affiliation)->with('school', $school);
	}


	/**
	 * Store a newly created resource in storage.
	 * POST /affiliation
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
		$affiliation = new Affiliation;
		if(Input::get('affiliations_1') != '' ||
			Input::get('affiliations_2') != '' ||
			Input::get('affiliations_3') != '' ||
			Input::get('affiliations_4') != '' ||
			Input::get('affiliations_5') != '' ||
			Input::get('affiliations_6') != ''
		){
			$affiliation = $affiliation->where('school_id', '=', Input::get('id'))->first();
			if(count($affiliation) > 0){
				$this->allFields($affiliation);
				if($school->affiliation()->save($affiliation)){
					return Response::json(array(
						'save' => 'Affiliation(s) successfully Updated'
					));
				}else{
					return Response::json(array(
						'error_msg' => 'Something went wrong'
					));
				}
			}else{
				$affiliation = new Affiliation(array(
					'affiliations_1' =>  Input::get('affiliations_1'),
					'affiliations_2' =>  Input::get('affiliations_2'),
					'affiliations_3' =>  Input::get('affiliations_3'),
					'affiliations_4' =>  Input::get('affiliations_4'),
					'affiliations_5' =>  Input::get('affiliations_5'),
					'affiliations_6' =>  Input::get('affiliations_6'),
				));
				if($school->affiliation()->save($affiliation)){
					return Response::json(array(
						'save' => 'Affiliation(s) successfully Created'
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
	 * @param $affiliation
	 */
	public function allFields($affiliation)
	{
		$affiliation->affiliations_1 = Input::get('affiliations_1');
		$affiliation->affiliations_2 = Input::get('affiliations_2');
		$affiliation->affiliations_3 = Input::get('affiliations_3');
		$affiliation->affiliations_4 = Input::get('affiliations_4');
		$affiliation->affiliations_5 = Input::get('affiliations_5');
		$affiliation->affiliations_6 = Input::get('affiliations_6');
	}


}
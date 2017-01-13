<?php

class ContactController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function show($slug)
	{
		//
		$school = School::findBySlug($slug);
		$contact = $school->contact;
		return View::make('school-admin.school-contact')->with('contact', $contact)->with('school', $school);
	}



	/**
	 * Store a newly created resource in storage.
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

		if(Input::get('phone_1') == '' && Input::get('info_email') == ''){
			return Response::json(array(
				'error_msg' => 'Please make sure the required fields are not empty'
			));
		}

		$school =  School::find(Input::get('id'));
		$contact = new Contact;
		if((Input::get('phone_1') != '' && Input::get('info_email') != '')  ||
			Input::get('phone_2') != '' ||
			Input::get('mobile_1') != '' ||
			Input::get('website') != '' ||
			Input::get('fax') != '' ||
			Input::get('telex') != '' ||
			Input::get('mobile_2') != '' ||
			Input::get('sale_email') != '' ||
			Input::get('academic_email') != ''
		){
			$contact = $contact->where('school_id', '=', Input::get('id'))->first();
			if(count($contact) > 0){
				$this->allFields($contact);
				if($school->contact()->save($contact)){
					return Response::json(array(
						'save' => 'Contact successfully Updated'
					));
				}else{
					return Response::json(array(
						'error_msg' => 'Something went wrong'
					));
				}
			}else{
				$contact = new Contact(array(
					'website' => Input::get('website'),
					'info_email' => Input::get('info_email'),
					'sale_email' => Input::get('sale_email'),
					'academic_email' => Input::get('academic_email'),
					'phone_1' => Input::get('phone_1'),
					'phone_2' => Input::get('phone_2'),
					'mobile_1' => Input::get('mobile_1'),
					'mobile_2' => Input::get('mobile_2'),
					'fax' => Input::get('fax'),
					'telex' => Input::get('telex'),
				));
				if($school->contact()->save($contact)){
					return Response::json(array(
						'save' => 'Contact successfully Created'
					));
				}else{
					return Response::json(array(
						'error_msg' => 'Something went wrong'
					));
				}
			}
		}
	}

	/**
	 * @param $contact
	 */
	public function allFields($contact)
	{
		$contact->website = Input::get('website');
		$contact->info_email = Input::get('info_email');
		$contact->sale_email = Input::get('sale_email');
		$contact->academic_email = Input::get('academic_email');
		$contact->phone_1 = Input::get('phone_1');
		$contact->phone_2 = Input::get('phone_2');
		$contact->mobile_1 = Input::get('mobile_1');
		$contact->mobile_2 = Input::get('mobile_2');
		$contact->fax = Input::get('fax');
		$contact->telex = Input::get('telex');
	}
}

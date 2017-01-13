<?php

class TertiaryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /tertiary
	 *
	 * @return Response
	 */
	public function index($slug)
	{
		//
        $school = School::findBySlug($slug);
        $tertiary = $school->tertiaries;
        return View::make('school-admin.school-tertiary')
            ->with('tertiary', $tertiary)
            ->with('school', $school);
    }



	/**
	 * Store a newly created resource in storage.
	 * POST /tertiary
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
        $school = School::find(Input::get('id'));
        $tertiary = new Tertiary;
        $medical = $health = $vocational = $sport = $vocationCategory = $program = $club = $accommodation = [];
        if (isset($_POST['medical_facilities'])) {
            foreach ($_POST['medical_facilities'] as $t) {
                $medical[] = $t;
            }
        }

        if (isset($_POST['health_prof'])) {
            foreach ($_POST['health_prof'] as $t) {
                $health[] = $t;
            }
        }

        if (isset($_POST['vocational_facility'])) {
            foreach ($_POST['vocational_facility'] as $t) {
                $vocational[] = $t;
            }
        }

        if (isset($_POST['sport_facility'])) {
            foreach ($_POST['sport_facility'] as $t) {
                $sport[] = $t;
            }
        }

        if (isset($_POST['vocation_category'])) {
            foreach ($_POST['vocation_category'] as $t) {
                $vocationCategory[] = $t;
            }
        }

        if (isset($_POST['vocation_category'])) {
            foreach ($_POST['vocation_category'] as $t) {
                $vocationCategory[] = $t;
            }
        }

        if (isset($_POST['program'])) {
            foreach ($_POST['program'] as $t) {
                $program[] = $t;
            }
        }

        if (isset($_POST['club'])) {
            foreach ($_POST['club'] as $t) {
                $club[] = $t;
            }
        }

        if (isset($_POST['accommodation'])) {
            foreach ($_POST['accommodation'] as $t) {
                $accommodation[] = $t;
            }
        }

        if(Input::get('average-student') != '' ||
            Input::get('age_limit') != '' ||
            Input::get('medical_facilities') != '' ||
            Input::get('health_prof') != '' ||
            Input::get('vocational_facility') != '' ||
            Input::get('sport_facility') != '' ||
            Input::get('vocation_category') != '' ||
            Input::get('program') != '' ||
            Input::get('club') != '' ||
            Input::get('accommodation') != ''
        ){
            $tertiary = $tertiary->where('school_id', '=', Input::get('id'))->first();
            if(count($tertiary) > 0){
                $tertiary->average_student = Input::get('average-student');
                $tertiary->admission_age_limit = Input::get('age_limit');
                $tertiary->medical_facility = serialize($medical);
                $tertiary->health_prof = serialize($health);
                $tertiary->accommodation = serialize($accommodation);
                $tertiary->vocational_facility = serialize($vocational);
                $tertiary->sport_facility = serialize($sport);
                $tertiary->club_society = serialize($club);
                $tertiary->vocation_category = serialize($vocationCategory);
                $tertiary->program_offered = serialize($program);
                if($school->tertiaries()->save($tertiary)){
                    return Response::json(array(
                        'save' => 'School data successfully Updated'
                    ));
                }else{
                    return Response::json(array(
                        'error_msg' => 'Something went wrong'
                    ));
                }
            }else{
                $tertiary =  new Tertiary(array(
                    'medical_facility' => serialize($medical),
                    'health_prof' => serialize($health),
                    'accommodation' => serialize($accommodation),
                    'average_student' => Input::get('average-student'),
                    'admission_age_limit' => Input::get('age_limit'),
                    'vocational_facility' => serialize($vocational),
                    'club_society' => serialize($club),
                    'vocation_category' => serialize($vocationCategory),
                    'sport_facility' => serialize($sport),
                    'program_offered' => serialize($program)
                ));
                if($school->tertiaries()->save($tertiary)){
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
}
<?php

class PrimaryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /primary
	 *
	 * @return Response
	 */
	public function index($slug)
	{
		//
        $school = School::findBySlug($slug);
        $primary = $school->primary;
        return View::make('school-admin.school-primary')
            ->with('primary', $primary)
            ->with('school', $school);
    }



	/**
	 * Store a newly created resource in storage.
	 * POST /primary
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
        $primary = new Primary();
        if($school['school_type'] == "preschool"){
            if(Input::get('average-baby-no') != '' ||
                Input::get('daycare_locker_type') != '' ||
                Input::get('nanny_baby_ratio') != '' ||
                Input::get('admission_age_limit') != '' ||
                Input::get('ict_room') != ''
            ){
                $primary = $primary->where('school_id', '=', Input::get('id'))->first();
                if(count($primary)){
                    $primary->average_children_daycare = Input::get('average-baby-no');
                    $primary->daycare_locker_type = Input::get('daycare_locker_type');
                    $primary->nanny_baby_ratio = Input::get('nanny_baby_ratio');
                    $primary->admission_age_limit = Input::get('age_limit');
                    $primary->ict_room = Input::get('ict_room');
                    if($school->primary()->save($primary)){
                        return Response::json(array(
                            'save' => 'School data successfully Updated'
                        ));
                    }else{
                        return Response::json(array(
                            'error_msg' => 'Something went wrong'
                        ));
                    }
                }else{
                   $primary = new Primary(array(
                       'average_children_daycare' => Input::get('average-baby-no'),
                       'daycare_locker_type' => Input::get('daycare_locker_type'),
                       'nanny_baby_ratio' => Input::get('nanny_baby_ratio'),
                       'admission_age_limit' => Input::get('age_limit'),
                       'ict_room' =>  Input::get('ict_room')
                   ));
                    if($school->primary()->save($primary)){
                        return Response::json(array(
                            'save' => 'School data successfully Updated'
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
        }elseif($school['school_type'] == "secondary" || $school['school_type'] == "primary"){
            if(Input::get('average-class-no') != '' ||
                Input::get('average-child-room') != '' ||
                Input::get('boarding_locker_type') != '' ||
                Input::get('teacher_student_ratio') != '' ||
                Input::get('admission_age_limit') != '' ||
                Input::get('ict_room') != ''
            ){
                $primary = $primary->where('school_id', '=', Input::get('id'))->first();
                if(count($primary)){
                    $primary->average_children_class = Input::get('average-class-no');
                    $primary->average_child_room = Input::get('average-child-room');
                    $primary->teacher_student_ratio = Input::get('teacher_student_ratio');
                    $primary->boarding_locker_type = Input::get('boarding_locker_type');
                    $primary->admission_age_limit = Input::get('age_limit');
                    $primary->ict_room = Input::get('ict_room');
                    if($school->primary()->save($primary)){
                        return Response::json(array(
                            'save' => 'School data successfully Updated'
                        ));
                    }else{
                        return Response::json(array(
                            'error_msg' => 'Something went wrong'
                        ));
                    }
                }else{
                    $primary = new Primary(array(
                        'average_children_class' => Input::get('average-class-no'),
                        'average_child_room' => Input::get('average-child-room'),
                        'teacher_student_ratio' => Input::get('teacher_student_ratio'),
                        'boarding_locker_type' => Input::get('boarding_locker_type'),
                        'admission_age_limit' => Input::get('age_limit'),
                        'ict_room' =>  Input::get('ict_room')
                    ));
                    if($school->primary()->save($primary)){
                        return Response::json(array(
                            'save' => 'School data successfully Updated'
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

    public function postExtras(){
        //
        if(Session::token() !== Input::get('_token') && Input::get('id') == ''){
            return Response::json(array(
                'error_msg' => 'Unauthorized attempt to create setting'
            ));
        }
        $school = School::find(Input::get('id'));
        $primary = new Primary();
        $medical = $health = $vocational = $sport = $subject_offered = $daycare = $club = [];
        if (isset($_POST['medical_facility'])) {
            foreach ($_POST['medical_facility'] as $t) {
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

        if (isset($_POST['subject_offered'])) {
            foreach ($_POST['subject_offered'] as $t) {
                $subject_offered[] = $t;
            }
        }

        if (isset($_POST['clubs_societies'])) {
            foreach ($_POST['clubs_societies'] as $t) {
                $club[] = $t;
            }
        }

        if (isset($_POST['daycare_facility'])) {
            foreach ($_POST['daycare_facility'] as $t) {
                $daycare[] = $t;
            }
        }

        if(Input::get('medical_facility') != '' ||
            Input::get('health_prof') != '' ||
            Input::get('vocational_facility') != '' ||
            Input::get('sport_facility') != '' ||
            Input::get('subject_offered') != '' ||
            Input::get('club_society') != '' ||
            Input::get('daycare_facility') != ''
        ){
            $primary = $primary->where('school_id', '=', Input::get('id'))->first();
            if(count($primary) > 0){
                $primary->medical_facility = serialize($medical);
                $primary->health_prof = serialize($health);
                $primary->daycare_facility = serialize($daycare);
                $primary->vocational_facility = serialize($vocational);
                $primary->sport_facility = serialize($sport);
                $primary->clubs_societies = serialize($club);
                $primary->subject_offered = serialize($subject_offered);
                if($school->primary()->save($primary)){
                    return Response::json(array(
                        'save' => 'School data successfully Updated'
                    ));
                }else{
                    return Response::json(array(
                        'error_msg' => 'Something went wrong'
                    ));
                }
            }else{
                $primary =  new Primary(array(
                    'medical_facility' => serialize($medical),
                    'health_prof' => serialize($health),
                    'daycare_facility' => serialize($daycare),
                    'vocational_facility' => serialize($vocational),
                    'clubs_societies' => serialize($club),
                    'subject_offered' => serialize($subject_offered),
                    'sport_facility' => serialize($sport),
                ));
                if($school->primary()->save($primary)){
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
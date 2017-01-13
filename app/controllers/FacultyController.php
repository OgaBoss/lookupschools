<?php

class FacultyController extends \BaseController {
	/**
	 * Show the form for creating a new resource.
	 * GET /faculty/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['school_id'])){
            $fid = $_POST['id'];
            $school = School::find($_POST['school_id']);
            $savedFid = $school->faculty->lists('id');


            //check if  this is an addition or removal
            //if school faculty ids is greater than the
            //incomming id then this is a removal
            if(count($savedFid) > count($fid)){
                for($r=0; $r < count($savedFid); $r++){
                    if(!in_array($savedFid[$r], $fid)){
                        $attachment = $school->faculty()->detach($savedFid[$r]);
                        if($attachment == 1){
                            return Response::json(array(
                                'save' => 'Faculty removed for this school'
                            ));
                        }
                    }
                }
            }elseif(count($savedFid) <= count($fid)){
                for($r=0;$r < count($fid); $r++){
                    if(!in_array($fid[$r], $savedFid)){
                        $school->faculty()->attach($fid[$r]);
                    }
                }
                return Response::json(array(
                    'save' => 'Faculties Updated for this school'
                ));
            }
        }elseif( $_POST['id'] == 'null' || empty($_POST['id'])){
            $schoolFaculty = new FacultySchool;
            $lastAttachment = $schoolFaculty->where('school_id', '=', $_POST['school_id'])->delete();
            if($lastAttachment == 1){
                return Response::json(array(
                    'warning' => 'This School has no Faculty.'
                ));
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /faculty/{id}
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		//
        $school = School::findBySlug($slug);
        //dd($school->course);
        return View::make('school-admin.faculty-courses')
            ->with('faculty', Faculty::all())
            ->with('school', $school)
            ->with('schoolFaculty', $school->faculty);

	}

    public function postCourse(){
        $facultySchoolCourse = new FacultySchoolCourse;
        $course = [];
        if(isset($_POST['faculty_id'])){
            if(isset($_POST['courses']) && !empty($_POST['courses'])){
                foreach($_POST['courses'] as $t ){
                    $course[] = $t;
                }
                if(isset($_POST['school_id'])){
                    $facultySchool = new FacultySchool;
                    $facultySchool = $facultySchool->where('school_id', '=', $_POST['school_id'])
                        ->where('faculty_id','=',$_POST['faculty_id'])->get();
                    if(count($facultySchool) == 1){
                        foreach($facultySchool as $fs){
                            $facultySchoolCourse = $facultySchoolCourse->where('faculty_school_id', '=', $fs->id)->get();
                            if(count($facultySchoolCourse) == 0){
                                $facultySchoolCourse = new FacultySchoolCourse(array(
                                    'id' => $fs->id,
                                    'course' => serialize($course)
                                ));
                                if($fs->facultySchoolCourse()->save($facultySchoolCourse) ){
                                    return Response::json(array(
                                        'save' => 'Courses Registered for the school'
                                    ));
                                }
                            }else{
                                $flsc = new FacultySchoolCourse;
                                $fac = Faculty::find($_POST['faculty_id']);
                                foreach($fac->courses as $cur){
                                    $course_arr = unserialize($cur->course);
                                }
                                $flsc = $flsc
                                    ->where('faculty_school_id', '=', $fs->id)
                                    ->update(['id' => $fs->id, 'course' => serialize($course) ]);
                                if($flsc == 1){
                                    if(count($course_arr) > count($course)){
                                        return Response::json(array(
                                            'save' => 'Course(s) removed for this school'
                                        ));
                                    }elseif(count($course_arr) < count($course)){
                                        return Response::json(array(
                                            'save' => 'Course(s) added for this school'
                                        ));
                                    }elseif(count($course_arr) == count($course)){
                                        return Response::json(array(
                                            'save' => 'Course(s) Updated for this school'
                                        ));
                                    }else{

                                    }

                                }else{
                                    return Response::json(array(
                                        'error_msg' => 'Try again, something went wrong'
                                    ));
                                }

                            }
                        }
                    }
                }
            }else{
                //TODO
                //Ask if user wants delete school-faculty association

            }
        }
    }

}
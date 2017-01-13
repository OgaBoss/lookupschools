<?php
    use OAuth\Common\Exception\Exception;

    /**
     * Created by PhpStorm.
     * User: OluwadamilolaAdebayo
     * Date: 3/19/16
     * Time: 10:42 AM
     */
    class MiniSiteController extends \BaseController{
        public function index($slug){
            $school = School::findBySlug($slug);
            $webimages = $school->webPageImage;
            $webimages_defaults = ['/img/slider01.jpg','/img/slider02.jpg','/img/slider03.jpg'];
            $teams = $school->team;
            $contact = $school->contact;
            $testimony = $school->testimony;
            $identifier = '/mini-site/school/'.$slug;
            $url = APP_PREFIXED_HOST.'/mini-site/school/'.$slug;
            return View::make('mini-site.home')
                ->with('school', $school)
                ->with('webimages', $webimages)
                ->with('web_defaults', $webimages_defaults)
                ->with('teams', $teams)
                ->with('testimony', $testimony)
                ->with('contact', $contact)
                ->with('identifier', $identifier)
                ->with('page_url', $url);
        }

        public function getWebPage($slug){
            $school = School::findBySlug($slug);
            $team = new Team;
            $testimony = new Testimony;
            $team_1 = $team->where('school_id','=', $school->id)
                ->where('team_count','=','team-member-1')
                ->first();
            $team_2 = $team->where('school_id','=', $school->id)
                ->where('team_count','=','team-member-2')
                ->first();
            $team_3 = $team->where('school_id','=', $school->id)
                ->where('team_count','=','team-member-3')
                ->first();
            $testimony_1 = $testimony->where('school_id','=', $school->id)
                ->where('count','=','testimony-1')
                ->first();
            $testimony_2 = $testimony->where('school_id','=', $school->id)
                ->where('count','=','testimony-2')
                ->first();
            $testimony_3 = $testimony->where('school_id','=', $school->id)
                ->where('count','=','testimony-3')
                ->first();
            return View::make('school-admin.web-page')->with('school', $school)
                ->with('team_1', $team_1)
                ->with('team_2', $team_2)
                ->with('team_3', $team_3)
                ->with('testimony_1', $testimony_1)
                ->with('testimony_2', $testimony_2)
                ->with('testimony_3', $testimony_3);
        }

        public function postStatement(){
            if ( Session::token () !== Input::get ( '_token' ) && Input::get ( 'id' ) == '' )
            {
                return Response::json ( [
                    'error_msg' => 'Unauthorized attempt to create setting'
                ] );
            }

            if(Input::get('moto') != "" && Input::get('vision') != "" && Input::get('mission') ){
                $school = School::find(Input::get('id'));
                $school->moto = Input::get('moto');
                $school->vision = Input::get('vision');
                $school->mission = Input::get('mission');

                if($school->save()){
                    return Response::json ( [
                        'save' => 'Information successfully Saved'
                    ] );
                }else{
                    return Response::json ( [
                        'error_msg' => 'Ooops! something went wrong'
                    ] );
                }
            }else{
                return Response::json ( [
                    'error_msg' => 'Please make sure all the fields are filled'
                ] );
            }
        }

        public function uploadImage(){
            $school = School::find ( Input::get ( 'id' ) );
            $schoolName = $school->slug;
            if ( isset($_FILES[ 'upload_file' ]) )
            {
                $teams = $school->team;
                if ( count ( $teams ) > 2 )
                {
                    return Response::json ( [
                        'error_msg' => "You already have 3 Team Members"
                    ] );
                } else
                {
                    if ( $_FILES[ 'upload_file' ][ 'error' ] )
                    {
                        return Response::json ( [
                            'error_msg' => "Something went wrong, please try again later or use another image"
                        ] );
                    }
                    $name = $_FILES[ 'upload_file' ][ 'name' ];
                    $size = $_FILES[ 'upload_file' ][ 'size' ];
                    $file_tmp = $_FILES[ 'upload_file' ][ 'tmp_name' ];
                    $file_ext = explode ( '.', $name );
                    $file_ext = end ( $file_ext );
                    $file_ext = strtolower ( $file_ext );
                    $extensions = ["jpeg", "jpg", "png"];

                    if ( in_array ( $file_ext, $extensions ) === false )
                    {
                        return Response::json ( [
                            'error_msg' => "Please Upload an image that are one of the following jpeg, png, jpg"
                        ] );
                    }

                    if ( $size > 500000 )
                    {
                        return Response::json ( [
                            'error_msg' => "Please Upload an image that is 500KB or less"
                        ] );
                    }

                    try{
                        $uploader = Cloudy::getUploader ();
                        $results = $uploader->upload ( $file_tmp, $options = [
                            'public_id' => $schoolName."-".count($teams),
                            'folder'    =>  Input::get ( 'type' )
                        ] );
                        $t = new Team;
                        $t = $t->where('team_count','=',Input::get('count'))->first();
                        if(count($t) > 0){
                            $t->image_url = $results[ 'url' ];
                            if ( $t->save() )
                            {
                                return Response::json ( [
                                    'save' => $t->image_url
                                ] );
                            } else
                            {
                                return Response::json ( [
                                    'error_msg' => 'Something went wrong !'
                                ] );
                            }
                        }else{
                            $image = new Team( [
                                'image_url'   => $results[ 'url' ],
                                'team_count' => Input::get('count')
                            ] );

                            if ( $school->team()->save ( $image ) )
                            {
                                return Response::json ( [
                                    'save' => $results[ 'url' ]
                                ] );
                            } else
                            {
                                return Response::json ( [
                                    'error_msg' => 'Something went wrong !'
                                ] );
                            }
                        }


                    }catch(\Cloudinary\Error $e){
                        return Response::json ( [
                            'error_msg' => 'Something went wrong from the server!'
                        ] );
                    }

                }
            } else
            {
                return Response::json ( [
                    'error_msg' => "Something went wrong, please try again later or use another image"
                ] );
            }
        }

        public function setTeamMemberData(){
            $id = Input::get('id');
            $count = Input::get('team_count');
            $name = Input::get('name');
            $position = Input::get('position');
            $bio = Input::get('bio');
            if($id != "" && $count != ""){
                $team = new Team;
                $team  = $team->where('school_id', '=', $id)
                    ->where('team_count','=', $count)
                    ->first();
                if(count($team) == 1){
                    if($name != "" && $position != "" && $bio != ""){
                        $team->name = $name;
                        $team->position = $position;
                        $team->bio = $bio;

                        if($team->save()){
                            return Response::json ( [
                                'save' => 'Data successfully captured'
                            ] );
                        }else{
                            return Response::json ( [
                                'error_msg' => 'Something went wrong !'
                            ] );
                        }
                    }else{
                        return Response::json ( [
                            'error_msg' => 'Please fill up all fields'
                        ] );
                    }
                }
            }
        }

        public function setTestimony(){
            $id = Input::get('id');
            $count = Input::get('count');
            $name = Input::get('name');
            $testimony = Input::get('testimony');
            if($id != "" && $count != ""){
                $t = new Testimony;
                $t  = $t->where('school_id', '=', $id)
                    ->where('count','=', $count)
                    ->first();
                if(count($t) == 1){
                    if($name != "" && $testimony != ""){
                        $t->name = $name;
                        $t->testimony = $testimony;

                        if($t->save()){
                            return Response::json ( [
                                'save' => 'Data successfully captured'
                            ] );
                        }else{
                            return Response::json ( [
                                'error_msg' => 'Something went wrong !'
                            ] );
                        }
                    }else{
                        return Response::json ( [
                            'error_msg' => 'Please fill up all fields'
                        ] );
                    }
                }
            }
        }

        public function testimonyUpload(){
            $school = School::find ( Input::get ( 'id' ) );
            $schoolName = $school->slug;
            if ( isset($_FILES[ 'upload_file' ]) )
            {
                $testimony = $school->testimony;
                if ( count ( $testimony ) > 2 )
                {
                    return Response::json ( [
                        'error_msg' => "You already have 3 Team Members"
                    ] );
                } else
                {
                    if ( $_FILES[ 'upload_file' ][ 'error' ] )
                    {
                        return Response::json ( [
                            'error_msg' => "Something went wrong, please try again later or use another image"
                        ] );
                    }
                    $name = $_FILES[ 'upload_file' ][ 'name' ];
                    $size = $_FILES[ 'upload_file' ][ 'size' ];
                    $file_tmp = $_FILES[ 'upload_file' ][ 'tmp_name' ];
                    $file_ext = explode ( '.', $name );
                    $file_ext = end ( $file_ext );
                    $file_ext = strtolower ( $file_ext );
                    $extensions = ["jpeg", "jpg", "png"];

                    if ( in_array ( $file_ext, $extensions ) === false )
                    {
                        return Response::json ( [
                            'error_msg' => "Please Upload an image that are one of the following jpeg, png, jpg"
                        ] );
                    }

                    if ( $size > 500000 )
                    {
                        return Response::json ( [
                            'error_msg' => "Please Upload an image that is 500KB or less"
                        ] );
                    }

                    try{
                        $uploader = Cloudy::getUploader ();
                        $results = $uploader->upload ( $file_tmp, $options = [
                            'public_id' => $schoolName."-".count($testimony),
                            'folder'    =>  Input::get ( 'type' )
                        ] );
                        $t = new Testimony();
                        $t = $t->where('count','=',Input::get('count'))->first();
                        if(count($t) > 0){
                            $t->image_url = $results[ 'url' ];
                            if ( $t->save() )
                            {
                                return Response::json ( [
                                    'save' => $t->image_url
                                ] );
                            } else
                            {
                                return Response::json ( [
                                    'error_msg' => 'Something went wrong !'
                                ] );
                            }
                        }else{
                            $image = new Testimony( [
                                'image_url'   => $results[ 'url' ],
                                'count' => Input::get('count')
                            ] );

                            if ( $school->testimony()->save ( $image ) )
                            {
                                return Response::json ( [
                                    'save' => $results[ 'url' ]
                                ] );
                            } else
                            {
                                return Response::json ( [
                                    'error_msg' => 'Something went wrong !'
                                ] );
                            }
                        }
                    }catch(\Cloudinary\Error $e){
                        return Response::json ( [
                            'error_msg' => 'Something went wrong from the server!'
                        ] );
                    }
                }
            } else
            {
                return Response::json ( [
                    'error_msg' => "Something went wrong, please try again later or use another image"
                ] );
            }
        }
    }

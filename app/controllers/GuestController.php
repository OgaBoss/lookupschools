<?php

    class GuestController extends \BaseController {

        /**
         * Display a listing of the resource.
         * GET /guest
         *
         * @return Response
         */
        public function index()
        {
            $user = Sentry::getUser ();
            $id = $user->id;
            $new = User::find ( $id );
            $schools = $new->schools;
            return View::make( 'guest.dashboard' )
                ->with('schools', $schools);

        }

        /**
         * Show the form for creating a new resource.
         * GET /guest/create
         *
         * @return Response
         */
        public function followSchool()
        {
            if(!empty(Input::get('school_id'))){
                if(Sentry::check()){
                    $school = School::find(Input::get('school_id'));
                    $user = Sentry::getUser ();
                    $res = DB::table('school_user')
                        ->where('school_id','=',Input::get('school_id'))
                        ->where('user_id','=',$user->id)
                        ->get();
                    if(count($res) == 0){
                        $user->schools()->attach(Input::get('school_id'));
                        return Response::json(array(
                            'save' => $user->first_name.", you are now following ".$school->name
                        ));
                    }else{
                        return Response::json(array(
                            'error_msg' => 'You already follow this school'
                        ));
                    }
                }else{
                    return Response::json(array(
                        'login' => 'login'
                    ));
                }
            }
        }


        /**
         * Display the specified resource.
         * GET /guest/{id}
         *
         * @param $slug
         * @return Response
         */
        public function getBasicInfo($slug)
        {
            //

            $school = School::findBySlug ( $slug );
            $imageUrl = $school->photos;
            $userSchoolRank = new UserSchoolRank;
            $rank_data = $userSchoolRank
                ->where( 'school_id', '=', $school->id )
                ->where( 'user_id', '=', Sentry::getUser()->id )
                ->first();

            return View::make ( 'guest.school_show' )
                ->with ( 'school', $school )
                ->with ( 'imageUrl', $imageUrl )
                ->with ( 'rank', $school->schoolRank['rank'])
                ->with ('user_rank', $rank_data['rank']);
        }

        /**
         * Show the form for editing the specified resource.
         * GET /guest/{id}/edit
         *
         * @param  int $id
         * @return Response
         */
        public function edit( $id )
        {
            //
        }

        /**
         * Update the specified resource in storage.
         * PUT /guest/{id}
         *
         * @param  int $id
         * @return Response
         */
        public function update( $id )
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         * DELETE /guest/{id}
         *
         * @param  int $id
         * @return Response
         */
        public function destroy( $id )
        {
            //
        }

    }

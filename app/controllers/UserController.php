<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /user
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /user/create
	 *
	 * @return Response
	 */
	public function create()
	{
        if(Session::token() !== Input::get('_token')){
            return Response::json(array(
                'error_msg' => 'Unauthorized attempt to create setting'
            ));
        }

        //Check if all  fields are filled
        if(Input::get('firstname') == "" ||
            Input::get('lastname') == "" ||
            Input::get('email') == "" ||
            Input::get('type') == "" ||
            Input::get('attach') == ""
        ){
            return Response::json(array(
                'error_msg' => 'Make sure all the fields are filled'
            ));
        }else{
            try{
                //check to see if we have that email in our system already
                $user_check = Sentry::findUserByLogin(Input::get('email'));
                //If we do return this
                return Response::json(array(
                    'error_msg' => 'User with this '.Input::get('email').' already exists.'
                ));

            }catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
            {
                //if we dont
                //Create new user
                $user = EduAuth::createNewUser('user');
                if(!empty($user)){
                    $activationCode = $user->getActivationCode();
                    //create email data and return data
                    $data = array(
                        'id'            => $user->id,
                        'fullname'      =>  Input::get('firstname')." ".Input::get('lastname'),
                        'email'         =>  Input::get('email'),
                        'password'         =>  Input::get('email'),
                        'conf_code'     =>  $activationCode,
                        'site_name'     =>  APP_PREFIXED_HOST,
                    );

                    //Send the user email notification
                    //$email = Notifications::notify('new_user', $data);
                    $email = 'success';

                    if($email == 'success'){
                        //Add user to school or schools
                        $schs = Input::get('attach');
                        for($r=0;$r<count($schs);$r++){
                            $user->schools()->attach($schs[$r]);
                        }
                        return Response::json(array(
                            'save' => 'New User created and email sent to notify them'
                        ));
                    }else{
                        $user->delete();
                        return Response::json(array(
                            'error_msg' => 'Something went wrong, please try some times later'
                        ));
                    }

                }else{
                    return Response::json(array(
                        'error_msg' => 'Something went wrong, please try some times later'
                    ));
                }
            }
        }
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /user
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /user/{id}
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		//
        $school = School::findBySlug($slug);
        //Will return all the users of this school
        $users = $school->user;
        //To return all the school the current user has
        $currentUser = Sentry::getUser();
        $schools = $currentUser->schools;

        return View::make('school-admin.create')
            ->with('schoolUsers', $users)
            ->with('school', $school)
            ->with('schools', $schools);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /user/{id}/edit
	 *
	 * @return Response
	 */
	public function editPassword()
	{
		//

        if(Session::token() !== Input::get('_token')){
            return Response::json(array(
                'error_msg' => 'Unauthorized attempt to create setting'
            ));
        }

        if( (Input::get('new_pass') != Input::get('conf_pass')) && (Input::get('new_pass') == "" && Input::get('conf_pass') == '') ){
            return Response::json(array(
                'error_msg' => 'New password and password confirmation do not match.'
            ));
        }else{
            $user = Sentry::getUser();
            $resetCode = $user->getResetPasswordCode();
            // Check if the reset password code is valid
            if ($user->checkResetPasswordCode($resetCode))
            {
                // Attempt to reset the user password
                if ($user->attemptResetPassword($resetCode, Input::get('new_pass')))
                {
                    // Password reset passed
                    //send email
                    //encrypt password
                    $pass = EduAuth::encrypt_decrypt('encrypt',Input::get('new_pass'));
                    $user->encrypt_password = $pass;
                    $user->save();
                    return Response::json(array(
                        'save' => 'Password changed'
                    ));
                }
                else
                {
                    // Password reset failed
                    return Response::json(array(
                        'error_msg' => 'Please try again, something went wrong.'
                    ));
                }
            }
        }

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /user/{id}
	 *
	 * @return Response
	 */
	public function editProfile()
	{
		//
        if(Session::token() !== Input::get('_token')){
            return Response::json(array(
                'error_msg' => 'Unauthorized attempt to create setting'
            ));
        }

        if(Input::get('last_name') == "" && Input::get('first_name') == "" && Input::get('email') == "" ){
            return Response::json(array(
                'error_msg' => 'Please fill the form fields'
            ));
        }

        if(Input::get('last_name') != "" || Input::get('first_name') != "" || Input::get('email') != "" ){
            $user = Sentry::getUser();
            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->email = Input::get('email');

            if($user->save()){
                return Response::json(array(
                    'save' => 'User profile updated'
                ));
            }else{
                return Response::json(array(
                    'error_msg' => 'Please try again, something went wrong.'
                ));
            }
        }

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//

	}

}

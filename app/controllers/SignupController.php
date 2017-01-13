<?php


class SignupController extends \BaseController {

	/**
	 * Display the signup form.
	 *
	 * @return Response
	 */
	public function index(){
		//returns the signup page
        return View::make('signup.signup')->with('title', APP_PREFIXED_HOST.' | Signup Page')->with('permissions', $this->getPermit());;
    }

    /**
     * This function handles the signUp action
     *
     * @return Response
     */
    public function signUp(){
        $valid = Validator::make(Input::all(), User::$signup_rules);
        $permission = 'user';
        $user = EduAuth::manualSignUp($valid,$permission);
        if(!empty($user)){
            $data = EduAuth::createEmailData($user);
            $email = Notifications::notify('activate', $data);
            if($email == 'success'){
                Toastr::success('You\'ve being successfully signed up, an activation link has being sent to your mail.Please click the link to activate your account. Thank you!.', $title = 'Welcome');
                return Redirect::route('login_form');
            }else{
                $user->delete();
                Toastr::error('Please try signing up again later, we could not send a Signup Email to the email you provided', $title = 'Email Error');
                return Redirect::route('signup_form');
            }
        }else{
            Toastr::error($valid->errors()->first(), $title = 'Error(s)');
            return Redirect::route('signup_form')->withInput(Input::except('password', 'passwordconf'));
        }
    }



    public function guestSignup(){
        $valid = Validator::make(Input::all(), User::$signup_rules);
        $permission = 'guest';
        $user = EduAuth::manualSignUp($valid,$permission);
        if(!empty($user)){
            $data = EduAuth::createEmailData($user);
            $email = Notifications::notify('activate', $data);
            if($email == 'success'){
                Toastr::success('You\'ve being successfully signed up, an activation link has being sent to your mail.Please click the link to activate your account. Thank you!.', $title = 'Welcome');
                return Redirect::route('login_form');
            }else{
                $user->delete();
                Toastr::error('Please try signing up again later, we could not send a Signup Email to the email you provided', $title = 'Email Error');
                return Redirect::route('signup_form');
            }
        }else{
            Toastr::error($valid->errors()->first(), $title = 'Error(s)');
            return Redirect::route('signup_form')->withInput(Input::except('password', 'passwordconf'));
        }
    }

    public function verifyAccount($id, $conf_code){
       try{
           $user = Sentry::findUserById($id);
           if($user->attemptActivation($conf_code)){
               $user->activated_at =  date('Y-m-d H:i:s');
               $user->save();
               Toastr::success('Your account has being successfully activated. Please login in to your dashboard', $title = 'Congratulations');
           }else{
               Toastr::success('Ooops! something went wrong, please use the support link on the home page to send us an email', $title = 'Technical Problem');
               return Redirect::route('login_form');
           }
       }catch (Cartalyst\Sentry\Users\UserNotFoundException $e){
           Toastr::warning('This user does not exist in our system.', $title = 'User Error');
           return Redirect::route('login_form');
       }catch(Cartalyst\Sentry\Users\UserAlreadyActivatedException $e){
           Toastr::warning('This account is already activated', $title = 'Activated Account');
           return Redirect::route('login_form');
       }
    }

    /**
     * @return mixed
     */
    public function getPermit()
    {
        if(Sentry::check()){
            $userId = Sentry::getUser()->id;
            $user = Sentry::findUserByID($userId);
            $permissions = $user->getPermissions();
            return $permissions;
        }
        return null;

    }
}

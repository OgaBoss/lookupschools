<?php
class LoginController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('login.login')->with('title', APP_PREFIXED_HOST.' | Login Page')->with('permissions', $this->getPermit());
    }

    public function getPasswordReset(){
        //return the password reset form
        return View::make('pw_reset.pw_reset')->with('title', APP_PREFIXED_HOST .' | Password Reset Page');
    }

    public function getNewPassword($id,$reset_code){
        return View::make('pw_reset.new_password', array('title'=> APP_PREFIXED_HOST.' | New Password', 'id'=>$id, 'reset_code'=>$reset_code));
    }

    public function facebook(){
        $code = Input::get('code');
        $type = Input::get('type');
        if(strpos($type, ';') !== false){
            $new_type = explode(';', Input::get('type'));
            $type = $new_type[0];
            $page_back = $new_type[1];
            $css_class = $new_type[2];
            $datas = DB::table('pageback')->first();
            if(count($datas) > 0){
                DB::table('pageback')->delete();
            }
            DB::table('pageback')->insert([
                'url' => $page_back,
                'css' => $css_class
            ]);
        }
        if($type == 'user'){
            $fb = OAuth::consumer('Facebook', APP_PREFIXED_HOST.'/facebook?type=user');
        }elseif($type == 'guest'){
            $fb = OAuth::consumer('Facebook', APP_PREFIXED_HOST.'/facebook?type=guest');
        }elseif($type == 'login'){
            $fb = OAuth::consumer('Facebook', APP_PREFIXED_HOST.'/facebook?type=login');
        }
        if($type == 'user'){
            //After going to facebook
            //its comes back with a code
            //if the code is available
            if(!empty($code)){
                // This was a callback request from facebook, get the token
                $token = $fb->requestAccessToken( $code );
                $_SESSION['facebook_access_token'] = $token->getAccessToken();

                if(!empty($token)){
                    // Send a request with it
                    try{
                        $result = json_decode( $fb->request( '/me?fields=id,name,email,picture.width(320)' ), true );
                        $user = DB::table('users')->where('email', $result['email'])->first();
                        //check if $user exist
                        //if yes, this is a login, redirect to login page
                        //else, this is a signup, create user
                        if(count($user) > 0){
                            Toastr::warning('An account exist for this user, please login ', $title = 'Account Exist');
                            return Redirect::route('login_form');
                        }else{
                            $name = explode(' ', $result['name']);
                            $lastname = $name[0];
                            $firstname = $name[1];
                            Sentry::getUserProvider()->create(array(
                                'first_name'     =>  $firstname,
                                'last_name'      =>  $lastname,
                                'email'         =>  $result['email'],
                                'password'      => $result['email'],
                                'encrypt_password' => EduAuth::encrypt_decrypt('encrypt',$result['email']),
                                'activated'     =>  1,
                                'permissions'   => array(
                                    'user'      =>  1
                                ),
                                'last_login'    => date('Y-m-d H:i:s'),
                                'login_type'    => 'facebook',
                                'photo_url'     => $result['picture']['data']['url'],

                            ));
                            Sentry::authenticate(array('email' => $result['email'],'password'=> $result['email']));
                            Toastr::success('Your account as being successfully created. You have also being logged in!.', $title = 'Welcome');
                            if(!empty(Input::get('backPage'))){
                                return Redirect::route(Input::get('backPage'));
                            }
                            return Redirect::route('school_dashboard');
                        }
                    }catch (OAuth\Common\Http\Exception\TokenResponseException $e){
                        Toastr::error('Ooops! something went wrong, please use the support link on the home page to send us an email', $title = 'Technical Problem');
                        return Redirect::route('signup_form');
                    }
                }else{
                    Toastr::error('Ooops! something went wrong, please use the support link on the home page to send us an email', $title = 'Technical Problem');
                    return Redirect::route('signup_form');
                }
            }
            //On the first run
            //the code is not available
            //So it goes to facebook
            //to authenticate
            else{
                // get fb authorization
                $url = $fb->getAuthorizationUri();

                // return to facebook login url
                return Redirect::to( (string)$url );
            }
        }elseif($type == 'guest'){
            //After going to facebook
            //its comes back with a code
            //if the code is available
            if(!empty($code)){
                // This was a callback request from facebook, get the token
                $token = $fb->requestAccessToken( $code );

                if(!empty($token)){
                    // Send a request with it
                    try{
                        $result = json_decode( $fb->request( '/me?fields=id,name,email,picture.width(320)' ), true );
                        $user = DB::table('users')->where('email', $result['email'])->first();
                        //check if $user exist
                        //if yes, this is a login, redirect to login page
                        //else, this is a signup, create user
                        if(count($user) > 0){
                            Toastr::warning('An account exist for this user, please login ', $title = 'Account Exist');
                            return Redirect::route('login_form');
                        }else{
                            $name = explode(' ', $result['name']);
                            $lastname = $name[0];
                            $firstname = $name[1];
                            Sentry::getUserProvider()->create(array(
                                'first_name'     =>  $firstname,
                                'last_name'      =>  $lastname,
                                'email'         =>  $result['email'],
                                'password'      => $result['email'],
                                'encrypt_password' => EduAuth::encrypt_decrypt('encrypt',$result['email']),
                                'activated'     =>  1,
                                'permissions'   => array(
                                    'guest'      =>  1
                                ),
                                'last_login'    => date('Y-m-d H:i:s'),
                                'login_type'    => 'facebook',
                                'photo_url'     => $result['picture']['data']['url'],

                            ));
                            Sentry::authenticate(array('email' => $result['email'],'password'=> $result['email']));
                            Toastr::success('Your account as being successfully created. You have also being logged in!.', $title = 'Welcome');
                            return Redirect::route('guest_dashboard');
                        }
                    }catch (OAuth\Common\Http\Exception\TokenResponseException $e){
                        Toastr::error('Ooops! something went wrong, please use the support link on the home page to send us an email', $title = 'Technical Problem');
                        return Redirect::route('signup_form');
                    }
                }else{
                    Toastr::error('Ooopss! something went wrong, please use the support link on the home page to send us an email', $title = 'Technical Problem');
                    return Redirect::route('signup_form');
                }
            }
            //On the first run
            //the code is not available
            //So it goes to facebook
            //to authenticate
            else{
                // get fb authorization
                $url = $fb->getAuthorizationUri();

                // return to facebook login url
                return Redirect::to( (string)$url );
            }
        }elseif($type == 'login'){
            //After going to facebook
            //its comes back with a code
            //if the code is available
            if(!empty($code)){
                // This was a callback request from facebook, get the token
                $token = $fb->requestAccessToken( $code );
                $_SESSION['facebook_access_token'] = $token->getAccessToken();

                if(!empty($token)){
                    // Send a request with it
                    try{
                        $result = json_decode( $fb->request( "/me?fields=id,name,email,picture.width(320)&access_token={$_SESSION['facebook_access_token']}" ), true );
                        $user = DB::table('users')->where('email', $result['email'])->first();
                        //check if $user exist
                        //if yes, this is a login, so log user in
                        //else, this is a signup, so redirect to signup page
                        if(count($user) > 0){
                            $user = Sentry::findUserById($user->id);
                            $permit = $user->getPermissions();
                            try{
                                Sentry::login($user,false);
                                if(isset($permit['user']) && $permit['user'] == 1){
                                    $data = DB::table('pageback')->first();
                                    if(count($data) == 1){
                                        DB::table('pageback')->delete();
                                        Toastr::error('Schools are not allowed to follow schools', $title = 'Not Allowed');
                                        Toastr::success('You\'ve successfully logged in!', $title = 'Welcome');
                                        return Redirect::to($data->url)->with('css', $data->css);
                                    }
                                    Toastr::success('You\'ve successfully logged in!', $title = 'Welcome');
                                    return Redirect::route('school_dashboard');
                                }elseif(isset($permit['guest']) && $permit['guest'] == 1){
                                    $data = DB::table('pageback')->first();
                                    if(count($data) == 1){
                                        DB::table('pageback')->delete();
                                        Toastr::info('Please follow the schools you love', $title = 'Follow School!');
                                        Toastr::success('You\'ve successfully logged in!', $title = 'Welcome');
                                        return Redirect::to($data->url)->with('css', $data->css);
                                    }
                                    Toastr::success('You\'ve successfully logged in!', $title = 'Welcome');
                                    return Redirect::route('guest_dashboard');
                                }
                            }catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
                            {
                                Toastr::error( 'This account is not activated.', $title = 'Login Error' );
                                return Redirect::route( 'login_form' )->withInput( Input::except( 'password' ) );
                            }
                        }else{
                            Toastr::error('Please create an account before login', $title = 'Create Account');
                            return Redirect::route('signup_form');
                        }
                    }catch (OAuth\Common\Http\Exception\TokenResponseException $e){
                        Toastr::error('Ooops! something went wrong, please use the support link on the home page to send us an email', $title = 'Technical Problem');
                        return Redirect::route('login_form');
                    }
                }else{
                    Toastr::error('Ooopss! something went wrong, please use the support link on the home page to send us an email', $title = 'Technical Problem');
                    return Redirect::route('login_form');
                }
            }
            //On the first run
            //the code is not available
            //So it goes to facebook
            //to authenticate
            else{
                // get fb authorization
                $url = $fb->getAuthorizationUri();

                // return to facebook login url
                return Redirect::to( (string)$url );
            }
        }
    }

    public function google(){
        $code = Input::get('code');
        $type = Input::get('type');
        if(strpos($type, ';') !== false){
            $new_type = explode(';', Input::get('type'));
            $type = $new_type[0];
            $page_back = $new_type[1];
            $css_class = $new_type[2];
            $datas = DB::table('pageback')->first();
            if(count($datas) > 0){
                DB::table('pageback')->delete();
            }
            DB::table('pageback')->insert([
                'url' => $page_back,
                'css' => $css_class
            ]);
        }
        if($type == 'user'){
            $googleService = OAuth::consumer('Google', APP_PREFIXED_HOST.'/google?type=user');
        }elseif($type == 'guest'){
            $googleService = OAuth::consumer('Google', APP_PREFIXED_HOST.'/google?type=guest');
        }elseif($type == 'login'){
            $googleService = OAuth::consumer('Google', APP_PREFIXED_HOST.'/google?type=login');
        }

        if($type == 'user'){
            //After going to facebook
            //its comes back with a code
            //if the code is available
            if(!empty($code)){
                // This was a callback request from facebook, get the token
                $token = $googleService->requestAccessToken( $code );

                if(!empty($token)){
                    // Send a request with it
                    try{
                        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );
                        $user = DB::table('users')->where('email', $result['email'])->first();
                        //check if $user exist
                        //if yes, this is a login, redirect to login page
                        //else, this is a signup, create user
                        if(count($user) > 0){
                            Toastr::warning('Ann account exist for this user, please login ', $title = 'Account Exist');
                            return Redirect::route('login_form');
                        }else{
                            $name = explode(' ', $result['name']);
                            $lastname = $name[1];
                            $firstname = $name[0];
                            Sentry::getUserProvider()->create(array(
                                'first_name'     =>  $firstname,
                                'last_name'      =>  $lastname,
                                'email'         =>  $result['email'],
                                'password'      => $result['email'],
                                'encrypt_password' => EduAuth::encrypt_decrypt('encrypt',$result['email']),
                                'activated'     =>  1,
                                'permissions'   => array(
                                    'user'      =>  1
                                ),
                                'last_login'    => date('Y-m-d H:i:s'),
                                'login_type'    => 'google',
                                'photo_url'     => $result['picture'],

                            ));
                            Sentry::authenticate(array('email' => $result['email'],'password'=> $result['email']));
                            Toastr::success('Your account as being successfully created. You have also being logged in!.', $title = 'Welcome');
                            return Redirect::route('school_dashboard');
                        }
                    }catch (OAuth\Common\Http\Exception\TokenResponseException $e){
                        Toastr::error('Ooops! something went wrong, please use the support link on the home page to send us an email', $title = 'Technical Problem');
                        return Redirect::route('signup_form');
                    }
                }else{
                    Toastr::error('Ooops! something went wrong, please use the support link on the home page to send us an email', $title = 'Technical Problem');
                    return Redirect::route('signup_form');
                }
            }
            //On the first run
            //the code is not available
            //So it goes to facebook
            //to authenticate
            else{
                // get fb authorization
                $url = $googleService->getAuthorizationUri();

                // return to facebook login url
                return Redirect::to( (string)$url );
            }
        }elseif($type == 'guest'){
            //After going to facebook
            //its comes back with a code
            //if the code is available
            if(!empty($code)){
                // This was a callback request from facebook, get the token
                $token = $googleService->requestAccessToken( $code );

                if(!empty($token)){
                    // Send a request with it
                    try{
                        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );
                        $user = DB::table('users')->where('email', $result['email'])->first();
                        //check if $user exist
                        //if yes, this is a login, redirect to login page
                        //else, this is a signup, create user
                        if(count($user) > 0){
                            Toastr::warning('Ann account exist for this user, please login ', $title = 'Account Exist');
                            return Redirect::route('login_form');
                        }else{
                            $name = explode(' ', $result['name']);
                            $lastname = $name[1];
                            $firstname = $name[0];
                            Sentry::getUserProvider()->create(array(
                                'first_name'     =>  $firstname,
                                'last_name'      =>  $lastname,
                                'email'         =>  $result['email'],
                                'password'      => $result['email'],
                                'activated'     =>  1,
                                'encrypt_password' => EduAuth::encrypt_decrypt('encrypt',$result['email']),
                                'permissions'   => array(
                                    'guest'      =>  1
                                ),
                                'last_login'    => date('Y-m-d H:i:s'),
                                'login_type'    => 'google',
                                'photo_url'     => $result['picture'],

                            ));
                            Sentry::authenticate(array('email' => $result['email'],'password'=> $result['email']));
                            Toastr::success('Your account as being successfully created. You have also being logged in!.', $title = 'Welcome');
                            return Redirect::route('guest_dashboard');
                        }
                    }catch (OAuth\Common\Http\Exception\TokenResponseException $e){
                        Toastr::error('Ooops! something went wrong, please use the support link on the home page to send us an email', $title = 'Technical Problem');
                        return Redirect::route('signup_form');
                    }
                }else{
                    Toastr::error('Ooops! something went wrong, please use the support link on the home page to send us an email', $title = 'Technical Problem');
                    return Redirect::route('signup_form');
                }
            }
            //On the first run
            //the code is not available
            //So it goes to facebook
            //to authenticate
            else{
                // get fb authorization
                $url = $googleService->getAuthorizationUri();

                // return to facebook login url
                return Redirect::to( (string)$url );
            }
        }elseif($type == 'login'){
            //After going to facebook
            //its comes back with a code
            //if the code is available
            if(!empty($code)){
                // This was a callback request from facebook, get the token
                $token = $googleService->requestAccessToken( $code );

                if(!empty($token)){
                    // Send a request with it
                    try{
                        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );
                        $user = DB::table('users')->where('email', $result['email'])->first();
                        //check if $user exist
                        //if yes, this is a login, so log user in
                        //else, this is a signup, so redirect to signup page
                        if(count($user) > 0){
                            $user = Sentry::findUserById($user->id);
                            $permit = $user->getPermissions();
                            try{
                                Sentry::login($user,false);
                                if(isset($permit['user']) && $permit['user'] == 1){
                                    $data = DB::table('pageback')->first();
                                    if(count($data) == 1){
                                        DB::table('pageback')->delete();
                                        Toastr::error('Schools are not allowed to follow school', $title = 'Not Allowed');
                                        Toastr::success('You\'ve successfully logged in!', $title = 'Welcome');
                                        return Redirect::to($data->url)->with('css', $data->css);
                                    }
                                    Toastr::success('You\'ve successfully logged in!', $title = 'Welcome');
                                    return Redirect::route('school_dashboard');
                                }elseif(isset($permit['guest']) && $permit['guest'] == 1){
                                    $data = DB::table('pageback')->first();
                                    if(count($data) == 1){
                                        DB::table('pageback')->delete();
                                        Toastr::info('Please follow the schools you love', $title = 'Follow School!');
                                        Toastr::success('You\'ve successfully logged in!', $title = 'Welcome');
                                        return Redirect::to($data->url)->with('css', $data->css);
                                    }
                                    Toastr::success('You\'ve successfully logged in!', $title = 'Welcome');
                                    return Redirect::route('guest_dashboard');
                                }
                            }catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
                                Toastr::error('This account is not activated.', $title = 'Login Error');
                                return Redirect::route('login_form')->withInput(Input::except('password'));
                            }

                        }else{
                            Toastr::error('Please create an account before login', $title = 'Create Account');
                            return Redirect::route('signup_form');
                        }
                    }catch (OAuth\Common\Http\Exception\TokenResponseException $e){
                        Toastr::error('Ooops! something went wrong, please use the support link on the home page to send us an email', $title = 'Technical Problem');
                        return Redirect::route('login_form');
                    }
                }else{
                    Toastr::error('Ooopss! something went wrong, please use the support link on the home page to send us an email', $title = 'Technical Problem');
                    return Redirect::route('login_form');
                }
            }
            //On the first run
            //the code is not available
            //So it goes to facebook
            //to authenticate
            else{
                // get fb authorization
                $url = $googleService->getAuthorizationUri();

                // return to facebook login url
                return Redirect::to( (string)$url );
            }
        }
    }


    public function getFbLogout(){
        $fauth = new Hybrid_Auth(app_path().'/config/fb_auth.php');
        $fauth->logoutAllProviders();
        Toastr::info('Your have being signed out of your account', $title = 'Bye for now!');
        return Redirect::route('login_form');

    }

    public function getGgLogout(){
        $fauth = new Hybrid_Auth(app_path().'/config/google_auth.php');
        $fauth->logoutAllProviders();
        Toastr::info('Your have being signed out of your account', $title = 'Bye for now!');
        return Redirect::route('login_form');
    }

    /**
     * Authenticate Users
     *
     * @return Response
     */
    public function postLogin(){
        $valid = Validator::make(Input::all(), User::$login_rules);

        if($valid->fails()) {
            Toastr::error($valid->errors()->first(), $title = 'Error(s)');
            return Redirect::route('login_form')->withInput(Input::except('password'));
        }else{
            try{
                $credentials = array('email' => Input::get('email'), 'password' => Input::get('password'));
                $user = Sentry::authenticate($credentials, false);
                $permit = $user->getPermissions();
                $user->last_login = date('Y-m-d H:i:s');
                $user->login_type = 'manual';
                $user->save();
                if(isset($permit['user']) && $permit['user'] == 1){
                    Toastr::success('You\'ve successfully logged in!', $title = 'Welcome');
                    return Redirect::route('school_dashboard');
                }elseif(isset($permit['admin']) && $permit['admin'] == 1){
                    Toastr::success('You\'ve successfully logged in!', $title = 'Welcome');
                    return Redirect::route('admin_dashboard');
                }elseif(isset($permit['guest']) && $permit['guest'] == 1){
                    Toastr::success('You\'ve successfully logged in!', $title = 'Welcome');
                    return Redirect::route('guest_dashboard');
                }
            } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
                Toastr::error('Login field is required.', $title = 'Login Error');
                return Redirect::route('login_form')->withInput(Input::except('password'));
            } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
                Toastr::error('Password field is required.', $title = 'Login Error');
                return Redirect::route('login_form')->withInput(Input::except('password'));
            } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
                Toastr::error('Wrong password, try again.', $title = 'Login Error');
                return Redirect::route('login_form')->withInput(Input::except('password'));
            } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                Toastr::error('User was not found.', $title = 'Login Error');
                return Redirect::route('login_form')->withInput(Input::except('password'));
            } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
                Toastr::error('This account is not activated.', $title = 'Login Error');
                return Redirect::route('login_form')->withInput(Input::except('password'));
            }
        }
    }
    public function getLogout(){
        $permissions = $this->getPermit();
        if(isset($permissions['admin']) && $permissions['admin'] == 1){
            Sentry::logout();
            Toastr::info('Your have being signed out of your account', $title = 'Bye for now!');
            return Redirect::route('admin_login');
        }else{
            Sentry::logout();
            Toastr::info('Your have being signed out of your account', $title = 'Bye for now!');
            return Redirect::route('login_form');
        }

    }

    public function postPasswordReset(){
        try{
            $email = Input::get('email');
            $user = Sentry::findUserByLogin($email);
            $resetCode = $user->getResetPasswordCode();
            $data = array(
                'id'            => $user->id,
                'fullname'      => $user->first_name." ".$user->last_name,
                'email'         =>  Input::get('email'),
                'reset_code'     =>  $resetCode,
                'site_name'     =>  APP_PREFIXED_HOST,
            );
            //Send activate email via sendwithus
            Notifications::notify('pw_reset', $data);
            Toastr::info('A password reset link has being sent to the email address you provided. Thank you!.', $title = 'Email Sent');
            return Redirect::route('pwreset_form')->withInput()->with('success', '');

        }catch (Cartalyst\Sentry\Users\UserNotFoundException $e){
            Toastr::error('Account with this email does not exist', $title = 'Account Error');
            return Redirect::route('pwreset_form');

        }

    }

    public function postNewPassword(){
        $id = Input::get('id');
        $reset_code = Input::get('reset_code');
        $valid = Validator::make(Input::all(), User::$new_pw_rules);
        if($valid->fails()){
            Toastr::error($valid->errors()->first(), $title = 'Error(s)');
            return Redirect::route('new_password_form');
        }else{
            try{
                $user = Sentry::findUserById($id);

                if ($user->checkResetPasswordCode($reset_code)){
                    if ($user->attemptResetPassword($reset_code, Input::get('password'))){
                        Toastr::success('Password successfully changed, please login with the new password. Thank you!', $title = 'Password Reset Successful');
                        return Redirect::route('login_form');

                    }else{
                        Toastr::error('The password reset failed, please try again or contact our support. Thank you!', $title = 'Technical Problem');
                        return Redirect::route('pwreset_form');
                    }
                }else{
                    Toastr::error('The provided password reset code is invalid, please try again. Thank you!', $title = 'Wrong reset code');
                    return Redirect::route('pwreset_form');
                }
            }catch(Cartalyst\Sentry\Users\UserNotFoundException $e){
                Toastr::error('Account does not exist', $title = 'Account error');
                return Redirect::route('pwreset_form');

            }
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
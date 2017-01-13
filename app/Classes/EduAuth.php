<?php

/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 10/17/15
 * Time: 10:11 PM
 */
class EduAuth
{
    public static function manualSignUp($valid, $permission){
        $user = '';
        if($valid->passes()){
            //lets create a user
            $user = Sentry::getUserProvider()->create(array(
                'first_name'     =>  Input::get('firstname'),
                'last_name'      =>  Input::get('lastname'),
                'email'         =>  Input::get('email'),
                'password'      =>  Input::get('password'),
                'activated'     =>  1,
                'encrypt_password' => self::encrypt_decrypt('encrypt',Input::get('password')),
                'permissions'   => array(
                    $permission      =>  1
                )
            ));
            return $user;
        }else{
            return $user;
        }
    }

    public static function createNewUser($permission){
        $user = Sentry::createUser(array(
            'email' => Input::get('email'),
            'password' => Input::get('email'),
            'first_name' => Input::get('firstname'),
            'last_name' => Input::get('lastname'),
            'activated'     =>  1,
            'permissions'   => array(
                $permission      =>  1
            )
        ));

        return $user;
    }

    public static function createEmailData($user){
        $activationCode = $user->getActivationCode();
        //create email data and return data
        try{
            $data = array(
            'id'            => $user->id,
            'fullname'      =>  Input::get('firstname')." ".Input::get('lastname'),
            'email'         =>  Input::get('email'),
            'password'         =>  Input::get('email'),
            'conf_code'     =>  $activationCode,
            'site_name'     =>  APP_PREFIXED_HOST,
        );
        }catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            return Response::json(array(
                'error_msg' => 'Login field is required.'
            ));
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            return Response::json(array(
                'error_msg' => 'Password field is required.'
            ));
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            return Response::json(array(
                'error_msg' => 'User with this login already exists.'
            ));
        }

        return $data;
    }

    public static function socialAuth($path, $type,$auth=NULL){
        if($auth == 'auth'){
            try{
                Hybrid_Endpoint::process();
            }catch (Exception $e){
                return 'Hybrid Error';
            }
            return;
        }
        $oauth  =  new Hybrid_Auth($path);
        $provider = $oauth->authenticate($type);
        try{
            $profile = $provider->getUserProfile();
            return $profile;
        }catch (Exception $e){
            return 'error';
        }
    }

    public static function socialSaveNewUser($path,$type, $permission){
        $profile = self::socialAuth($path,$type);
        if(isset($profile) && $profile != 'error'){
            $email = $profile->email;
            $user = DB::table('users')->where('email', $email)->first();
            if(isset($user) && count($user) > 0){
                return 'error';
            }elseif(isset($user) && count($user) <= 0) {
                Sentry::getUserProvider()->create(array(
                    'first_name'     =>  $profile->firstName,
                    'last_name'      =>  $profile->lastName,
                    'email'         =>  $profile->email,
                    'password'      => $profile->email,
                    'activated'     =>  1,
                    'permissions'   => array(
                        $permission      =>  1
                    ),
                    'last_login'    => date('Y-m-d H:i:s'),
                    'login_type'    => $type,
                    'photo_url'     => $profile->photoURL,

                ));
                Sentry::authenticate(array('email' => $profile->email,'password'=> $profile->email));
                return 'success';
            }
        }
        else{
            return 'profile error';
        }

    }

    /**
     * simple method to encrypt or decrypt a plain text string
     * initialization vector(IV) has to be the same when encrypting and decrypting
     * PHP 5.4.9
     *
     * this is a beginners template for simple encryption decryption
     * before using this in production environments, please read about encryption
     *
     * @param string $action: can be 'encrypt' or 'decrypt'
     * @param string $string: string to encrypt or decrypt
     *
     * @return string
     */
    public static function encrypt_decrypt($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }
}
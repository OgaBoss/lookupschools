<?php
/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 10/21/15
 * Time: 9:33 PM
 */
class AdminController extends \BaseController
{
    public function index(){
        return View::make('site-admin.dashboard');
    }

    public function getLogin(){
        return View::make('login.admin-login')->with('title', APP_PREFIXED_HOST.' | Admin Login Page')->with('permissions', $this->getPermit());
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

    public function getUsers(){
        $users = Sentry::findAllUsersWithAccess(array('user'));
        $page = Input::get('page');
        if(isset($page)){
            $page = $page;
        }else{
            $page = 1;
        }
        $total = count($users);
        $number_per_page = 10;
        $number_of_pages = ceil($total / $number_per_page);
        $currentUsers = array_slice($users, $number_per_page * ($page-1) , $number_per_page);
        return View::make('site-admin.users.users-dashboard')
            ->with('users', $currentUsers)
            ->with('total', $total)
            ->with('page_number', $number_of_pages)
            ->with('per_page', $number_per_page)
            ->with('page', $page);
    }

    public function getGuest(){
        $users = Sentry::findAllUsers();
        $page = Input::get('page');
        if(isset($page)){
            $page = $page;
        }else{
            $page = 1;
        }
        $total = count($users);
        $number_per_page = 10;
        $number_of_pages = ceil($total / $number_per_page);
        $currentUsers = array_slice($users, $number_per_page * ($page-1) , $number_per_page);
        return View::make('site-admin.users.guest-dashboard')
            ->with('users', $currentUsers)
            ->with('total', $total)
            ->with('page_number', $number_of_pages)
            ->with('per_page', $number_per_page)
            ->with('page', $page);
    }

    public function getAdmin(){
        $users = Sentry::findAllUsers();
        $page = Input::get('page');
        if(isset($page)){
            $page = $page;
        }else{
            $page = 1;
        }
        $total = count($users);
        $number_per_page = 10;
        $number_of_pages = ceil($total / $number_per_page);
        $currentUsers = array_slice($users, $number_per_page * ($page-1) , $number_per_page);
        return View::make('site-admin.users.site-admin-dashboard')
            ->with('users', $currentUsers)
            ->with('total', $total)
            ->with('page_number', $number_of_pages)
            ->with('per_page', $number_per_page)
            ->with('page', $page);
    }

    public function suspendUser(){
        $uid = Input::get('uid');
        if(isset($uid)){
            $user = User::find($uid);
            if(count($user) == 1){
                if($user->activated == 1){
                    $user->activated = 0;
                    if($user->save()){
                        return Response::json( [
                            'save' => 'User Suspended'
                        ] );
                    }else{
                        return Response::json( [
                            'error_msg' => 'Something went wrong'
                        ] );
                    }
                }else{
                    return Response::json( [
                        'error_msg' => 'User is Already Suspended'
                    ] );
                }
            }else{
                return Response::json( [
                    'error_msg' => 'User Not Found'
                ] );
            }
        }
    }

    public function approveUser(){
        $uid = Input::get('uid');
        if(isset($uid)){
            $user = User::find($uid);
            if(count($user) == 1){
                if($user->activated == 0){
                    $user->activated = 1;
                    if($user->save()){
                        return Response::json( [
                            'save' => 'User Approved !'
                        ] );
                    }else{
                        return Response::json( [
                            'error_msg' => 'Something went wrong'
                        ] );
                    }
                }else{
                    return Response::json( [
                        'error_msg' => 'User is Already Approved'
                    ] );
                }
            }else{
                return Response::json( [
                    'error_msg' => 'User Not Found'
                ] );
            }
        }
    }

    public function searchUser(){
        return View::make('site-admin.users.search');
    }

    public function getUserByEmail(){
        $email = Input::get('email');
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        // Validate e-mail
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return Response::json( [
                'error_msg' => 'Please type in the field a valid email.'
            ] );
        }
        if(isset($email) && !empty($email)){
            $user = User::where('email', '=', $email)->first();
            if(count($user) > 0){
                $name = $user->first_name . " " . $user->last_name;
                $email = $email;
                $date = date("F jS, Y",strtotime($user->created_at));
                $school_count = count($user->schools);
                $status = $user->activated;

                return Response::json( [
                    'save' => [
                        'name' => $name,
                        'email' => $email,
                        'date' => $date,
                        'count' => $school_count,
                        'status' => $status,
                        'id' =>$user->id
                    ]
                ] );
            }else{
                return Response::json( [
                    'error_msg' => 'User does not exist in our system.'
                ] );
            }

        }else{
            return Response::json( [
                'error_msg' => 'Please fill in the box with a user email'
            ] );
        }
    }
}
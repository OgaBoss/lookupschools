<?php

//use Illuminate\Auth\UserTrait;
//use Illuminate\Auth\UserInterface;
//use Illuminate\Auth\Reminders\RemindableTrait;
//use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Cartalyst\Sentry\Users\Eloquent\User{
    protected $tables = 'users';
    public static $signup_rules = array(
        'firstname' => 'required|min:3',
        'lastname' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'passwordconf' => 'required|same:password'
    );

    public static $new_signup_rules = array(
        'email' => 'required|email|unique:users,email',
    );


    public static $login_rules = array(
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:6'
    );

    public static $pw_reset_rules = array(
        'email' => 'required|email|exists:users,email',
    );

    public static $new_pw_rules = array(
        'password' => 'required|min:6',
        'password_conf' => 'required|same:password'
    );

    public static function getUserByEmail($email){
        return User::where('email', '=', $email)->get();
    }

    public function schools(){
        return $this->belongsToMany('School')->withTimeStamps();
    }

    public function photos()
    {
        return $this->morphMany('Image', 'imageable');
    }


    public function messageSent(){
        return $this->hasMany('Message', 'sender');
    }

    public function messageReceive(){
        return $this->hasMany('Message', 'receiver');
    }

 }

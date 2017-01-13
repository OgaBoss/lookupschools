<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/



Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
/*
|--------------------------------------------------------------------------
| Custom Filters
|--------------------------------------------------------------------------
*/

Route::filter('user', function($route, $request){
    if(Sentry::check()){
        //user is logged in
    }else{
        Toastr::warning('You need to log in first',$title = 'Ooops!' );
        return Redirect::route('login_form');
    }
});

Route::filter('admin_user', function($route, $request){
	if(Sentry::check()){
		//user is logged in
	}else{
		Toastr::warning('You need to log in first',$title = 'Ooops!' );
		return Redirect::route('admin_login');
	}
});



Route::filter('is_guest',function($route,$request){

    if(!Sentry::check()) {
        //is a guest
    }else {
		$userId  = Sentry::getUser()->id;
		$user = Sentry::findUserByID($userId);
		$permissions = $user->getPermissions();
		if(isset($permissions['admin']) && $permissions['admin'] == 1){
			Toastr::warning('You are already logged in',$title = 'Ooops!' );
			return Redirect::route('admin_login');
		}else{
			Toastr::warning('You are already logged in',$title = 'Ooops!' );
			return Redirect::route('login_form');
		}

    }
});
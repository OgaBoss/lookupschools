<?php

class SearchController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /search
	 *
	 * @return Response
	 */
	public function index(){
        return View::make('search.search');
    }

    public function postSearch(){
        if(empty(Input::get('state'))){
            Toastr::error('Please select an Area, Local Government or School Name. Thank you.', $title = 'User Error');
            return Redirect::route('/');
        }
        $search_data =  Input::get('state');
        $page = Input::get('page') ? Input::get('page') : 1;
        if($search_data == ""){
            Toastr::error('Please fill the form with, school local government name, school area or school name', $title = 'Empty form');
            return Redirect::route('search_results');
        }else{
            $resultsByArea  = DB::table('schools')
                ->where(function($query) use($search_data){
                    $query->where('area', '=', $search_data)
                        ->orWhere('name', '=', $search_data)
                        ->orWhere('local_gov', '=', $search_data)
                        ->get();
                });
            if(Sentry::check()){
                $user = Sentry::getUser();
                $user = Sentry::findUserByID( $user->id );
                $permissions = $user->getPermissions();

                Toastr::success('This are the schools requested for.', $title = 'Search Result');
                return View::make('search.search')
                    ->with('data', $resultsByArea->paginate(20))
                    ->with('param',Input::get('state'))
                    ->with('page', $page)
                    ->with( 'permissions', $permissions)
                    ->with('total', $resultsByArea->count());
            }
            Toastr::success('This are the schools requested for.', $title = 'Search Result');
            return View::make('search.search')
                ->with('data', $resultsByArea->paginate(20))
                ->with('param',Input::get('state'))
                ->with('page', $page)
                ->with('total', $resultsByArea->count());
        }
    }

    public function getData(){
        $area = DB::table('schools')->lists('area');
        $name = DB::table('schools')->lists('name');
        return Response::json(array('area'=>$area, 'name'=>array_unique($name)));
    }

    public function getArea(){
        DB::setFetchMode(PDO::FETCH_ASSOC);
        if(Input::get('lg')){
            $area = DB::table('schools')
                ->select('area')
                ->where('local_gov',Input::get('lg'))
                ->get();
            return Response::json(array('area'=>$area));
        }
    }
	/**
	 * return view with the schools data
	 * GET /search/create
	 *
	 * @return view
	 */
	public function compare(){
        return Redirect::route('login_form');
    }

    public function advancedSearch(){
        $data = DB::table('schools');
        $page = Input::get('page') ? Input::get('page') : 1;
        if(Input::get('state')){
            $data = $data->where('state',Input::get('state'));
        }

        if(Input::get('lg')){
            $data = $data->where('local_gov',Input::get('lg'));
        }

        if(Input::get('area')){
            $data = $data->where('area',Input::get('area'));
        }

        if(Input::get('school_type')){
            $data = $data->where('school_type',Input::get('school_type'));
        }

        Toastr::success('This are the schools requested for.', $title = 'Search Result');
        return View::make('search.search')
            ->with('data', $data->paginate(20))
            ->with('state',Input::get('state'))
            ->with('lg',Input::get('lg'))
            ->with('area',Input::get('area'))
            ->with('school_type',Input::get('school_type'))
            ->with('page', $page)
            ->with('total', $data->count());
    }

    public function searchByFees(){
        $page = Input::get('page') ? Input::get('page') : 1;

        $range = Input::get('range_2');
        $range = explode(';', $range);
        $min = $range[0];
        $max = $range[1];

        $ids = DB::table('structures')
            ->whereBetween('max',[$min, $max])
            ->Where('min', '>=', $min)
            ->lists('school_id');
        $data = [];
        if(count($ids) > 0){
            foreach( $ids as $id){
                $data[] = DB::table('schools')
                    ->where('id', '=', $id)
                    ->get();
            }
        }

        Toastr::success('This are the schools requested for.', $title = 'Search Result');
        return View::make('search.search')
            ->with('data', $data->paginate(20))
            ->with('school_type',Input::get('school_type'))
            ->with('page', $page)
            ->with('total', $data->count());

    }
}

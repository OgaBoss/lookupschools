<?php

class DataController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /data
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$data = DB::table('sport')->get();
		$page = Input::get('page');
		if(isset($page)){
			$page = $page;
		}else{
			$page = 1;
		}
		$total = count($data);
		$number_per_page = 5;
		$count = ($page * $number_per_page) - 4;
		$number_of_pages = ceil($total / $number_per_page);
		$currentData = array_slice($data, $number_per_page * ($page-1) , $number_per_page);
		return View::make('site-admin.data.sport')
			->with('data', $currentData)
			->with('total', $total)
			->with('page_number', $number_of_pages)
			->with('per_page', $number_per_page)
			->with('page', $page)
			->with('count', $count)
			->with('type', 'sport');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /data/create
	 *
	 * @return Response
	 */
	public function sport()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /data
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /data/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$data = DB::table('sport')->get();
		$page = Input::get('page');
		if(isset($page)){
			$page = $page;
		}else{
			$page = 1;
		}
		$total = count($data);
		$number_per_page = 5;
		$count = ($page * $number_per_page) - 4;
		$number_of_pages = ceil($total / $number_per_page);
		$currentData = array_slice($data, $number_per_page * ($page-1) , $number_per_page);
		return View::make('site-admin.data.'.$id)
			->with('data', $currentData)
			->with('total', $total)
			->with('page_number', $number_of_pages)
			->with('per_page', $number_per_page)
			->with('page', $page)
			->with('count', $count)
			->with('type', $id);


	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /data/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		//
		dd(Input::all());

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /data/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /data/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
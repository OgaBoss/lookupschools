<?php

class EventController extends \BaseController {

	/**
	 * Display the specified resource.
	 * GET /event/{id}
	 *
	 * @param  int $slug
	 * @return Response
	 */
	public function show( $slug )
	{
		//
		$school = School::findBySlug( $slug );

		return View::make( 'school-admin.events' )->with( 'school', $school );

	}

	public function allEvents()
	{
		$sid = $_POST[ 'sid' ];
		$school = School::find( $sid );
		$schoolEvents = [];
		$data = $school->schoolEvent;
		foreach ( $data as $e )
		{
			$schoolEvents[] = [
				'title' => $e[ 'title' ],
				'start' => $e[ 'startdate' ],
				'end'   => $e[ 'enddate' ],
				'id'    => $e[ 'event_id' ],
				'color' => $e[ 'color' ]
			];
		}

		return Response::json( [
			'data' => $schoolEvents
		] );
//		echo json_encode($schoolEvents);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /event/{id}/edit
	 *
	 * @return Response
	 */
	public function editEvents()
	{
		//
		if ( !empty($_POST[ 'uid' ]) && !empty($_POST[ 'title' ]) )
		{
			$events = new SchoolEvent;
			$events = $events->where( 'event_id', '=', $_POST[ 'uid' ] )->first();

			if ( count( $events ) == 1 )
			{
				$events->title = $_POST[ 'title' ];
				if ( $events->save() )
				{
					return Response::json( [
						'save' => 'Events Title changed'
					] );
				} else
				{
					return Response::json( [
						'error_msg' => 'Something went wrong'
					] );
				}
			}
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /event/{id}
	 *
	 * @return Response
	 */
	public function saveEvents()
	{
		//
		if ( isset($_POST[ 'sid' ]) && !empty($_POST[ 'sid' ]) && isset($_POST[ 'title' ]) && !empty($_POST[ 'title' ]) && isset($_POST[ 'start' ]) && !empty($_POST[ 'start' ]) && !empty($_POST[ 'sid' ]) && isset($_POST[ 'end' ]) && !empty($_POST[ 'end' ]) && isset($_POST[ 'event_id' ]) && !empty($_POST[ 'event_id' ]) && isset($_POST[ 'color' ]) && !empty($_POST[ 'color' ]) )
		{
			$events = new SchoolEvent;
			$events = $events->where( 'event_id', '=', $_POST[ 'event_id' ] )->get();

			if ( count( $events ) < 1 )
			{
				if ( $_POST[ 'end' ] == 'null' || $_POST[ 'end' ] == "" )
				{
					$date = new DateTime( $_POST[ 'start' ] );
					$date->add( new DateInterval( 'PT1H' ) );
					$end = str_replace( ' ', 'T', $date->format( "Y-m-d H:i:s" ) );
				} else
				{
					$end = $_POST[ 'end' ];
				}

				$sid = $_POST[ 'sid' ];
				$school = School::find( $sid );
				$events = new SchoolEvent( [
					'title'     => $_POST[ 'title' ],
					'startdate' => $_POST[ 'start' ],
					'enddate'   => $end,
					'event_id'  => $_POST[ 'event_id' ],
					'color'     => $_POST[ 'color' ]
				] );
				$data = $school->schoolEvent()->save( $events );
				if ( $school->schoolEvent()->save( $events ) )
				{
					return Response::json( [
						'save' => 'Events Created and Saved'
					] );
				} else
				{
					return Response::json( [
						'error_msg' => 'Something went wrong'
					] );
				}
			} else
			{
				//change uid
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /event/{id}
	 *
	 * @return Response
	 */
	public function deleteEvents()
	{
		//
		if ( !empty($_POST[ 'uid' ]) )
		{
			$events = new SchoolEvent;
			$events = $events->where( 'event_id', '=', $_POST[ 'uid' ] )->first();

			if ( count( $events ) == 1 )
			{
				if ( $events->delete() )
				{
					return Response::json( [
						'save' => 'Events Deleted'
					] );
				} else
				{
					return Response::json( [
						'error_msg' => 'Something went wrong'
					] );
				}
			}
		}
	}
}
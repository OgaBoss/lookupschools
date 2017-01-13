<?php

    class HomeController extends BaseController {

        /*
        |--------------------------------------------------------------------------
        | Default Home Controller
        |--------------------------------------------------------------------------
        |
        | You may wish to use controllers instead of, or in addition to, Closure
        | based routes. That's great! Here is an example controller method to
        | get you started. To route to this controller, just add the route:
        |
        |	Route::get('/', 'HomeController@showWelcome');
        |,
        */

        public function showWelcome()
        {
            //get
            $ads = AdvertSchool::where('type', '=', 'image')->lists('school_id');
            $ad_video = AdvertSchool::where('type', '=', 'video')->get();
            $schools_adds = [];
            $v_list = [];
            foreach($ads as $ad){
                $schools_adds[] = School::find($ad);
            }
            foreach($ad_video as $vid){
                $v = $this->getV($vid['video_url']);
                $img = 'https://i.ytimg.com/vi/'.$v.'/mqdefault.jpg';
                $v_school = School::find($vid['school_id']);
                $v_list[] = [$v,$img,$v_school];
            }

            $query = new WP_Query(array(
                'post_type' => 'service'
            ));
            $services = $query->get_posts();
            if ( Sentry::check() )
            {
                $userId = Sentry::getUser()->id;
                $user = Sentry::findUserByID( $userId );
                $permissions = $user->getPermissions();

                //Toastr::warning('If you have any Ad Block Extension on you browser, please put them off, Thank you', $title = 'Ad Blocker');
                return View::make( 'home' )->with( 'permissions', $permissions )
                    ->with('services', $services)
                    ->with('schools_adds', $schools_adds)
                    ->with('v_list', $v_list);
            }

            //Toastr::warning('If you have any Ad Block Extension on you browser, please put them off, Thank you', $title = 'Ad Blocker');
            return View::make( 'home' )
                ->with('services', $services)
                ->with('schools_adds', $schools_adds)
                ->with('v_list', $v_list);
        }

        public function homePageSendEmail()
        {
            if ( Session::token() !== Input::get( '_token' ) && Input::get( 'id' ) == '' )
            {
                return Response::json( [
                    'error_msg' => 'Unauthorized attempt to create setting'
                ] );
            }

            if ( Input::get( 'name' ) != '' &&
                Input::get( 'email' ) != '' &&
                Input::get( 'subject' ) != '' &&
                Input::get( 'message' ) != ''
            )
            {
                $data = [
                    'name'    => Input::get( 'name' ),
                    'email'   => Input::get( 'email' ),
                    'top'     => Input::get( 'subject' ),
                    'comment' => Input::get( 'message' )
                ];
                $mail = Mail::send( 'emails.contact-email', $data, function ( $message ) use ( $data )
                {
                    $message->from( $data[ 'email' ], $data[ 'name' ] );
                    $message->to( 'goshensoftinc@gmail.com', 'Site Admin' )->subject( $data[ 'top' ] );
                } );
                if ( count( Mail::failures() ) > 0 )
                {
                    return Response::json( [
                        'error_msg' => 'Message not sent, please try again later'
                    ] );
                } else
                {
                    return Response::json( [
                        'save' => 'Message successfully sent, thank you.'
                    ] );
                }
            } else
            {
                return Response::json( [
                    'error_msg' => 'Please make sure all the fields are filled'
                ] );
            }
        }

        public function adverts(){
            //Get users IP Address
            $ip = new UsersIp;
            $today = '';
            $ip = $ip
                ->where('ip_add','=', $this->get_client_ip_server())
                ->whereDay('created_at', '=', date('d'))
                ->whereMonth('created_at', '=', date('m'))
                ->whereYear('created_at', '=', date('Y'))
                ->get();

            if(!count($ip) > 0){
                $new_ip =  new UsersIp(array(
                    'ip_add' => $this->get_client_ip_server()
                ));
                $new_ip->save();
                return Response::json( [
                    'save' => true
                ] );
                //Get all modal adds
                //$ads = AdvertSchool::where('type', '=', 'modal')->toArray();

            }else{
                return Response::json( [
                    'error_msg' => false
                ] );
            }
        }



        protected function get_client_ip_server() {
            $ipaddress = '';
            if (isset($_SERVER[ 'HTTP_CLIENT_IP' ]))
            {
                $ipaddress = $_SERVER[ 'HTTP_CLIENT_IP' ];
            } elseif ( isset($_SERVER[ 'HTTP_X_FORWARDED_FOR' ]) )
            {
                $ipaddress = $_SERVER[ 'HTTP_X_FORWARDED_FOR' ];
            } elseif ( isset($_SERVER[ 'HTTP_X_FORWARDED' ]) )
            {
                $ipaddress = $_SERVER[ 'HTTP_X_FORWARDED' ];
            } elseif ( isset($_SERVER[ 'HTTP_FORWARDED_FOR' ]) )
            {
                $ipaddress = $_SERVER[ 'HTTP_FORWARDED_FOR' ];
            } elseif ( isset($_SERVER[ 'HTTP_FORWARDED' ]) )
            {
                $ipaddress = $_SERVER[ 'HTTP_FORWARDED' ];
            } elseif ( isset($_SERVER[ 'REMOTE_ADDR' ]) )
            {
                $ipaddress = $_SERVER[ 'REMOTE_ADDR' ];
            } else
            {
                $ipaddress = 'UNKNOWN';
            }

            return $ipaddress;
        }

        protected function getV($url){
            $pattern  = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';
            $url = $url;

            if (preg_match($pattern, $url, $matches)) {
                return end($matches);
            }
        }
    }

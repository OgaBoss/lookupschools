<?php


    class SchoolController extends \BaseController {

        /**
         * Display a listing of the resource.
         *
         * @return Response
         */

        public function getSchool ()
        {
            $user = Sentry::getUser ();
            $id = $user->id;
            $new = User::find ( $id );
            $msg = $new->messageReceive;
            $schools = $new->schools;

            return View::make ( 'school-admin.list-schools' )
                ->with ( 'schools', $schools )
                ->with ( 'messages', $msg);
        }

        public function getBasicInfo ( $slug )
        {
            $school = School::findBySlug ( $slug );
            $imageUrl = $school->photos;

            return View::make ( 'school-admin.dashboard' )->with ( 'school', $school )->with ( 'imageUrl', $imageUrl );
        }


        /**
         * Check if the json data from Google Geo is valid
         */

        public function check_status ( $jsondata )
        {
            if ( $jsondata[ "status" ] == "OK" )
            {
                return true;
            }

            return false;
        }

        /**
         *Given an address, return the longitude and latitude using The Google Geocoding API V3
         *
         */
        public function Get_LatLng_From_Google_Maps ( $address )
        {
            $address = urlencode ( $address );

            $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";

            // Make the HTTP request
            $data = @file_get_contents ( $url );
            // Parse the json response
            $jsondata = json_decode ( $data, true );

            // If the json data is invalid, return empty array
            if ( !$this->check_status ( $jsondata ) ) return [];

            $LatLng = [
                'lat' => $jsondata[ "results" ][ 0 ][ "geometry" ][ "location" ][ "lat" ],
                'lng' => $jsondata[ "results" ][ 0 ][ "geometry" ][ "location" ][ "lng" ],
            ];

            return $LatLng;
        }

        /**
         * @return mixed
         */
        public function postBasicInfo ()
        {
            if ( Session::token () !== Input::get ( '_token' ) && Input::get ( 'id' ) == '' )
            {
                return Response::json ( [
                    'error_msg' => 'Unauthorized attempt to create setting'
                ] );
            }

            if ( Input::get ( 'name' ) == '' || Input::get ( 'state' ) == '' || Input::get ( 'lga' ) == '' || Input::get ( 'address' ) == '' || Input::get ( 'area' ) == '' || Input::get ( 'id' ) == '' )
            {
                return Response::json ( [
                    'error_msg' => 'Please fill in all the form fields'
                ] );
            }

            if ( Input::get ( 'name' ) != '' && Input::get ( 'state' ) != '' && Input::get ( 'lga' ) != '' && Input::get ( 'address' ) != '' && Input::get ( 'area' ))
            {
                $school = School::find ( Input::get ( 'id' ) );
                $school->name = Input::get ( 'name' );
                $school->local_gov = Input ::get ( 'lga' );
                $school->state = Input::get ( 'state' );
                $school->address = Input::get ( 'address' );
                $school->facebook_page = Input::get ( 'fbpage' );
                $school->area = Input::get ( 'area' );
                $full_address = Input::get ( 'address' ) . ", " . Input::get ( 'area' ) . ", " . Input::get ( 'lga' ) . ", " . Input::get ( 'state' );
                $school->full_address = $full_address;
                $response = $this->Get_LatLng_From_Google_Maps ( $full_address );
                if ( !empty($response) )
                {
                    $school->lat = $response[ 'lat' ];
                    $school->lng = $response[ 'lng' ];
                }


                if ( $school->save () && !isset($response[ 'lat' ]) )
                {
                    return Response::json ( [
                        'map' => 'Information successfully updated, but the address provided cannot be located on the map.!',
                    ] );
                } elseif ( $school->save () && isset($response[ 'lat' ]) )
                {
                    return Response::json ( [
                        'save' => 'Information successfully Updated'
                    ] );
                } else
                {
                    return Response::json ( [
                        'error_msg' => 'Ooops! something went wrong'
                    ] );
                }
            }

        }

        public function store ()
        {
            if ( Session::token () !== Input::get ( '_token' ) && Input::get ( 'id' ) == '' )
            {
                return Response::json ( [
                    'error_msg' => 'Unauthorized attempt to create setting'
                ] );
            }

            if ( Input::get ( 'name' ) == '' ||
                Input::get ( 'state' ) == '' ||
                Input::get ( 'lga' ) == '' ||
                Input::get ( 'address' ) == '' ||
                Input::get ( 'area' ) == '' ||
                Input::get ( 'school_type' ) == ''
            )
            {
                return Response::json ( [
                    'error_msg' => 'Please make sure the following fields are filled: Name, State, LGA, Address, Area, School Type'
                ] );
            }

            if ( (Input::get ( 'name' ) != '' &&
                    Input::get ( 'state' ) != '' &&
                    Input::get ( 'lga' ) != '' &&
                    Input::get ( 'address' ) != '' &&
                    Input::get ( 'area' ) &&
                    Input::get ( 'school_type' ) != ''
                ) || Input::get ( 'sname' ) != '' || Input::get ( 'lat' ) != '' || Input::get ( 'lng' ) != ''
            )
            {
                $school = School::find ( Input::get ( 'id' ) );
                $school->name = Input::get ( 'name' );
                $school->short_name = Input::get ( 'sname' );
                $school->local_gov = Input::get ( 'lga' );
                $school->state = Input::get ( 'state' );
                $school->address = Input::get ( 'address' );
                $school->area = Input::get ( 'area' );
                $school->facebook_page = Input::get ( 'fbpage' );
                $school->school_type = Input::get ( 'school_type' );
                $full_address = Input::get ( 'address' ) . ", " . Input::get ( 'area' ) . ", " . Input::get ( 'lga' ) . ", " . Input::get ( 'state' );
                $school->full_address = $full_address;
                if ( Input::get ( 'lat' ) == '' && Input::get ( 'lng' ) == '' )
                {
                    $response = $this->Get_LatLng_From_Google_Maps ( $full_address );
                    if ( !empty($response) )
                    {
                        $school->lat = $response[ 'lat' ];
                        $school->lng = $response[ 'lng' ];
                    }
                } else
                {
                    $school->lat = Input::get ( 'lat' );
                    $school->lng = Input::get ( 'lng' );
                }

                if ( $school->save () && !isset($response[ 'lat' ]) && (Input::get ( 'lat' ) == '' || Input::get ( 'lng' ) == '') )
                {
                    return Response::json ( [
                        'map' => 'Information successfully updated, but the address provided cannot be located on the map.!',
                    ] );
                } elseif ( $school->save () && isset($response[ 'lat' ]) )
                {
                    return Response::json ( [
                        'save' => 'Information successfully Updated'
                    ] );
                } elseif ( $school->save () && Input::get ( 'lat' ) != '' )
                {
                    return Response::json ( [
                        'save' => 'Information successfully Updated'
                    ] );
                } else
                {
                    return Response::json ( [
                        'error_msg' => 'Ooops! something went wrong'
                    ] );
                }
            }
        }


        public function showSchool ()
        {
            $user = Sentry::getUser ();
            $id = $user->id;
            $new = User::find ( $id );
            $schools = $new->schools;

            return View::make ( 'school-admin.add' )->with ( 'schools', $schools );
        }

        public function addSchool ()
        {
            $user = Sentry::getUser ();
            if ( Input::get ( 'name' ) == '' || Input::get ( 'state' ) == '' || Input::get ( 'lga' ) == '' || Input::get ( 'address' ) == '' || Input::get ( 'area' ) == '' )
            {
                Toastr::error ( 'Please make sure all form fields are filled', $title = 'Form Error' );

                return Redirect::route ( 'show_school_form' );
            }

            if ( Input::get ( 'name' ) != '' && Input::get ( 'state' ) != '' && Input::get ( 'lga' ) != '' && Input::get ( 'address' ) != '' && Input::get ( 'area' ) && Input::get ( 'school_type' ) )
            {
                $user = Sentry::getUser ();
                $school = new School;
                $school->user_id = $user->id;
                $school->name = Input::get ( 'name' );
                $school->local_gov = Input::get ( 'lga' );
                $school->state = Input::get ( 'state' );
                $school->address = Input::get ( 'address' );
                $school->area = Input::get ( 'area' );
                $school->school_type = Input::get ( 'school_type' );
                //$school->level = 'owner';
                $full_address = Input::get ( 'address' ) . ", " . Input::get ( 'area' ) . ", " . Input::get ( 'lga' ) . ", " . Input::get ( 'state' );
                $school->full_address = $full_address;
                $response = $this->Get_LatLng_From_Google_Maps ( $full_address );
                if ( !empty($response) )
                {
                    $school->lat = $response[ 'lat' ];
                    $school->lng = $response[ 'lng' ];
                }
                $savedSchool = $user->schools ()->save ( $school );
                //dd();

                if ( !empty($savedSchool) && !isset($response[ 'lat' ]) )
                {
                    $school_id = $savedSchool->id;
                    //$user->schools()->attach($school_id);
                    Toastr::warning ( 'School Created, but the address provided cannot be located on the map.!', $title = 'Congratulations' );

                    return Redirect::route ( 'school_dashboard' );
                } elseif ( !empty($savedSchool) && isset($response[ 'lat' ]) )
                {
                    $school_id = $savedSchool->id;
                    //$user->schools()->attach($school_id);
                    Toastr::success ( 'New School created', $title = 'Congratulations' );

                    return Redirect::route ( 'school_dashboard' );
                } else
                {
                    Toastr::error ( 'Something went wrong, please try again', $title = 'Technical Error' );

                    return Redirect::route ( 'school_dashboard' );
                }
            }
        }

        public function ajaxGetSchool ()
        {
            if ( isset($_GET[ 'id' ]) )
            {
                $school = School::find ( $_GET[ 'id' ] );

                return Response::json ( [
                    'data' => $school
                ] );
            }
        }

        public function getAdmin ()
        {
            $user = Sentry::getUser ();
            $id = $user->id;
            $new = User::find ( $id );
            $schools = $new->schools;
            $password = EduAuth::encrypt_decrypt ( 'decrypt', $user->encrypt_password );

            return View::make ( 'school-admin.admin-edit' )->with ( 'schools', $schools )->with ( 'password', $password );
        }

        public function uploadLogo ()
        {
            $school = School::find ( Input::get ( 'id' ) );
            $schoolName = $school->slug;
            if ( isset($_FILES[ 'upload_file' ]) )
            {
                $photos = $school->photos;
                if ( count ( $photos ) > 0 )
                {
                    return Response::json ( [
                        'error_msg' => "You already have a Logo uploaded"
                    ] );
                } else
                {
                    if ( $_FILES[ 'upload_file' ][ 'error' ] )
                    {
                        return Response::json ( [
                            'error_msg' => "Something went wrong, please try again later or use another image"
                        ] );
                    }
                    $name = $_FILES[ 'upload_file' ][ 'name' ];
                    $size = $_FILES[ 'upload_file' ][ 'size' ];
                    $file_tmp = $_FILES[ 'upload_file' ][ 'tmp_name' ];
                    $file_ext = explode ( '.', $name );
                    $file_ext = end ( $file_ext );
                    $file_ext = strtolower ( $file_ext );
                    $extensions = ["jpeg", "jpg", "png"];

                    if ( in_array ( $file_ext, $extensions ) === false )
                    {
                        return Response::json ( [
                            'error_msg' => "Please Upload an image that are one of the following jpeg, png, jpg"
                        ] );
                    }

                    if ( $size > 500000 )
                    {
                        return Response::json ( [
                            'error_msg' => "Please Upload an image that is 500KB or less"
                        ] );
                    }

                    $uploader = Cloudy::getUploader ();
                    $results = $uploader->upload ( $file_tmp, $options = [
                        'public_id' => $schoolName,
                        'folder'    => 'Logo'
                    ] );
                    $image = new Image( [
                        'publicID'  => $results[ 'public_id' ],
                        'openURL'   => $results[ 'url' ],
                        'secureURL' => $results[ 'secure_url' ]
                    ] );
                    $school->url_slug = $results[ 'url' ];

                    if ( $school->photos ()->save ( $image ) && $school->save () )
                    {
                        return Response::json ( [
                            'save' => $results[ 'url' ]
                        ] );
                    } else
                    {
                        return Response::json ( [
                            'error_msg' => 'Something went wrong !'
                        ] );
                    }
                }
            } else
            {
                return Response::json ( [
                    'error_msg' => "Something went wrong, please try again later or use another image"
                ] );
            }
        }

        public function userImageUpload ()
        {
            $user = Sentry::getUser ();
            $url = $user->photo_url;
            if ( $url == "" )
            {
                if ( isset($_FILES[ 'upload_file' ]) )
                {
                    if ( $_FILES[ 'upload_file' ][ 'error' ] )
                    {
                        return Response::json ( [
                            'error_msg' => "Something went wrong, please try again later or use another image"
                        ] );
                    }

                    //If all is well
                    $name = $_FILES[ 'upload_file' ][ 'name' ];
                    $size = $_FILES[ 'upload_file' ][ 'size' ];
                    $file_tmp = $_FILES[ 'upload_file' ][ 'tmp_name' ];
                    $file_ext = explode ( '.', $name );
                    $file_ext = end ( $file_ext );
                    $file_ext = strtolower ( $file_ext );
                    $extensions = ["jpeg", "jpg", "png"];

                    if ( in_array ( $file_ext, $extensions ) === false )
                    {
                        return Response::json ( [
                            'error_msg' => "Please Upload an image that are one of the following jpeg, png, jpg"
                        ] );
                    }

                    if ( $size > 500000 )
                    {
                        return Response::json ( [
                            'error_msg' => "Please Upload an image that is 500KB or less"
                        ] );
                    }

                    $uploader = Cloudy::getUploader ();
                    try
                    {
                        $results = $uploader->upload ( $file_tmp, $options = [
                            'public_id' => $user->email,
                            'folder'    => 'user'
                        ] );
                    } catch ( Exception $msg )
                    {
                        return Response::json ( [
                            'error_msg' => 'Something went wrong with the server !'
                        ] );
                    }

                    $user->photo_url = $results[ 'url' ];
                    if ( $user->save () )
                    {
                        return Response::json ( [
                            'save' => $results[ 'url' ]
                        ] );
                    } else
                    {
                        return Response::json ( [
                            'error_msg' => 'Something went wrong !'
                        ] );
                    }
                }
            } else
            {
                return Response::json ( [
                    'error_msg' => "You already have a Profile Image uploaded"
                ] );
            }
        }

        public function updateUploadLogo ()
        {
            $school = School::find ( Input::get ( 'id' ) );
            $schoolName = $school->slug;
            if ( isset($_FILES[ 'upload_file' ]) )
            {
                $photos = $school->photos;
                if ( count ( $photos ) > 0 )
                {
                    if ( $_FILES[ 'upload_file' ][ 'error' ] )
                    {
                        return Response::json ( [
                            'error_msg' => "Something went wrong, please try again later or use another image"
                        ] );
                    }
                    $name = $_FILES[ 'upload_file' ][ 'name' ];
                    $size = $_FILES[ 'upload_file' ][ 'size' ];
                    $file_tmp = $_FILES[ 'upload_file' ][ 'tmp_name' ];
                    $file_ext = explode ( '.', $name );
                    $file_ext = end ( $file_ext );
                    $file_ext = strtolower ( $file_ext );
                    $extensions = ["jpeg", "jpg", "png"];

                    if ( in_array ( $file_ext, $extensions ) === false )
                    {
                        return Response::json ( [
                            'error_msg' => "Please Upload an image that are one of the following jpeg, png, jpg"
                        ] );
                    }

                    if ( $size > 500000 )
                    {
                        return Response::json ( [
                            'error_msg' => "Please Upload an image that is 500KB or less"
                        ] );
                    }

                    $uploader = Cloudy::getUploader ();
                    $results = $uploader->upload ( $file_tmp, $options = [
                        'public_id' => $schoolName,
                        'folder'    => 'Logo'
                    ] );
                    $image = new Image;
                    $image = $image->where ( 'imageable_id', '=', Input::get ( "id" ) )->first ();
                    $image->publicID = $results[ 'public_id' ];
                    $image->openURL = $results[ 'url' ];
                    $image->secureURL = $results[ 'secure_url' ];
                    $school->url_slug = $results[ 'url' ];

                    if ( $school->photos ()->save ( $image ) && $school->save () )
                    {
                        return Response::json ( [
                            'save' => $results[ 'url' ]
                        ] );
                    } else
                    {
                        return Response::json ( [
                            'error_msg' => 'Something went wrong !'
                        ] );
                    }
                } else
                {
                    return Response::json ( [
                        'error_msg' => "Please upload an image ."
                    ] );
                }
            } else
            {
                return Response::json ( [
                    'error_msg' => "Something went wrong, please try again later or use another image"
                ] );
            }
        }

        public function updateUserImage(){
            $user = Sentry::getUser ();
            $url = $user->photo_url;
            if ( ! empty($url) )
            {
                if ( isset($_FILES[ 'upload_file' ]) )
                {
                    if ( $_FILES[ 'upload_file' ][ 'error' ] )
                    {
                        return Response::json ( [
                            'error_msg' => "Something went wrong, please try again later or use another image"
                        ] );
                    }

                    //If all is well
                    $name = $_FILES[ 'upload_file' ][ 'name' ];
                    $size = $_FILES[ 'upload_file' ][ 'size' ];
                    $file_tmp = $_FILES[ 'upload_file' ][ 'tmp_name' ];
                    $file_ext = explode ( '.', $name );
                    $file_ext = end ( $file_ext );
                    $file_ext = strtolower ( $file_ext );
                    $extensions = ["jpeg", "jpg", "png"];

                    if ( in_array ( $file_ext, $extensions ) === false )
                    {
                        return Response::json ( [
                            'error_msg' => "Please Upload an image that are one of the following jpeg, png, jpg"
                        ] );
                    }

                    if ( $size > 500000 )
                    {
                        return Response::json ( [
                            'error_msg' => "Please Upload an image that is 500KB or less"
                        ] );
                    }

                    $uploader = Cloudy::getUploader ();
                    try
                    {
                        $results = $uploader->upload ( $file_tmp, $options = [
                            'public_id' => $user->email,
                            'folder'    => 'user'
                        ] );
                    } catch ( Exception $msg )
                    {
                        return Response::json ( [
                            'error_msg' => 'Something went wrong with the server !'
                        ] );
                    }

                    $user->photo_url = $results[ 'url' ];
                    if ( $user->save () )
                    {
                        return Response::json ( [
                            'save' => $results[ 'url' ]
                        ] );
                    } else
                    {
                        return Response::json ( [
                            'error_msg' => 'Something went wrong !'
                        ] );
                    }
                }
            } else
            {
                return Response::json ( [
                    'error_msg' => "Please upload an image"
                ] );
            }
        }

        public function deleteSchoolLogo(){
            $school = School::find ( Input::get ( 'id' ) );
            $photos = $school->photos;
            if ( count ( $photos ) > 0 )
            {
                $image = new Image;
                $image = $image->where ( 'imageable_id', '=', Input::get ( "id" ) )->delete();
                if($image == 1){
                    return Response::json ( [
                        'save' => 'School Logo deleted'
                    ] );
                }else{
                    return Response::json ( [
                        'error_msg' => "Cannot complete action at this moment, try again later"
                    ] );
                }
            }else{
                return Response::json ( [
                    'error_msg' => "You have no image to delete !"
                ] );
            }

        }

        public function deleteUserImage(){
            $user = Sentry::getUser ();
            $url = $user->photo_url;
            if( !empty($url) ){
                $user->photo_url = "";
                if ( $user->save () )
                {
                    return Response::json ( [
                        'save' => 'User Image Deleted'
                    ] );
                } else
                {
                    return Response::json ( [
                        'error_msg' => 'Something went wrong !'
                    ] );
                }
            }else{
                return Response::json ( [
                    'error_msg' => "You have no image to delete !"
                ] );
            }
        }
    }

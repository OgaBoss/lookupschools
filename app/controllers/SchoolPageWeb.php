<?php

    /**
     * Created by PhpStorm.
     * User: OluwadamilolaAdebayo
     * Date: 2/22/16
     * Time: 10:58 PM
     */
    class SchoolPageWeb extends \BaseController  {
        public function getImagePage($slug){
            $school = School::findBySlug( $slug );
            $images = $school->webPageImage;
            return View::make('school-admin.image-upload')
                ->with('school', $school)
                ->with('images', $images);
        }

        public function uploadImage() {
            $school = School::find ( Input::get ( 'id' ) );
            $schoolName = $school->slug;
            if ( isset($_FILES[ 'webpageimage' ]) )
            {
                $photos = $school->webPageImage;
                if ( count ( $photos ) >= 3 )
                {
                    return Response::json ( [
                        'error_msg' => "You already have a 3 Images uploaded"
                    ] );
                } else
                {
                    if ( $_FILES[ 'webpageimage' ][ 'error' ] )
                    {
                        return Response::json ( [
                            'error_msg' => "Something went wrong, please try again later or use another image"
                        ] );
                    }
                    $name = $_FILES[ 'webpageimage' ][ 'name' ];
                    $size = $_FILES[ 'webpageimage' ][ 'size' ];
                    $file_tmp = $_FILES[ 'webpageimage' ][ 'tmp_name' ];
                    $file_ext = explode ( '.', $name );
                    $file_ext = end ( $file_ext );
                    $file_ext = strtolower ( $file_ext );
                    $extensions = ["jpeg", "jpg", "png"];

                    if ( in_array ( $file_ext, $extensions ) === false )
                    {
                        return Response::json ( [
                            'error_msg' => "Please Upload an image that are one of the following format jpeg, png, jpg"
                        ] );
                    }

                    if ( $size > 1000000 )
                    {
                        return Response::json ( [
                            'error_msg' => "Please Upload an image that is 1MB or less"
                        ] );
                    }

                    $uploader = Cloudy::getUploader ();
                    $results = $uploader->upload ( $file_tmp, $options = [
                        'public_id' => $schoolName,
                        'folder'    => 'webimages'
                    ] );
                    $image = new WebPageImage( [
                        'publicID'  => $results[ 'public_id' ],
                        'openURL'   => $results[ 'url' ],
                        'secureURL' => $results[ 'secure_url' ]
                    ] );

                    if ( $school->webPageImage ()->save ( $image ) )
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
    }
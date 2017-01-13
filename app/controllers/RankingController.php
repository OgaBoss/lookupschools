<?php

    /**
     * Created by PhpStorm.
     * User: OluwadamilolaAdebayo
     * Date: 1/25/16
     * Time: 11:33 AM
     */
    class RankingController extends \BaseController {
        public function rank(){
            if(!empty(Input::get('value')) &&  !empty(Input::get('sid'))){
                $school = School::find(Input::get('sid'));
                //Save to school_rank table
                $schoolRank = new SchoolRank;
                $data = $schoolRank->where('school_id','=',Input::get('sid'))->first();
                if(count($data) > 0){
                    $rnk = (Input::get('value') + $data['rank']) / 2;
                    $data->school_id = Input::get('sid');
                    $data->rank = ceil($rnk);
                    $data->count = $data->count + 1;
                    if($data->save()){
                        $school->rank = ceil($rnk);
                        $school->save();
                        return $this->saveToUserSchoolRank( $school );
                    }
                }else{
                    $new_data = new SchoolRank(array(
                        'school_id'     => Input::get('sid'),
                        'rank'          => Input::get('value'),
                        'count'         => 1
                    ));



                    if($new_data->save()){
                        $school->rank = Input::get('value');
                        $school->save();
                        return $this->saveToUserSchoolRank( $school );
                    }
                }

            }
        }

        /**
         * @param $school
         * @return \Illuminate\Http\JsonResponse
         */
        protected function saveToUserSchoolRank( $school )
        {
            //Save to user_school_rank table
            $userSchoolRank = new UserSchoolRank;
            $rank_data = $userSchoolRank
                ->where( 'school_id', '=', Input::get( 'sid' ) )
                ->where( 'user_id', '=', Sentry::getUser()->id )
                ->first();
            if ( count( $rank_data ) > 0 )
            {
                $rank_data->school_id = Input::get( 'sid' );
                $rank_data->user_id = Sentry::getUser()->id;
                $rank_data->rank = Input::get( 'value' );
                $rank_data->count = $rank_data->count + 1;
                if ( $rank_data->save() )
                {
                    return Response::json( [
                        'save' => 'You have ranked ' . ucfirst( $school->name ) . ' again.'
                    ] );
                } else
                {
                    return Response::json( [
                        'error_msg' => 'Something went wrong'
                    ] );
                }
            } else
            {
                $new_rank_data = new UserSchoolRank( [
                    'school_id' => Input::get( 'sid' ),
                    'user_id' => Sentry::getUser()->id,
                    'rank'      => Input::get( 'value' ),
                    'count'     => 1
                ] );

                if ( $new_rank_data->save() )
                {
                    return Response::json( [
                        'save' => 'You have ranked ' . ucfirst( $school->name )
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
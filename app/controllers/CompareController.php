<?php

/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 9/19/15
 * Time: 1:09 PM
 */
class CompareController extends  BaseController
{
    public function index(){
        $data =  $user_sch_id = [];

        if(isset($_GET['ids' ])){
            $ids = explode(',', $_GET['ids']);
            foreach($ids as $id){
                $data[] = School::find($id);
            }
        }
        if(Sentry::check()){
            $user = Sentry::getUser();
            $user = Sentry::findUserByID( $user->id );
            $permissions = $user->getPermissions();
            $user_sch = $user->schools;
            foreach($user_sch as $sch){
                $user_sch_id[] = $sch->id;
            }
            return View::make('compare.compare')
                ->with('data', $data)
                ->with('sch_id', $user_sch_id)
                ->with( 'permissions', $permissions);
        }

        return View::make('compare.compare')
            ->with('data', $data);
    }
}
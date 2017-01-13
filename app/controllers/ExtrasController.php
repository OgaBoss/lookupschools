<?php

class ExtrasController extends \BaseController
{

    /**
     * Display a listing of the resource.
     * GET /extras
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(array(
            'clubs' => DB::table('clubs')->get(),
            'health' =>  DB::table('health')->get(),
            'medical' => DB::table('medical')->get(),
            'daycare' => DB::table('daycare')->get(),
            'program' => DB::table('program')->get(),
            'sport' => DB::table('sport')->get(),
            'subject' => DB::table('subject')->get(),
            'vocational' => DB::table('vocational')->get(),
            'vocation' => DB::table('vocation')->get(),
            'accommodation' => DB::table('accommodation')->get()
        ));
    }

    public function tableData(){
        if(isset($_POST['table']) && isset($_POST['data']) && $_POST['table'] != "" && $_POST['data'] != ""){
            $names = explode(',', $_POST['data']);
            foreach($names as $name){
                $check = DB::table($_POST['table'])->where('name','=',$name);
                if(count($check) > 0){
                    return Response::json(array(
                        'error' => 'One of or the data you are trying submit, already exit in the system'
                    ));
                }else{
                    $result = DB::table($_POST['table'])->insert(array(
                        'name' => $name
                    ));
                    if($result){
                        return Response::json(array(
                            'save' => 'Your data was successfully created'
                        ));
                    }else{
                        return Response::json(array(
                            'error' => 'Something went wrong please try again'
                        ));
                    }
                }
            }


        }else{
            return Response::json(array(
                'error' => 'Please fill both fields'
            ));
        }
    }
}
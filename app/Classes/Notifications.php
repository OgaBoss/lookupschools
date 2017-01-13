<?php
use sendwithus\API;

/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 7/18/15
 * Time: 12:29 PM
 */
class Notifications{

    public static function notify($template, $data){
        $sendWithUs = new SendWithUs();
        $sendWithUs->prepare($template);
        $sendWithUs->prepare($template);
        $sendWithUs->set_recipient($data);
        $sendWithUs->set_data($data);
        $response = $sendWithUs->simple_send();
        if($response->success){
            return 'success';
        }else{
            return 'error';
        }
    }
}
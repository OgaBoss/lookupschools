<?php
/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 7/19/15
 * Time: 11:00 PM
 */
if(APP_PREFIXED_HOST === 'http://edurepo.dev'){
    return array(
        "base_url" => 'http://edurepo.dev/gglogin/auth',
        "providers" => array(
            "Google" => array(
                "enabled" => TRUE,
                "keys" => array("id" => "711769325144-je4t5d9oij45ih65rdm4hrvk5hpqfev5.apps.googleusercontent.com", "secret" => "qLXN-hhfLynhkMPJhcRwt-sR"),
                "scope" => 'email','profile'
            )
        )
    );
}
if(APP_PREFIXED_HOST === 'http://edurepo-prod.herokuap.com'){
    return array(
        "base_url" => 'http://edurepo-prod.herokuapp.com/gglogin/auth',
        "providers" => array(
            "Google" => array(
                "enabled" => TRUE,
                "keys" => array("id" => "975686711636-ij11gin3b5ughd49jhskdlm61ng9tsnc.apps.googleusercontent.com", "secret" => "sNs5eY3WWE6G5cA1RTtyButZ"),
                "scope" => 'email','profile'
            )
        )
    );
}
if(APP_PREFIXED_HOST === 'http://edurepo-staging.herokuapp.com'){
    return array(
        "base_url" => 'http://edurepo-staging.herokuapp.com/gglogin/auth',
        "providers" => array(
            "Google" => array(
                "enabled" => TRUE,
                "keys" => array("id" => "792435715027-ck3u7do113vini24bgt4tp8ct8uq65k1.apps.googleusercontent.com", "secret" => "7uDSzxMdHfwBmdZ6dN5DvERD"),
                "scope" => 'email','profile'
            )
        )
    );
}

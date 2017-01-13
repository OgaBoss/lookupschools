<?php
if(APP_PREFIXED_HOST === 'http://edurepo.dev'){
    return array(
        "base_url" => 'http://edurepo.dev/fblogin/auth',
        "providers" => array(
            "Facebook" => array(
                "enabled" => TRUE,
                "keys" => array("id" => "394549237401780", "secret" => "caf33840db0318a434c7dd43df14b3b4"),
                "scope" => "public_profile,email"
            )
        )
    );
}
if(APP_PREFIXED_HOST === 'http://edurepo-prod.herokuapp.com'){
    return array(
        "base_url" => 'http://edurepo-prod.herokuapp.com/fblogin/auth',
        "providers" => array(
            "Facebook" => array(
                "enabled" => TRUE,
                "keys" => array("id" => "504848813015534", "secret" => "24673f2a886fb3ef451294df67665d62"),
                "scope" => "public_profile,email"
            )
        )
    );
}
if(APP_PREFIXED_HOST === 'http://edurepo-staging.herokuapp.com'){
    return array(
        "base_url" => 'http://edurepo-staging.herokuapp.com/fblogin/auth',
        "providers" => array(
            "Facebook" => array(
                "enabled" => TRUE,
                "keys" => array("id" => "816739141777997", "secret" => "9fedc29e411f4ada1e076e7474bd8940"),
                "scope" => "public_profile,email"
            )
        )
    );
}


<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Cloudinary API configuration
    |--------------------------------------------------------------------------
    |
    | Before using Cloudinary you need to register and get some detail
    | to fill in below, please visit cloudinary.com.
    |
    */

    'cloudName'  => 'lookupschool',
    'baseUrl'    => 'http://res.cloudinary.com/lookupschool',
    'secureUrl'  => 'https://res.cloudinary.com/lookupschool',
    'apiBaseUrl' => 'https://api.cloudinary.com/v1_1/lookupschool',
    'apiKey'     => '462535169462317',
    'apiSecret'  => 'm2TUz-THNgZAnne0_MwoFV4d7jY',

    /*
    |--------------------------------------------------------------------------
    | Default image scaling to show.
    |--------------------------------------------------------------------------
    |
    | If you not pass options parameter to Cloudy::show the default
    | will be replaced.
    |
    */

    'scaling'    => array(
        'format' => 'png',
        'width'  => 150,
        'height' => 150,
        'crop'   => 'fit',
        'effect' => null
    )

);

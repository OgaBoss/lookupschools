<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the Closure to execute when that URI is requested.
    |
    */

    Route::get( '/', [
        'as'   => '/',
        'uses' => 'HomeController@showWelcome'
    ] );

    Route::get( 'login', ['as' => 'login_form', 'uses' => 'LoginController@index'] );
    Route::post( 'login', ['as' => 'login_form_post', 'before' => 'csrf|is_guest', 'uses' => 'LoginController@postLogin'] );
    Route::get( 'signup', ['as' => 'signup_form', 'uses' => 'SignupController@index'] );
    Route::post( 'signup', ['as' => 'signup_form_post', 'before' => 'csrf|is_guest', 'uses' => 'SignupController@signUp'] );
    Route::post( 'guest', ['as' => 'guest_signup_form_post', 'before' => 'csrf|is_guest', 'uses' => 'SignupController@guestSignup'] );
    Route::get( 'activate/{id}/{conf_code}', ['as' => 'verifyEmail', 'uses' => 'SignupController@verifyAccount'] );
    Route::get( 'fblogin/{auth?}', ['as' => 'fblogin', 'before' => 'is_guest', 'uses' => 'LoginController@getFacebookLogin'] );
    Route::get( 'facebook', ['as' => 'facebook', 'before' => 'is_guest', 'uses' => 'LoginController@facebook'] );
    Route::get( 'google', ['as' => 'google', 'before' => 'is_guest', 'uses' => 'LoginController@google'] );
    Route::get( 'gglogin/{auth?}', ['as' => 'gglogin', 'before' => 'is_guest', 'uses' => 'LoginController@getGoogleLogin'] );
    Route::get( 'pwreset', ['as' => 'pwreset_form', 'before' => 'is_guest', 'uses' => 'LoginController@getPasswordReset'] );
    Route::post( 'pwreset', ['as' => 'pwreset_form_post', 'before' => 'is_guest', 'uses' => 'LoginController@postPasswordReset'] );
    Route::get( 'pwreset/{id}/{reset_code}', ['as' => 'new_password_form', 'uses' => 'LoginController@getNewPassword'] );
    Route::post( 'pwreset/{id}/{reset_code}', ['as' => 'new_password_form_post', 'uses' => 'LoginController@postNewPassword'] );
    Route::get( 'admin_login', ['as' => 'admin_login', 'uses' => 'AdminController@getLogin'] );
    Route::post( 'send_email', ['as' => 'send_email', 'uses' => 'HomeController@homePageSendEmail'] );
    //Route::get('school/fblogout', array('as' => 'facebook_logout','uses' => 'LoginController@getFbLogout'));
    //Route::get('school/gglogout', array('as' => 'google_logout','uses' => 'LoginController@getGgLogout'));


    //Route::get('home', array('as' => 'school_dashboard','prefix' => 'school', 'before'  => 'user','uses' => 'SchoolController@getSchool'));
    Route::get( 'logout', [
        'as'   => 'logout',
        'uses' => 'LoginController@getLogout'
    ] );

    //Get Modal for Home Page
    Route::post( 'modal_ad', [
        'as'   => 'modal_ad',
        'uses' => 'HomeController@adverts'
    ] );
    Route::group( ['prefix' => 'school', 'before' => 'user'], function ()
    {

        //get all the current  users schools
        Route::get( 'home', [
            'as'   => 'school_dashboard',
            'uses' => 'SchoolController@getSchool'
        ] );

        //Handles the Basic Information
        //Section on the school Dashboard
        Route::get( '{slug}/basic_information', [
            'as'   => 'get_school',
            'uses' => 'SchoolController@getBasicInfo'
        ] );
        Route::post( 'basic_info', [
            'as'   => 'basic_info',
            'uses' => 'SchoolController@store'
        ] );


        //Adding new school
        Route::get( 'show_school', [
            'as'   => 'show_school_form',
            'uses' => 'SchoolController@showSchool'
        ] );
        Route::post( 'add_school', [
            'as'   => 'post_school_form',
            'uses' => 'SchoolController@addSchool'
        ] );

        //Returns all Data partaining
        // to a school
        Route::get( 'ajax_school', [
            'as'   => 'ajax_school',
            'uses' => 'SchoolController@ajaxGetSchool'
        ] );

        //handles the school Admin data
        Route::get( 'administrator', [
            'as'   => 'administrator',
            'uses' => 'SchoolController@getAdmin'
        ] );

        //Upload school logo
        Route::post( 'logo_upload', [
            'as'   => 'logo_upload',
            'uses' => 'SchoolController@uploadLogo'
        ] );

        //School logo Update
        Route::post( 'logo_upload_update', [
            'as'   => 'logo_upload_update',
            'uses' => 'SchoolController@updateUploadLogo'
        ] );

        //Upload User Image
        Route::post( 'user_image_upload', [
            'as'   => 'user_image_upload',
            'uses' => 'SchoolController@userImageUpload'
        ] );

        //Delete school logo
        Route::post('delete_school_logo', [
            'as' => 'delete_school_logo',
            'uses' => 'SchoolController@deleteSchoolLogo'
        ]);

        //Delete user profile image
        Route::post('delete_user_image', [
            'as' => 'delete_user_image',
            'uses' => 'SchoolController@deleteUserImage'
        ]);

        //update user image
        Route::post( 'user_image_update', [
            'as'   => 'user_image_update',
            'uses' => 'SchoolController@updateUserImage'
        ] );

        //Handles the School Contact Section
        Route::get( '{slug}/school_contact', [
            'as'   => 'school_contact',
            'uses' => 'ContactController@show'
        ] );
        Route::post( 'post_school_contact', [
            'as'   => 'post_school_contact',
            'uses' => 'ContactController@store'
        ] );

        //Handles the School Structure Section
        Route::get( '{slug}/school_structure', [
            'as'   => 'school_structure',
            'uses' => 'StructureController@show'
        ] );
        Route::post( 'post_school_structure', [
            'as'   => 'post_school_structure',
            'uses' => 'StructureController@store'
        ] );

        //Handles the School Accreditation section
        Route::get( '{slug}/school_accreditation', [
            'as'   => 'school_accreditation',
            'uses' => 'AccreditationController@show'
        ] );
        Route::post( 'post_school_accreditation', [
            'as'   => 'post_school_accreditation',
            'uses' => 'AccreditationController@store'
        ] );

        Route::get( '{slug}/school_affiliation', [
            'as'   => 'school_affiliation',
            'uses' => 'AffiliationController@show'
        ] );

        //Handles the school Affiliation
        Route::post( 'post_school_affiliation', [
            'as'   => 'post_school_affiliation',
            'uses' => 'AffiliationController@store'
        ] );
        Route::get( '{slug}/pps_school_extras', [
            'as'   => 'pps_school_extras',
            'uses' => 'PrimaryController@index'
        ] );

        //Handling School Extras for PPSs
        Route::post( 'post_pps_school_extras_one', [
            'as'   => 'post_pps_school_extras_one',
            'uses' => 'PrimaryController@store'
        ] );
        Route::post( 'post_pps_school_extras_two', [
            'as'   => 'post_pps_school_extras_two',
            'uses' => 'PrimaryController@postExtras'
        ] );

        //Handling School Extras for TVs
        Route::get( '{slug}/tv_school_extras', [
            'as'   => 'tv_school_extras',
            'uses' => 'TertiaryController@index'
        ] );
        Route::post( 'post_tv_school_extras', [
            'as'   => 'post_tv_school_extras',
            'uses' => 'TertiaryController@store'
        ] );

        //Route for creating new user
        Route::get( '{slug}/new_user', [
            'as'   => 'new_user',
            'uses' => 'UserController@show'
        ] );
        Route::post( 'createNewUser', [
            'as'   => 'createNewUser',
            'uses' => 'UserController@create'
        ] );

        //Returns all the Table Data
        Route::get( 'tableData', [
            'as'   => 'tableData',
            'uses' => 'ExtrasController@index'
        ] );

        //Adding new Data to to the Data tables
        Route::post( 'postTableData', [
            'as'   => 'postTableData',
            'uses' => 'ExtrasController@tableData'
        ] );

        //Faculty and Courses
        Route::get( '{slug}/faculty_courses', [
            'as'   => 'faculty_courses',
            'uses' => 'FacultyController@show'
        ] );
        Route::post( 'post_faculty_courses', [
            'as'   => 'post_faculty_courses',
            'uses' => 'FacultyController@create'
        ] );

        Route::post( 'post_courses', [
            'as'   => 'post_courses',
            'uses' => 'FacultyController@postCourse'
        ] );

        //Change User Password
        Route::post( 'change_password', [
            'as'   => 'change_password',
            'uses' => 'UserController@editPassword'
        ] );

        Route::post( 'edit_profile', [
            'as'   => 'edit_profile',
            'uses' => 'UserController@editProfile'
        ] );

        //Events Page
        Route::get( '{slug}/events', [
            'as'   => 'school_events',
            'uses' => 'EventController@show'
        ] );

        //Save events
        Route::post( '/save_events', [
            'as'   => 'save_events',
            'uses' => 'EventController@saveEvents'
        ] );

        //Edit Events
        Route::post( '/edit_events', [
            'as'   => 'edit_events',
            'uses' => 'EventController@editEvents'
        ] );

        //Delete Events
        Route::post( '/delete_events', [
            'as'   => 'delete_events',
            'uses' => 'EventController@deleteEvents'
        ] );

        //get all event
        Route::post( '/all_events', [
            'as'   => 'all_events',
            'uses' => 'EventController@allEvents'
        ] );

        //get Image upload page
        Route::get('{slug}/page_image_upload', [
            'as' => 'page_image_upload',
            'uses' => 'SchoolPageWeb@getImagePage'
        ]);

        //Upload Image
        Route::post('/page_image_upload', [
            'as' => 'page_image_upload',
            'uses' => 'SchoolPageWeb@uploadImage'
        ]);

        //Messaging route
        //Inbox
        Route::get('inbox',[
            'as' => 'school_inbox',
            'uses' => 'MessageController@getSchoolInboxPage'
        ]);

        //Compose
        Route::get('{slug}/compose',[
            'as' => 'school_compose',
            'uses' => 'MessageController@getSchoolComposePage'
        ]);

        //Read
        Route::get('message/{id}',[
            'as' => 'read_message',
            'uses' => 'MessageController@readSchoolMessage'
        ]);

        //unread messages
        Route::post('unread_messages',[
            'as' => 'unread_messages',
            'uses' => 'MessageController@unReadSchoolMessage'
        ]);

        //Send message
        Route::post('school_post_compose',[
            'as' => 'school_post_compose',
            'uses' => 'MessageController@postMessage'
        ]);

        //View Sent Messages
        Route::get('sent_message', [
            'as' => 'sent_message',
            'uses' => 'MessageController@sentSchoolMessage'
        ]);

        //School Billing
        Route::get('/{slug}/billing',[
            'as' => 'billing',
            'uses' => 'BillingController@getBills'
        ]);

        Route::get('/{slug}/web_page', [
            'as' => 'web_page',
            'uses' => 'MiniSiteController@getWebPage'
        ]);

        Route::post('/statement',[
            'as' => 'statement',
            'uses' => 'MiniSiteController@postStatement'
        ]);

        Route::post('/team-member',[
            'as' => 'team-member',
            'uses' => 'MiniSiteController@setTeamMemberData'
        ]);

        Route::post('/setTestimony', [
            'as' => 'setTestimony',
            'uses' => 'MiniSiteController@setTestimony'
        ]);
    } );


    Route::group( ['prefix' => 'search'], function ()
    {
        Route::get( 'search_results', [
            'as'   => 'search_results',
            'uses' => 'SearchController@index'
        ] );

        Route::get( 'get_area', [
            'as'   => 'get_area',
            'uses' => 'SearchController@getArea'
        ] );

        Route::get( 'advanced_search', [
            'as'   => 'advanced_search',
            'uses' => 'SearchController@advancedSearch'
        ] );
        Route::get( 'get-data', [
            'as'   => 'get-data',
            'uses' => 'SearchController@getData'
        ] );

        Route::get( 'show_results', [
            'as'   => 'show_results',
            'uses' => 'SearchController@postSearch'
        ] );

        Route::post( 'compare', [
            'as'   => 'compare',
            'uses' => 'SearchController@compare'
        ] );

        Route::get( 'searchByFees', [
            'as'   => 'searchByFees',
            'uses' => 'SearchController@searchByFees'
        ] );

        Route::get( 'compare', [
            'as'   => 'compare',
            'uses' => 'CompareController@index'
        ] );
    } );


    Route::group( ['prefix' => 'admin', 'before' => 'admin_user'], function ()
    {
        Route::get( 'home', [
            'as'   => 'admin_dashboard',
            'uses' => 'AdminController@index',
        ] );

        Route::get( 'site_data', [
            'as'   => 'site_data',
            'uses' => 'DataController@index'
        ] );

        Route::get( 'users', [
            'as'   => 'users',
            'uses' => 'AdminController@getUsers'
        ] );

        Route::get( 'guest', [
            'as'   => 'guest',
            'uses' => 'AdminController@getGuest'
        ] );

        Route::get( 'admins', [
            'as'   => 'admins',
            'uses' => 'AdminController@getAdmin'
        ] );

        Route::post( 'suspend', [
            'as'   => 'suspend',
            'uses' => 'AdminController@suspendUser'
        ] );

        Route::post( 'approve', [
            'as'   => 'approve',
            'uses' => 'AdminController@approveUser'
        ] );

        Route::get( 'search_user', [
            'as'   => 'search_user',
            'uses' => 'AdminController@searchUser'
        ] );

        //Data
        Route::get( 'data_get/{type}', [
            'as'   => 'data_get',
            'uses' => 'DataController@show'
        ] );

        Route::post( 'data_post', [
            'as'   => 'data_post',
            'uses' => 'DataController@edit'
        ] );

        Route::get('/advert',[
            'as' => 'admin_advert',
            'uses' => 'AdvertsController@getAdminAdvert'
        ]);

        Route::get('/billing',[
            'as' => 'billing',
            'uses' => 'AdvertsController@adminBilling'
        ]);

        Route::post('create_advert', [
            'as' => 'create_advert',
            'uses' => 'AdvertsController@createAdvert'
        ]);

        // Adverts and Billing
        // ========================

        // Suspend Adverts
        Route::post('/advert/suspend', [
            'as' => 'suspend_advert',
            'uses' => 'AdvertsController@suspendAdvert'
        ]);

        // Approve Adverts
        Route::post('/advert/approve', [
            'as' => 'approve_advert',
            'uses' => 'AdvertsController@approveAdvert'
        ]);

        //find user by email
        Route::get('user_by_email', [
            'as' => 'user_by_email',
            'uses' => 'AdminController@getUserByEmail'
        ]);
    } );

    //Guest
    Route::group( ['prefix' => 'guest', 'before' => 'user'], function ()
    {
        Route::get( 'home', [
            'as'   => 'guest_dashboard',
            'uses' => 'GuestController@index',
        ] );

        Route::get( '{slug}/school_information', [
            'as'   => 'guest_get_school',
            'uses' => 'GuestController@getBasicInfo'
        ] );

        Route::post( 'rank', [
            'as'   => 'rank',
            'uses' => 'RankingController@rank'
        ] );

        //Messaging route
        //Inbox
        Route::get('/inbox',[
            'as' => 'guest_inbox',
            'uses' => 'MessageController@getGuestInboxPage'
        ]);

        //Compose
        Route::get('{slug}/compose',[
            'as' => 'guest_compose',
            'uses' => 'MessageController@getGuestComposePage'
        ]);

        //Send message
        Route::post('post_compose',[
            'as' => 'post_compose',
            'uses' => 'MessageController@postMessage'
        ]);

        //View Sent Messages
        Route::get('sent_message', [
            'as' => 'sent_message',
            'uses' => 'MessageController@sentMessage'
        ]);
    } );

    Route::post( 'follows', [
        'as'   => 'guest_follows',
        'uses' => 'GuestController@followSchool',
    ] );


    Route::group(['prefix' => 'advert', 'before' => 'user'], function (){

        Route::get('{slug}/adverts',[
            'as' => 'all_ads',
            'uses' => 'AdvertsController@index'
        ]);

        Route::post('ad_signup',[
            'as' => 'ad_signup',
            'uses' => 'AdvertsController@advertSignUp'
        ]);

        Route::post('cancel_ad',[
            'as' => 'cancel_ad',
            'uses' => 'AdvertsController@advertCancel'
        ]);

        Route::get('verify', [
            'as' => 'verify',
            'uses' => 'AdvertController@advertVerification'
        ]);
    });


    Route::group(array('prefix' => 'mini-site'), function()
    {
        Route::get('/school/{slug}', [
            'as' => 'mini-site',
            'uses' => 'MiniSiteController@index'
        ]);

        Route::post('/school/upload', [
            'as' => '/school/upload',
            'uses' => 'MiniSiteController@uploadImage'
        ]);
        Route::post('/school/testimony', [
            'as' => '/school/testimony',
            'uses' => 'MiniSiteController@testimonyUpload'
        ]);
    });
<?php

/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 11/15/15
 * Time: 3:59 PM
 */
class Contact extends Eloquent
{
    protected $table = 'contacts';
    protected $fillable = [
        'website',
        'info_email',
        'sale_email',
        'academic_email',
        'phone_1',
        'phone_2',
        'mobile_1',
        'mobile_2',
        'fax',
        'telex'
    ];

    public function school(){
        return $this->belongsTo('School', 'school_id');
    }

}
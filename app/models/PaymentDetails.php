<?php

    /**
     * Created by PhpStorm.
     * User: OluwadamilolaAdebayo
     * Date: 6/5/16
     * Time: 6:00 PM
     */
    class PaymentDetails extends \Eloquent {
        protected $table = 'payment_details';

        public function advertSchool(){
            return $this->belongsTo('AdvertSchool');
        }
    }
<?php

    /**
     * Created by PhpStorm.
     * User: OluwadamilolaAdebayo
     * Date: 3/6/16
     * Time: 7:15 AM
     */
    use Illuminate\Database\Eloquent\SoftDeletingTrait;

    class AdvertSchool extends \Eloquent {
        use SoftDeletingTrait;

        protected $dates = ['deleted_at'];
        protected $table = 'advert_school';
        protected $guarded = ['id'];

        public function paymentDetail(){
            return $this->belongsToMany('PaymentDetails');

        }
    }
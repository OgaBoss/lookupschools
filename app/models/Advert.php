<?php

    /**
     * Created by PhpStorm.
     * User: OluwadamilolaAdebayo
     * Date: 3/6/16
     * Time: 12:25 AM
     */
    class Advert extends \Eloquent {
        protected $guarded = ['id'];
        protected $table = 'adverts';

        public function school(){
            return $this->belongsToMany('School');
        }
    }
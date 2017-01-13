<?php

    /**
     * Created by PhpStorm.
     * User: OluwadamilolaAdebayo
     * Date: 3/19/16
     * Time: 2:46 PM
     */
    class Testimony  extends \Eloquent{
        protected $table = 'testimonies';
        protected $fillable = ['image_url', 'school_id','testimony', 'name', 'count'];

        public function school(){
            return $this->belongsTo('School');
        }
    }
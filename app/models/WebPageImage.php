<?php

    /**
     * Created by PhpStorm.
     * User: OluwadamilolaAdebayo
     * Date: 2/23/16
     * Time: 8:02 AM
     */
    class WebPageImage extends \Eloquent{
        protected $table = 'webpageimages';
        protected $guarded = ['id'];

        public function school(){
            return $this->belongsTo('School');
        }
    }
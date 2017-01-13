<?php

    /**
     * Created by PhpStorm.
     * User: OluwadamilolaAdebayo
     * Date: 3/19/16
     * Time: 2:46 PM
     */
    class Team extends \Eloquent{
        protected $table = 'teams';
        protected $fillable = ['image_url', 'school_id','position','bio', 'name', 'team_count'];

        public function school(){
            return $this->belongsTo('School');
        }
    }
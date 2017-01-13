<?php

class Course extends \Eloquent {
	protected $fillable = [];

    public function faculty(){
        return $this->belongsTo('Faculty');
    }
}
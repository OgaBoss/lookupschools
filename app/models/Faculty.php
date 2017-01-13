<?php

class Faculty extends \Eloquent {
    protected $table = 'faculty';
	protected $fillable = [];

    public function course(){
        return $this->hasMany('Course');
    }

    public function school(){
        return $this->belongsToMany('School')->withTimeStamps();
    }

    public function courses(){
        return $this->hasManyThrough('FacultySchoolCourse','FacultySchool');
    }
}
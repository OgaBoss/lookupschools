<?php

class FacultySchool extends \Eloquent {
	protected $fillable = [
        'school_id',
        'faculty_id'
    ];
    protected $table = 'faculty_school';

    public function facultySchoolCourse(){
        return $this->hasMany('FacultySchool');
    }
}
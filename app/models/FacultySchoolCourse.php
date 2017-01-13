<?php

class FacultySchoolCourse extends \Eloquent {
	protected $fillable = ['course', 'faculty_school_id'];
    protected $table = 'faculty_school_course';

    public function facultySchool(){
        return $this->belongsTo('FacultySchoolCourse');
    }
}
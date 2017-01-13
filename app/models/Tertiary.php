<?php

class Tertiary extends \Eloquent {
    protected $table = 'tvbasic';
	protected $fillable = [
        'medical_facility',
        'health_prof',
        'accommodation',
        'average_student',
        'admission_age_limit',
        'vocational_facility',
        'sport_facility',
        'admission_requirement',
        'vocation_category',
        'program_offered'
    ];

    public function school(){
        return $this->belongsTo('School', 'school_id');
    }
}
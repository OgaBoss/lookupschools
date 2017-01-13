<?php

class Accreditation extends \Eloquent {
	protected $fillable = [
		'accreditations_1',
		'accreditations_2',
		'accreditations_3',
		'accreditations_4',
		'accreditations_5',

	];

	public function school(){
		return $this->belongsTo('School', 'school_id');
	}
}
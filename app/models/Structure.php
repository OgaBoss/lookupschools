<?php

class Structure extends \Eloquent {
	protected $fillable = [
		'dob',
		'school_head',
		'sex',
		'ownership',
		'public',
		'military',
		'private',
		'religion',
		'school_type',
		'tertiary',
		'preschool',
		'min',
		'max'
	];

	public function school(){
		return $this->belongsTo('School', 'school_id');
	}
}


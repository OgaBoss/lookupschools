<?php

class Affiliation extends \Eloquent {
	protected $fillable = [
		'affiliations_1',
		'affiliations_2',
		'affiliations_3',
		'affiliations_4',
		'affiliations_5',
		'affiliations_6',
	];

	public function school(){
		return $this->belongsTo('School', 'school_id');
	}
}
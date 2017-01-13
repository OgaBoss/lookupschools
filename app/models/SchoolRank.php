<?php

class SchoolRank extends \Eloquent {
	protected $fillable = ['school_id', 'rank', 'count'];
	protected $table = 'school_rank';

	public function school(){
		return $this->belongsTo('School');
	}
}
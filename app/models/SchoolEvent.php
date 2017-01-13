<?php

class SchoolEvent extends \Eloquent {
	protected $table = 'events';
	protected $fillable = ['school_id', 'description', 'startdate', 'allday', 'title', 'enddate', 'event_id', 'color'];

	public function school(){
		return $this->belongsTo('School');
	}
}

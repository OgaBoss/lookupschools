<?php

class Primary extends \Eloquent {
    protected $table = 'ppbasic';
    protected $guarded = array('id', 'school_id');

    public function school(){
        return $this->belongsTo('School', 'school_id');
    }
}
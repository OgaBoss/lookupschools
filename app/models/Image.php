<?php

class Image extends \Eloquent {
    protected $table = 'photos';
	protected $guarded = ['id'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
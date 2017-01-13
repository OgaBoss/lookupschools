<?php

class UserSchoolRank extends \Eloquent {
	protected $fillable = ['school_id', 'user_id', 'count', 'rank'];
	protected $table = 'user_school_rank';

}
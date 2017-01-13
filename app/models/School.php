<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 7/25/15
 * Time: 5:16 PM
 */
class School extends Eloquent implements SluggableInterface{
    use SluggableTrait;

    protected $table = 'schools';

    protected $sluggable = array(
        'build_from' => 'slugname',
        'save_to' =>'slug'
    );

    protected $fillable = array('email', 'name', 'website_url');

    public function user(){
        return $this->belongsToMany('User')->withTimeStamps();
    }

    public function contact(){
        return $this->hasOne('Contact', 'school_id');
    }

    public function structure(){
        return $this->hasOne('Structure', 'school_id');
    }

    public function accreditation(){
        return $this->hasOne('Accreditation', 'school_id');
    }

    public function affiliation()
    {
        return $this->hasOne('Affiliation', 'school_id');
    }

    public function tertiaries()
    {
        return $this->hasOne('Tertiary', 'school_id');
    }

    public function primary()
    {
        return $this->hasOne('Primary', 'school_id');
    }

    public function faculty(){
        return $this->belongsToMany('Faculty');
    }

    public function photos()
    {
        return $this->morphMany('Image', 'imageable');
    }

    public function getSlugnameAttribute(){
        return $this->name. " " . $this->school_type;
    }

    public function schoolRank(){
        return $this->hasOne('SchoolRank');
    }

    public function schoolEvent(){
        return $this->hasMany('SchoolEvent', 'school_id');
    }

    public function webPageImage(){
        return $this->hasMany('WebPageImage', 'school_id');
    }

    public function advert(){
        return $this->belongsToMany('Advert');
    }

    public function team(){
        return $this->hasMany('Team');
    }

    public function testimony(){
        return $this->hasMany('Testimony');
    }
}
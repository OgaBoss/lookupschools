<?php

    /**
     * Created by PhpStorm.
     * User: OluwadamilolaAdebayo
     * Date: 3/6/16
     * Time: 1:41 PM
     */
    use Illuminate\Database\Eloquent\SoftDeletingTrait;

    class Billing extends \Eloquent {
        use SoftDeletingTrait;

        protected $dates = ['deleted_at'];
        protected $guarded = ['id'];

    }
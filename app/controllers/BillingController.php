<?php

    /**
     * Created by PhpStorm.
     * User: OluwadamilolaAdebayo
     * Date: 3/6/16
     * Time: 12:17 PM
     */
    class BillingController extends \BaseController {
        public function getBills($slug){
            $school = School::findBySlug($slug);
            $bill = new Billing;
            $bill = $bill->where('school_id', '=', $school->id)->get();
            return View::make('school-admin.billing')
                ->with('school', $school)
                ->with('bills', $bill);
        }
    }
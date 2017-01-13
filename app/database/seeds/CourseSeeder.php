<?php

/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 12/7/15
 * Time: 10:55 PM
 */
class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Eloquent::unguard();

        $faker = Faker\Factory::create();
        $faculty = Faculty::lists('id');
        for($i=0;$i < 100; $i++){
            Course::create(array(
                'faculty_id' => $faker->randomElement($faculty),
                'name' => $faker->unique()->word
            ));
        }

        //Eloquent::reguard();
    }

}
<?php

/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 12/7/15
 * Time: 10:16 PM
 */
class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Eloquent::unguard();
        $faker = Faker\Factory::create();
        for($i=0;$i < 11; $i++){
            Faculty::create(array(
                'name' => $faker->unique()->word
            ));
        }
        Eloquent::reguard();
    }
}
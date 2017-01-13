<?php

/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 12/24/15
 * Time: 9:40 AM
 */
class SchoolUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Eloquent::unguard();

        $faker = Faker\Factory::create();
        $user = User::lists('id');
        $school = School::lists('id');
        foreach($school as $id){
            DB::table('school_user')->insert(array(
                'school_id' => $id,
                'user_id' => $faker->randomElement($user),
            ));
        }

        //Eloquent::reguard();
    }
}
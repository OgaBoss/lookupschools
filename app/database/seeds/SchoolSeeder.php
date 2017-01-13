<?php

/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 12/24/15
 * Time: 7:35 AM
 */
class SchoolSeeder extends Seeder
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
        $school_type = ['preschool', 'primary', 'secondary', 'tertiary', 'vocation'];
        $area = ['Yaba', 'Ikeja', 'Lekki', 'Ketu', 'Oshodi'];
        for($i=0;$i < 200; $i++){
            School::create(array(
                'user_id' => $faker->randomElement($user),
                'name' => $faker->unique()->word,
                'local_gov' => 'Lagos-Mainland',
                'state' => 'Lagos',
                'area' => $area[array_rand($area)],
                'address' => $faker->address,
                'school_type' => $school_type[array_rand($school_type)],
                'school_head' => $faker->name,
                'slug' => $faker->unique()->slug
            ));
        }
        //Eloquent::reguard();
    }
}
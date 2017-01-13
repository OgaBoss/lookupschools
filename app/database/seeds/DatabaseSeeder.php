<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

//		Contact::insert(array(
//			'id' => 1,
//			'school_id' => 5,
//			'website' => 'www.google.com',
//			'info_email' => 'school01@school.com',
//			'fax' => 00011000
//		));
        $faker = Faker\Factory::create();
        for($i=0;$i < 11; $i++){
            DB::table('Clubs')->insert(array(
               'name' => $faker->unique()->word
            ));

            DB::table('Daycare')->insert(array(
                'name' => $faker->unique()->word
            ));

            DB::table('Health')->insert(array(
                'name' => $faker->unique()->word
            ));

            DB::table('Medical')->insert(array(
                'name' => $faker->unique()->word
            ));

            DB::table('Program')->insert(array(
                'name' => $faker->unique()->word
            ));

            DB::table('Sport')->insert(array(
                'name' => $faker->unique()->word
            ));

            DB::table('Subject')->insert(array(
                'name' => $faker->unique()->word
            ));

            DB::table('Vocation')->insert(array(
                'name' => $faker->unique()->word
            ));

            DB::table('Vocational')->insert(array(
                'name' => $faker->unique()->word
            ));

            DB::table('Accommodation')->insert(array(
                'name' => $faker->unique()->word
            ));

        }

        Eloquent::reguard();
		// $this->call('UserTableSeeder');
	}

}

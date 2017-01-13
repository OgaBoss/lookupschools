<?php 
if(APP_PREFIXED_HOST === 'http://edurepo.dev'){
	return array(

		/*
        |--------------------------------------------------------------------------
        | oAuth Config
        |--------------------------------------------------------------------------
        */

		/**
		 * Storage
		 */
		'storage' => 'Session',

		/**
		 * Consumers
		 */
		'consumers' => array(

			/**
			 * Facebook
			 */
			'Facebook' => array(
				'client_id'     => '394549237401780',
				'client_secret' => 'caf33840db0318a434c7dd43df14b3b4',
				'scope'         => array('public_profile','email'),
			),
			'Google' => array(
				'client_id'     => '711769325144-je4t5d9oij45ih65rdm4hrvk5hpqfev5.apps.googleusercontent.com',
				'client_secret' => 'qLXN-hhfLynhkMPJhcRwt-sR',
				'scope'         => array('email', 'profile'),
			),

		)

	);
}

if(APP_PREFIXED_HOST === 'http://edurepo-prod.herokuapp.com'){
	return array(

		/*
        |--------------------------------------------------------------------------
        | oAuth Config
        |--------------------------------------------------------------------------
        */

		/**
		 * Storage
		 */
		'storage' => 'Session',

		/**
		 * Consumers
		 */
		'consumers' => array(

			/**
			 * Facebook
			 */
			'Facebook' => array(
				'client_id'     => '504848813015534',
				'client_secret' => '24673f2a886fb3ef451294df67665d62',
				'scope'         => array('public_profile','email'),
			),
			'Google' => array(
				'client_id'     => '975686711636-ij11gin3b5ughd49jhskdlm61ng9tsnc.apps.googleusercontent.com',
				'client_secret' => 'sNs5eY3WWE6G5cA1RTtyButZ',
				'scope'         => array('email', 'profile'),
			),

		)

	);
}
if(APP_PREFIXED_HOST === 'http://edurepo-staging.herokuapp.com'){
	return array(

		/*
        |--------------------------------------------------------------------------
        | oAuth Config
        |--------------------------------------------------------------------------
        */

		/**
		 * Storage
		 */
		'storage' => 'Session',

		/**
		 * Consumers
		 */
		'consumers' => array(

			/**
			 * Facebook
			 */
			'Facebook' => array(
				'client_id'     => '816739141777997',
				'client_secret' => '9fedc29e411f4ada1e076e7474bd8940',
				'scope'         => array('public_profile','email'),
			),
			'Google' => array(
				'client_id'     => '792435715027-ck3u7do113vini24bgt4tp8ct8uq65k1.apps.googleusercontent.com',
				'client_secret' => '7uDSzxMdHfwBmdZ6dN5DvERD',
				'scope'         => array('email', 'profile'),
			),

		)

	);
}

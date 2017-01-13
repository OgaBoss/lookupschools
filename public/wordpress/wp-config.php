<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */


// Define Environments
$environments = array(
	'development' => 'dev',
	'staging' => 'staging',
);
$server_name = $_SERVER['SERVER_NAME'];
foreach($environments AS $key => $env){
	if(strstr($server_name, $env)){
		define('ENVIRONMENT', $key);
		break;
	}
}

// If no environment is set default to production
if(!defined('ENVIRONMENT')) define('ENVIRONMENT', 'production');

// Define different DB connection details depending on environment
switch(ENVIRONMENT){
	case 'development':
		// ** MySQL settings - You can get this info from your web host ** //
		/** The name of the database for WordPress */
		define('DB_NAME', 'edurepo');

		/** MySQL database username */
		define('DB_USER', 'root');

		/** MySQL database password */
		define('DB_PASSWORD', 'root');

		/** MySQL hostname */
		define('DB_HOST', 'localhost');
		break;

	case 'staging':

		// ** MySQL settings - You can get this info from your web host ** //
		/** The name of the database for WordPress */
		define('DB_NAME', 'heroku_15834eac21a8e8a');

		/** MySQL database username */
		define('DB_USER', 'bbe4e3d8985b76');

		/** MySQL database password */
		define('DB_PASSWORD', 'ba2f75c7');

		/** MySQL hostname */
		define('DB_HOST', 'us-cdbr-iron-east-02.cleardb.net');
		break;
}



// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
if(!defined('DB_NAME'))define('DB_NAME', 'heroku_15834eac21a8e8a');
if(!defined('DB_USER'))define('DB_USER', 'bbe4e3d8985b76');
if(!defined('DB_PASSWORD'))define('DB_PASSWORD', 'ba2f75c7');
if(!defined('DB_HOST'))define('DB_HOST', 'us-cdbr-iron-east-02.cleardb.net');

//define('DB_NAME', 'edurepo');

/** MySQL database username */
//define('DB_USER', 'root');

/** MySQL database password */
//define('DB_PASSWORD', 'root');

/** MySQL hostname */
//define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'uJKYhzg&KqY41fPhcF90yiOq]`r:K^ Z9ck61L1{ytt!w-jTW+HkT$+Bu*3$1*5]');
define('SECURE_AUTH_KEY',  '~jAQ,YxKs -MFOcx9E3;`m~L8.>f7Fc}_)#]Y2h@Ueii|u($%m7[-KG&6OW-PIQ:');
define('LOGGED_IN_KEY',    'Z<uU+5|g:5U0NCn,9IK}DxKpUG[QkdjhS*W2zAfKzX<!1urGK?q1&&+D)Xuu_5*9');
define('NONCE_KEY',        'M)+3Dknek_>F)tibg 3s}[3j+/@!-}~tZ6;;_u$`8@A7ae$VxY-}kg$I,gTa.HuQ');
define('AUTH_SALT',        'SdKS]EZ=Y-M A,knP-^R*5CL yUrLrYo5JH<;:pJ}I|+2~OfvcCw:,qql.|(ODf@');
define('SECURE_AUTH_SALT', '<k*MO{N|k@X2|jUx}tO4!od({cz{t,KebpjR!k}b=3h7/dm.r<A*?l(KpJToc@(G');
define('LOGGED_IN_SALT',   'NWUJ:LL<$E-XWV+*XR>_^a=<|crZsDKO9wCAs-;n4(|.M/AodXw[eRB+1mNcGb@.');
define('NONCE_SALT',       '1Jan:/A f--P4?w|65HMy=3o~EoVLF[>uB#k8OIh(98R}}8DQIeqp(%[]djmU{fq');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

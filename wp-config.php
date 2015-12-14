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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'WebScrap');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'rsu2015');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         ',VLv{7s9=nG;*TB,n)AM1 c)-c4@T(dhN*!H{})9woU9:leh(h,4^y)mql:,m3e:');
define('SECURE_AUTH_KEY',  '+xIY?#P.GlBasi%gEgK!)d5U;ax=K]TK;r`&=FkWdE-N9IT[#!HTr=~aW+zoYij=');
define('LOGGED_IN_KEY',    '8_SR-(@kYS<1+K:7$y?^^gNAzcp{|p_*X2pQ8~tNY[;_`vt&aNd~LK6o?.B7h)}E');
define('NONCE_KEY',        'e-$rr_tU@KEKO2E-0$M@q?FQNLp13dog!fp8%PX1r6oPx}{/|.i>R!f&lWgw?tvc');
define('AUTH_SALT',        'j TsZLK+c@}Tuxi(Cj/1Zl+>rwPkVLgu7UAgah.QU=7KL+24A>qW|4xoit1:7n#;');
define('SECURE_AUTH_SALT', 'LT=N=.}4ZA~d{|jr<z0G|>Z(>.:)QUnzbcl!2}oI,*htNu&}ra1Z0>6,>|-v,1,o');
define('LOGGED_IN_SALT',   'z,-HLUl*^?YILxdkZm~k2Zdd-&3(I6`Z*c`16|Fw8P^m5yq5]gMrX2@A.Xnc+NnS');
define('NONCE_SALT',       '/4I?#CE?LV+N!C{@WS&,L<!x*1Ked1=`vq_/K=Wn4P$ZuG62z.KGsGS}F)1TH*7C');

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

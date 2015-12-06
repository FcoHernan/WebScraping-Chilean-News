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
define('AUTH_KEY',         '1|]Cz7Y_<L`,2D`:[&g%5z]!H_%zV-+J;0z14QO+M>{*c,p^<K5>ARn<wN}6Wp/?');
define('SECURE_AUTH_KEY',  '.9R,.E>r#?A$2WRR+ZTJ~4-<eF$07-_@;VHp#|.[+Z^rA|d&*<fL.O2&2R[uJ0)?');
define('LOGGED_IN_KEY',    'Hl@2>RhF>q$u9`KB=y#{iDe+:iYY-flt|@Fld !yxOv?7@6Kum-ET2W CTYaRSNN');
define('NONCE_KEY',        '7HU 4Rc;kj8W>50n4`$7$fB@c)4<#nNetlE5f-l@t=K9Z^#uz`C#J8VCi7!s]>0L');
define('AUTH_SALT',        'C-cmx_bK-PUrX#5E3Y`j?~Gi/cv3`h+Cnn@/XRMD69//}n,bB=4dv}kxa3FzmpC>');
define('SECURE_AUTH_SALT', 'EBuX!;X??~ dDF%)cSA++LJ-lkPC|z|OHFDzqb_Xq!G7>q}?-jc>-+(%<|Z|1D>/');
define('LOGGED_IN_SALT',   'in[c a&55S|+_ro1V?ov|Q4e2w>6i$4|3 Z<6fMDD1W-kqdV+LNz:MZ{U;Q^oNu+');
define('NONCE_SALT',       'fTpIU67UtuOc9&1AH>fe#~9o^GuV+PpOr6L]2q-LMd#FJh*dk+6TtI;S8Kso6eTi');

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

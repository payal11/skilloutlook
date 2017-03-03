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
define('DB_NAME', 'mrword');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'DLz5lB(@k6_m)PBitFG4Yzh.~sk%2R(TF;afZk9 {3eE?5ZIOsDdQfC]a_3(TIxn');
define('SECURE_AUTH_KEY',  ':Zm:!;vvF @iE*tg=}7vUL~i.A*L6y?oI[OC{Z[Pd~TZ1xorg[px9:<kO+u-)xKO');
define('LOGGED_IN_KEY',    'ThMZ2Gc3!o;T1?K!)Jth:whk:,<= ,tDWf!f-83_]r/&+diKLsj>)zFQ^>KoOV7l');
define('NONCE_KEY',        'u*6JVYtQ_(<F& yQZ(UqBv]=kf:*5WR*%#$Ie%r3rwW0t+WG6$~E8@Xn@E=a~~@P');
define('AUTH_SALT',        '%3D9V[[0 {$y~z&IrLA~@bcq+ 1XS:V}-a,otRC!l!|Wdt.m2=~pv NZy(6#V^8i');
define('SECURE_AUTH_SALT', '*->?}_a^L~r,N1h|6D3`BE@s|I?5/yTaSn.QQPWcFinOJc,-eq~V7BU<iP%>B=e@');
define('LOGGED_IN_SALT',   '4tBH%lg`v}XVSdJB^nC(uor?Dbg[@690#X]Yz/XxpBx~~@-~*BjRiHrAx~:-URp~');
define('NONCE_SALT',       ':*ye8jMjJ-%vMqYZSz]Yznt@;S5Hw:TL^JiP~yH1=BUEc:XtNj;.{!y}#Px&|Vv4');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mr_';

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

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
define('DB_NAME', 'catnmsplan');

/** MySQL database username */
define('DB_USER', 'catnmsplan_user');

/** MySQL database password */
define('DB_PASSWORD', 'IC3CR3AM123');

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
define('AUTH_KEY',         '?7yNc~qCb0ipYSt~:R=dMam4Te{X7`>l[{MZ1aL*LTz0GnF;`sa.XSHa}i?7hyXm');
define('SECURE_AUTH_KEY',  'yv`rnyB-Mp^vwwFX ,[0(qNK|yqN?}m?|Wv`LdjrziIE&Lem)l&)iLwp~|h+O_lf');
define('LOGGED_IN_KEY',    'NxsV%cd9%%{%k#Bu/HvFJW+0|1~N}K)=(&)>xX%%l%j0;.P<:#Y17}y54K`t*;+J');
define('NONCE_KEY',        '3.Q>t&>Bzg6u]JOU@j;E6dNBojHWyIbM`q?6nwup&p*|KF}@#1Y7ciYLo<G@4z0s');
define('AUTH_SALT',        'v({7,H9x]=~0MWh`;m I3VH)/[}cu?)-k;o8~b7QZU_qW%YpVe[:5!qHjVTDkG,U');
define('SECURE_AUTH_SALT', '&?Lc8c65k#XF@5mi4r:B5,rSAAM)-YY-xf^Xv{vZ(4$Co~VvDDDoxV]%h,?lP6Jk');
define('LOGGED_IN_SALT',   '2}x<Jif-3OZ+K;EcBb<wb0rL@{En|W]AEaJ2;}m])a7O.@ORXvC!D(g=#AGa?x?_');
define('NONCE_SALT',       'zNWaJ@(38XDdB+e$y0p?n5AHkOg.<>`br)&G/[JJyfSV~T:zU{_>1X]z=(/j./=N');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'catnmsplan_';

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
#define('WP_ALLOW_MULTISITE', true);
#define('FORCE_SSL_ADMIN', true);
#define('WP_CACHE', true);

define('FS_METHOD', 'ftpsockets');
define('FTP_HOST', 'localhost');
define('FTP_USER', 'kusanagi');
#define('FTP_PASS', '*****');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

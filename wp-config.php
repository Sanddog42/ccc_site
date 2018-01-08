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
define('DB_NAME', 'wordpress');

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
define('AUTH_KEY',         ']Y6k%R2!a}PcMHoJWFXu4K<ItNWg-o]2R5Sd{_h~ECJiemW98-^#_KJE)MRU4W%W');
define('SECURE_AUTH_KEY',  '1(C5B$Nb1}kQk-O([#=UGXN{OgwiB#QZHi=fF;dY3Wv5MB$!OdymF^EtM|tlJa`A');
define('LOGGED_IN_KEY',    'QJo6W[&{HNW3AZdSYezehsr/OWA7[cGOp5X-XM4I3Y%XP`LMax4)eqWQr$yeM8=i');
define('NONCE_KEY',        'VafEoTCfJHW*n?+?Lpx %!|Im6tu`20`BI8ja?@^lB`PeDz(jt[f17#}<f,OKtKj');
define('AUTH_SALT',        'P<yBS@Z6=eyo(qfoPx1i &on(yG`iUAO!sKmmvyFg;BLS1Z^4? tUl.&kkJaV8xv');
define('SECURE_AUTH_SALT', '/YR^*Y`c/k~<]HHSUL0ZNN//]E_Ln$]tXvc|k&?DTZ#g(? >J{%Z9Yt}B4P(r4l#');
define('LOGGED_IN_SALT',   'RI1d[Lx#6kyDO}w<>oJsoE.8p)d&N-6L64qeYQcJ(}pz]a0e5j(7n9~=~5!4Rx&n');
define('NONCE_SALT',       'aPs!^(,z)@=nG^Y#~kh0Pa..C7;steJrUn}ewxkZ4On;8T4Kw:Ro*stl,b,U6%f#');

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
define('WP_DEBUG', true);
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
define( 'SCRIPT_DEBUG', true );
define( 'SAVEQUERIES', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

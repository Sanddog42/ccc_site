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
define('AUTH_KEY',         'u}T)@YO:5]hOcXX_fmsmvVuGcEw^D2L-)xgdv_A*3Ff_k}+gu H<Ra-1F.l,IE W');
define('SECURE_AUTH_KEY',  '&aJ6)-Zwb.r9|/@7*V4E#M]<5<mRL{k3@}0@)g/yT8q$ad}W*_E6#+L2!@.:43AC');
define('LOGGED_IN_KEY',    'YnIJh@`8T{m+Q1PXhKogF<6->$E^u2dj.w21DQo:MX^Z():,0#A,/pb@d+94tO@R');
define('NONCE_KEY',        '[v&bK*W{T6NOXUggL+]aN>f~W@1:0BTFp<dPo7=T{RS:CWg2EdS6(%8u0E>VYv.l');
define('AUTH_SALT',        'UxU*wAOHQh2Z0qDMM(us=gj?9{-C& lV3y*3~78UJ0:=sl8{B%G~+}6bIcNuJ2`%');
define('SECURE_AUTH_SALT', 'X<Km!*?L(<`zl^tTd.jw`yw0&z3gAiXH}B>PPdFee2hiuj?p|Nf<c2x!k?$2Ip!y');
define('LOGGED_IN_SALT',   'mGZm{_X;o xTnOtH%V?] $fn7l~H(gV{5=vl7S/je7I1JH+a%n5ot*F]UWd![O*n');
define('NONCE_SALT',       '~AY!o81% (dVtzh<rC:-e sB|[Vp@x}ZL.T0GXU+Px176*DESW2W7bsQr[c<M5QE');

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

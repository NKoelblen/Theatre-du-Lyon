<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'theatredulyon' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'if9q<Dy]u(O7oIvL@0@%jh9XyM}(}@!fL4`//J[f!?l#I0Q0z8TrocWN2:un9cid' );
define( 'SECURE_AUTH_KEY',  '@h]<nI?]<m?)m8r~+Ki^{n)qo2d^C!7X*rmR*%kVUwe<Ox[&zB<sVwfLCq/M3@UK' );
define( 'LOGGED_IN_KEY',    'X3(r16GEh*#RWMBiS.f{m4c$ocE~[Gv/SeN;US^5n2P2!pU1z4m8o^N4]+#A[>`h' );
define( 'NONCE_KEY',        'Z[das4DJ|&xPCoL[)-rJh9)aeIN;F=-fSeylvI-.yHad$(z*ZY:0^)Znxy%w:mnr' );
define( 'AUTH_SALT',        'H.MPl=(-=(tee7~N.(+aJ;d!+J-*Uneq}>R#$2~o)#BW8Lv0u u@ArX]0]E+4w~-' );
define( 'SECURE_AUTH_SALT', '7/%11eKHGTCUaX 4UCIT_8$Wnz)o/O(n}L]3/N|2wp.)+:Tlyd67I=yv[yt!;!GQ' );
define( 'LOGGED_IN_SALT',   '2=~xps!)M R<OXuzwA@S6[y(5B7p+Ku5.l^OY=P+hc#ZO5UfHap,hokFJQk-K6`6' );
define( 'NONCE_SALT',       '>Jo<t%FO9^lU{yi9][6MVrq{U7MW65&Fn^,x9V]`-*E:kL.LmWf!wvl`T=6eZLgR' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

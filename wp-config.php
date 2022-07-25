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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         '/IC]g()8iL}rpTAS}odjwd5+VPE#<{;?9S{a&~MZMAm`;}X_[,@V=#0yX+E~R&Bt' );
define( 'SECURE_AUTH_KEY',  'pyz<THIlusGr{iqrxAkK;i0?D~.IyBI)D~!/P}@of1:MRS=Ki3x~iyyY$qc<m@*}' );
define( 'LOGGED_IN_KEY',    '[Zlas]q4jS8_6gJ!g{.DQg5noOyU<a4~3%?8b-L_76&aNY2e`9,TgVqJzWqmKguK' );
define( 'NONCE_KEY',        'JFP: b0LkLU6a)>1S9Bj8fgK5n$dcor&UcDOgeOhB-0zzizTqU@J7u#Q0zp~-9m-' );
define( 'AUTH_SALT',        'GB0^AzrE?SWVRJz]H>Q@RSV%CK;T{hwOkPD*RX]%^vxqOqP=:Ou@=(+n5eqHnP&*' );
define( 'SECURE_AUTH_SALT', 'x)>x9Pb_8BR/z$SosYfkUZ)w]4v|MfTz:Ue|9zjOL/~M&]]@{|ACn`VX:8_SG=[h' );
define( 'LOGGED_IN_SALT',   'tx^n<*`~r;MO>#ARREPEjc_@r2[uE$Kk}<,mY)}w.Y&Mq[|%tO54(Q.~(Uv!|VZ}' );
define( 'NONCE_SALT',       'KTP&& Q$s/eKY;@eObK)M8uobMk&WGmfhh]KtYRx@pKEIAPM,GT%{&(N]bE>-=zj' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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

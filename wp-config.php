<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'corretoradata' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         ' Ka5/?}xRiN7Rch2EET+UUxo+UKXn9)pb|L^&j?twBFzn]#a&i#eT^bUcrj+!vL7' );
define( 'SECURE_AUTH_KEY',  '=l{LrbQ^vEy;)K|j&eV FDstY/2kW(3C8o*LLi]A[@9&6!+K/IR;@y`^vrWR#<5u' );
define( 'LOGGED_IN_KEY',    '.WUPMzYA}n-DR%ZJzzPv&MtYE<[LvVRWd]h67%]-Z7uVO<-`ul`c`yR~{Xs6A 0_' );
define( 'NONCE_KEY',        'QtQ7mp#RVx [P2yyeG)EjI.NaC7{:c]s {@a|YP#/WW7T|-~F3R64zlq/CJvF/PL' );
define( 'AUTH_SALT',        'z@}HyCNdaj`W-(%C,t`qT85iVQ}6]u#.jjXgx$vp~K]4uIBlQa%;=wUb4yoKI[#Q' );
define( 'SECURE_AUTH_SALT', '.%2yE)9g=`k5%U;eM?PX43>*$/+mLn_S!,T6p0^c7*X.(Vx3V`:)Vio-+32|7n{O' );
define( 'LOGGED_IN_SALT',   'oGsms+Pxh-hkY}+j%1P%s:jWz?WZ+SxWhh~K*x*-@~L[_/NS4qHVfpch.>l>6v#|' );
define( 'NONCE_SALT',       'xLN?3y0R1_>Ha#8&GXU:`ynu)&!jJ 4CV8vyYkB{z@:p?rw*Pl:`]gXT]dpw)q.D' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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

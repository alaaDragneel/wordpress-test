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
define('DB_NAME', 'wordpress-test');

/** MySQL database username */
define('DB_USER', 'alaa');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '8,zwh]=jZ@WrT|&$1r%`3wf58RGF`3LB(l>FhU qRu&=^2!N5H9Mx:znJ5}f}BbW');
define('SECURE_AUTH_KEY',  'O)3KJAk8B_ZLd-Z-W7tEJ?gs,Cg@_q@5bWd%{G_kS!D!W}[_/ BL&$!rejA#?TXO');
define('LOGGED_IN_KEY',    'S~2zU?8?0_WpM5$Q.AMEGB~pFlToOh{kj?:88ALS`t|3</x/Ybe9_Z^x[&-pdY:l');
define('NONCE_KEY',        'rGF.&[>s)1}rnPAj}35c{}]W{W5InZKJ2FLoK$.J *iT8w-8SQXT~CVX^Pww%<{s');
define('AUTH_SALT',        ' ~6gsJ)h=xY>TGT)U$u!28MiVw.c$TA^.i-[jVo~6eCh[6G#e,RQHO(-BXt+EiI/');
define('SECURE_AUTH_SALT', ',}_&P+Vg:e3m~~vRF[K~slJY^yr?/&H@2ti{h 3B]G=cE(/Uu,P32Ud70=x<rnuI');
define('LOGGED_IN_SALT',   '<%^T3YRyDeOBz#)VSE,,?{I<{c3S3^G&FYB{`2&joidn,hi|ch1a<ZB2<H#rsoG.');
define('NONCE_SALT',       'l!D`N (v@of*RQ^ZpG-{gRF,6Seh!~XtT5UU%l/.x<Ft99B:;~%QYm-}A|wWN|>{');

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

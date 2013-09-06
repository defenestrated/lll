<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'lll');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'PPV=&=4]M~75W:q}XC|]7R]|c>@Hcx%k e/x=cz{R$BxuL2#Ehl0<S4S$ =MsGt0');
define('SECURE_AUTH_KEY',  ';O&Q=@3MU qGS(K7oSEvBpNNM+0G<`]~J*LJ|SL{K`ki=031pyw$_il+^TaRtvYV');
define('LOGGED_IN_KEY',    'S/vk)/=+-S@N|QC&I}(VdGDMwvl.?Ocj0ad(;6Oei>#VBN}IMOU7qI<fNQ4KI`vP');
define('NONCE_KEY',        '=/fW`zNy- auQ]7sQ1<SQd;U-6LwbcYI4Myo dx`&$RMR[8a`K@)AjINdS0k+SO=');
define('AUTH_SALT',        'd^Czr>@sJu[H&fV}GX7WzL&sh0$p$!qMZbB)8qp1b/j{GP{L^+E/vEa`mSe0E|O*');
define('SECURE_AUTH_SALT', 'nBhP)#u?Y[XdXRI6AzABNrpfIFlOfZ_{p%:NGh^/_ifY<0jg[_(7[Rfh9F8&jy<Q');
define('LOGGED_IN_SALT',   '6$Gvx _|$I1uS[=zNqOG:oso69=>J L/KMhN-6c[wLq.[v<&y.3=%2ccx|.Y[vyt');
define('NONCE_SALT',       '6a]x>$4mkt=-+Q{ZX49=n`b5Mry^Lt,G!8RDy8JtL8`&dqqD@uBP>i2aHu|/!8HG');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

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
define('DB_NAME', 'estore');

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
define('AUTH_KEY',         'h+-^>C^M7,gJ|>@8kCCy|R${8=`Z_-$Q-m!}]m]ww|%Xp~ysy?%SK1~t&@(mIS45');
define('SECURE_AUTH_KEY',  'MD,u9NL`|N0xx}C8e$,4B*+?HZ*KXJwlK#L+Tl}lrWakC5E@_7NU&YFtTDl)o_X/');
define('LOGGED_IN_KEY',    'R8O~6~?Ew+*nV<=foArho$R*M-drx/(9Bg<>2pz0jThjGL7<fz*B)nkF.hmG)a1l');
define('NONCE_KEY',        '._w;D371Y1klkjV<R4mp|T5*o5&a</GccR9>[J?eQBS.&gR:Kw1H{dG3S_xe~IM,');
define('AUTH_SALT',        'J#jUu3UAo/L+NcLZ$ohYqJ-jwKpArH^(JK8{^HWmO) p,8h#%lO^?Kh AW8{&90+');
define('SECURE_AUTH_SALT', 'tz`Xvf|fNG-owJL%U580PBTsyf>*WA(_L#&{MjC9D~Xs<nb}@rn/$97h:c!/aF5r');
define('LOGGED_IN_SALT',   'm|>r,`z`liDg;k[KE2Fp-=ng(ypsvx5^XvUJYIM6V9F9)S:BQxWKvkv{B1+HB3*n');
define('NONCE_SALT',       '^rh5;:!rm~<o2uzC |_i<=i3+5{2QrEN=oGn:<KcRw(ApYNn(~c}-}KLFeL}+yU)');

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


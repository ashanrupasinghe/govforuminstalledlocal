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
define('DB_NAME', 'govtfactory');

/** MySQL database username */
define('DB_USER', 'root');

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
define('AUTH_KEY',         '^,-O{tD1](zD08GlZQ*J8A2K5fUk9jJO.CEPk-zY+)ub!qxomHnqorEu-0B|ira^');
define('SECURE_AUTH_KEY',  'PLO;0GP@h-q5h-B k(x.sbS{a%)N21>attkl+W<{h|QWa~/T47+-h^z@9a_MQ+%j');
define('LOGGED_IN_KEY',    '-%fz`qJtcH>(X,w#sg2Y8L<+M+7r:{>u(x(VmXyY7-(}]qLwNVlUxc4Pmb[y2Q~v');
define('NONCE_KEY',        'FY{`t#CgW,Url(V.FZ2^QcS:6<:-f*k,x1/|KNLD-G}(c$Y(XsmqjjPEY-*W!Qw+');
define('AUTH_SALT',        'Q@-pRI8+--gwLn#EN2I5ewzpQ0M`Ea ^Uc;xK+Xj!]c%-d,^sE7fjg.]|a>|+ReV');
define('SECURE_AUTH_SALT', '!q_|wX{vu2 _|FhnH)YwvCUpPvI4]0@V|#ybd3I>Laaw-GZ=]=f>|Ca[ `;8nLx.');
define('LOGGED_IN_SALT',   'qsd+>-81HK-?H;X7Ns?BAb#e?Y|_{Gie`6xHBW^,j|Cr@1Xc=>/D6|W[X_xowq$n');
define('NONCE_SALT',       '51.A,|i!_B8aPX$J-wUECNZTWH8^=2OWW&rZkNK|;C66+-Q`Ne$RzqQ6h|u2rA^Q');

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

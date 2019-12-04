<?php
/**
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define( 'DB_NAME', 'wordpress' );

/** Tu nombre de usuario de MySQL */
define( 'DB_USER', 'wpadmin' );

/** Tu contraseña de MySQL */
define( 'DB_PASSWORD', 'wpadmin' );

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define( 'DB_HOST', 'localhost' );

/** Codificación de caracteres para la base de datos. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY', 'bLBq=(x:.jnH!Xy8_v`e^@+C~2=BoX/yL=o6q)&l3H&{smm&vsPjORF51DxFb*B5' );
define( 'SECURE_AUTH_KEY', '*7b8kfQ}mdksRyd@iIuTF^wI_((mM#de.lOe%^%WKt0bx|GCn<UO`EfDZMhSx/3v' );
define( 'LOGGED_IN_KEY', 'H.X1c?;`b!VQLV`.*w2Ps(yay$JMR^K@Sv<-OSh2Vpo}H66gu&~``BR;K2EzXi(v' );
define( 'NONCE_KEY', 'KQ+#/:ZbD%c;jQDq|l+giy-+fUWh(gACWI<B@iih?[bP68AL!# y-GVr!}Dz<@yG' );
define( 'AUTH_SALT', '`Zu%L<@wlneh{z4@)B4!x&#}:-m#/Wmif]r43onOM}HnexISDY41CoT8oWE!Hd]m' );
define( 'SECURE_AUTH_SALT', 'G2_~U#rnHkJN<i,B#1NT{!xcs3EN[%-fPabN)-s,-g^6^mkUaSnNUZo^D%(svJi_' );
define( 'LOGGED_IN_SALT', 'Cl[D:2GXYF[+dJY(`WxmM/y!@Dw5:R+h;GT=bOY_(FhDPMbG7>K/IU}h19bIe~)x' );
define( 'NONCE_SALT', 'DKchu@d<S,1)f9qGYKj= ~,<crq*ik<o)yqTA Ns^(}~wR|-uX. ~)OvWs#+E8F<' );

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');



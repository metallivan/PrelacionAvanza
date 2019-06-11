<?php

/***************************************************************************
 *
 *	Nombre:	default.php
 *   	Este archivo, es comun para las pï¿½ginas.
 * 	En el se encuentran aspectos de seguridad, y de configuracion del sitio
 *
 ***************************************************************************/

// Archivos comunes usados por cada pï¿½gina.
include ("database.php");
// Protege contra hackeos usando variables globales
if (isset($HTTP_POST_VARS['GLOBALS']) || isset($HTTP_POST_FILES['GLOBALS']) ||
	isset($HTTP_GET_VARS['GLOBALS']) || isset($HTTP_COOKIE_VARS['GLOBALS'])) {
	die("Intento de hackeo");
}

// Protege contra hackeos usando variables de sesiï¿½n
if (isset($HTTP_SESSION_VARS) && !is_array($HTTP_SESSION_VARS)) {
	die("Intento de Hackeo");
}

$client_ip = ( !empty($HTTP_SERVER_VARS['REMOTE_ADDR']) ) ? $HTTP_SERVER_VARS['REMOTE_ADDR'] :
			 ( ( !empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );
//$user_ip = encode_ip($client_ip);


$base_datos			= new sql_db("localhost", "lautaro_db_lautaro_rosas_web", "lautaro_codde", "123codde");
//$base_datos			= new sql_db("localhost", "db_lautaro_rosas_web", "root", "");
mysql_query("SET NAMES 'utf8'");

?>
<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'connection'  => array(
			'dsn'        => 'mysql:host=127.0.0.1;dbname='.$_SERVER['DB1_NAME'],
			'username'   => $_SERVER['DB1_USER'],
			'password'   => $_SERVER['DB1_PASS'],
		),
	),
);

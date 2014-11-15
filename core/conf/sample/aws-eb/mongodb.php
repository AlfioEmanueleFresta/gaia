<?php

/**
 * (c)2014 Croce Rossa Italiana
 */

// Configurazione MongoDB
$conf['mongodb'] = [
	'connection'	=>	'mongodb://' . getenv('MONGODB_HOST') . ':' . getenv('MONGODB_PORT'),
	'database'		=>	getenv('MONGODB_DBNAME'),
	'options'		=>	[
		'connect'	=>	true
	]
];

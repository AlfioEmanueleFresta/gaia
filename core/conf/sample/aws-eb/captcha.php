<?php

/*
 * (c)2013 Croce Rossa Italiana
 */

/*
 * Configurazione SweetCaptcha
 * ============================
 * 1. Andare su http://sweetcaptcha.com/ ed ottenere una coppia di chiavi per il sito
 * 2. Inserire qui la coppia di chiavi ottenute
 * 3. Enjoy!
 */

$conf['sweetcaptcha'] = [
	'SWEETCAPTCHA_APP_ID' 		=> getenv('SWEETCAPTCHA_APP_ID'), // your application id (change me)
	'SWEETCAPTCHA_KEY' 			=> getenv('SWEETCAPTCHA_KEY'), // your application key (change me)
	'SWEETCAPTCHA_SECRET'		=> getenv('SWEETCAPTCHA_SECRET'), // your application secret (change me)
	'SWEETCAPTCHA_PUBLIC_URL'	=> 'core/libs/sweetcaptcha.php' // public http url to this file
];

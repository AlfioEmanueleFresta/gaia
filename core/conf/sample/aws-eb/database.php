<?php
 
/*
 * ©2012 Croce Rossa Italiana
 */

/*
 * === INSTALLAZIONE DI GAIA ===
 * Questa è una configurazione di esempio per Gaia.
 * 1. Copiare il file in /core/conf/database.conf.php.
 * 2. Modificare DATABASE_NAME, DATABASE_USER e DATABASE_PASSWORD.
 */
 
/* Configurazione del database */
$conf['database'] = [
 
    'dns'   =>  'mysql:host=' . getenv('RDS_HOSTNAME') . ';port=' . getenv('RDS_PORT') . ';dbname=' . getenv('RDS_DB_NAME'),
    'user'  =>  getenv('RDS_USERNAME'),
    'pass'  =>  getenv('RDS_PASSWORD'),
    
    /* Connessione persistente? */
    'persistent'    =>  true
 
];
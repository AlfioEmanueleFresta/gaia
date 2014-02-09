<?php

/*
 * ©2014 Croce Rossa Italiana
 */

/** 
 * CONFIGURAZIONE ERRORI AMICHEVOLI
 */
// Ignora errori che ricadono sotto...
define('ERRORIAMICHEVOLI_MINIMO', E_USER_NOTICE); 


/**
 * MESSAGGI DI ERRORE 
 */
$conf['errori'] = [
    1000    =>  'Errore non documentato - fare riferimento al supporto tecnico',
    1001    =>  'Errore nello stabilire una connessione al database',
    1002    =>  'Errore nella gestione della cache delle entita',
    1003    =>  'Entità non presente (tabella:id) => ',
    1004    =>	'Metodo API non trovato, fare riferimento alla documentazione',
    1009    =>  'Impossibile debuggare, non autorizzato',
    1010    =>  'Autenticazione necessaria',
    1011    =>  'Almeno un parametro richiesto non e\' stato specificato',
    1012    =>  'Template della mail non presente',
    1013	=>	'Oggetto di tipo non autorizzato',
	1014	=>	'API KEY non valida, disattiva, oppure limite richieste giornaliero superato',
    1015    =>  'Nessuna delegazione selezionata o delegazione non valida',
    1016    =>  'Accesso negato: Nessun permesso di accesso al ramo specificato'
];
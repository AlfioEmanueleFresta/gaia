<?php

/*
 * ©2012 Croce Rossa Italiana
 */

paginaPrivata();

if ( $me->login($_POST['inputOldPassword']) == false){
	redirect('utente.password&ee');
}

if ( strlen($_POST['inputPassword']) < 8 || strlen($_POST['inputPassword']) > 15 ) {
	redirect('utente.password&e');
}

if ($_POST['inputPassword'] != $_POST['inputPassword2']){
	redirect('utente.password&en');
}

$password     = $_POST['inputPassword'];
$sessione->utente()->cambiaPassword($password);

/* Invia la mail */
$m = new Email('cambioPassword', 'Cambio password su Gaia');
$m->a = $sessione->utente();
$m->_NOME       = $sessione->utente()->nome;
$m->_PASSWORD   = $password;
$m->invia();

redirect('utente.password&ok');

<?php

/*
 * ©2012 Croce Rossa Italiana
 */

$parametri = array('inputEmail', 'inputPassword');
controllaParametri($parametri, 'login');

$email      = minuscolo($_POST['inputEmail']);
$password   = $_POST['inputPassword'];

if ( $u = Utente::by('email', $email) ) {
    if ( $u->login($password) ) {
        $sessione->utente = $u->id;
        $u->ultimoAccesso = time();
        if ( $_POST['torna'] ) {
            lowRedirect($_POST['torna']);
        } else {
            redirect('utente.me');
        }
    } else {
        $sessione->torna = $_POST['torna'];
        redirect('login&password');
    }
} else {
    $sessione->torna = $_POST['torna'];
    redirect('login&email');
}
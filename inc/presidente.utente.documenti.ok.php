<?php

/*
 * ©2013 Croce Rossa Italiana
 */

paginaApp([APP_SOCI, APP_PRESIDENTE]);

controllaParametri(['id', 'tipo'], 'presidente.utenti&errGen');

$id = $_GET['id']; 
$u = Utente::id($id);
$hoPotere = $u->modificabileDa($me);

proteggiDatiSensibili($u, [APP_SOCI, APP_PRESIDENTE]);

$t = $_POST['tipo'];
$f = $_FILES['file'];

/* Qual è il vecchio documento? */
$prec = $u->documento($t);

try {
    $d = new Documento();
    $d->volontario = $u->id;
    $d->tipo = $t;
    $d->caricaFile($f);
} catch (Exception $e) {
    $d->cancella();
    redirect("presidente.utente.visualizza&id={$u->id}&errDoc");
}

/* Cancella il vecchio documento... */
if ( $prec ) {
    $prec->cancella();
}

redirect("presidente.utente.visualizza&id={$u->id}");
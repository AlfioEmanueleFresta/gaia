<?php

/*
 * ©2014 Croce Rossa Italiana
 */

paginaApp([APP_PRESIDENTE, APP_FARMACIA]);
controllaParametri(array('id'), 'farmacia.farmaci&err');
$t = $_GET['id'];

$t = Farmaco::id($t);
$t->tipo    = $_POST['inputTipo'];
$t->nome    = maiuscolo( $_POST['inputNome'] );
$t->pAttivo     = maiuscolo( $_POST['inputPrincipio'] );
$t->barcode = $_POST['inputBarcode'];
   
redirect('farmacia.farmaci&mod');

<?php

/*
 * ©2014 Croce Rossa Italiana
 */

paginaApp([APP_PRESIDENTE, APP_FARMACIA]);
/*$parametri = array('inputNome', 'inputTipo', 'inputBarcode');
controllaParametri($parametri, 'farmacia.farmaco.nuovo&err');*/

$x = Farmaco::by('nome', $_POST['inputNome']);
if (!$x){
    $t = new Farmaco();
    $t->tipo 		= $_POST['inputTipo'];
    $t->nome 		= maiuscolo( $_POST['inputNome'] );
    $t->pAttivo     = maiuscolo( $_POST['inputPrincipio'] );
    $t->barcode 	= $_POST['inputBarcode'];
    $t->pConferma 	= $me;
    $t->tConferma	= time();
    $t->timestamp 	= time();

    redirect('farmacia.farmaci&new');
}else{
    
    redirect('farmacia.farmaci&dup');
}

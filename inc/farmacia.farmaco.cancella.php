<?php

/*
 * ©2014 Croce Rossa Italiana
 */

paginaApp([APP_PRESIDENTE, APP_FARMACIA]);
if(!$presidente && $me->appartenenzaAttuale()->comitato()->regionale()!='1' ){
    redirect("errore.permessi");
}

controllaParametri(array('id'), 'farmacia.farmaci&err');
$t = $_GET['id'];
$f = Farmaco::id($t);
/*
$tp = TitoloPersonale::filtra([['titolo', $f]]);
foreach ( $tp as $_tp ){
    $_tp->cancella();
}*/
$f->cancella();

redirect('farmacia.farmaci&del');

?>

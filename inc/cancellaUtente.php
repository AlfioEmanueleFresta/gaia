<?php

/*
 * ©2012 Croce Rossa Italiana
 */

paginaPrivata();

$t = $_GET['id'];
$f = Appartenenza::filtra([
  ['volontario', $t]
]);
$f[0]->cancella();
$f = TitoloPersonale::filtra([
  ['volontario', $t]
]);
for ($i = 0, $ff = count($f); $i < $ff;$i++) {
    $f[$i]->cancella();
}
$t = new Persona($t);
$t->cancella();

redirect('admin.listaUtenti&ok');

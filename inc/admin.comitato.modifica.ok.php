<?php

/*
 * ©2013 Croce Rossa Italiana
 */

$c = $_GET['oid'];
$c = GeoPolitica::daOid($c);

paginaAdmin();

$c->nome        =   normalizzaNome($_POST['inputNome']);

redirect('admin.comitati');

?>

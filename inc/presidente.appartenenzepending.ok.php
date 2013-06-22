<?php

/*
 * ©2012 Croce Rossa Italiana
 */

paginaPrivata();

$id     = $_GET['id'];
$a = Appartenenza::by('id', $id); /* Qui col by */

if (isset($_GET['si'])) {
    $a->timestamp = time();
    $a->stato     = MEMBRO_VOLONTARIO;
    $a->conferma  = $me->id;    
    $m = new Email('appartenenzacomitato', 'Conferma appartenenza: ' . $a->comitato()->nome);
    $m->da = $me; 
    $m->a = $a->volontario();
    $m->_NOME       = $a->volontario()->nome;
    $m->_COMITATO   = $a->comitato()->nome;
    $m->invia();
    redirect('presidente.appartenenzepending&app');
}elseif(isset($_GET['no'])){
    $m = new Email('negazionecomitato', 'Negazione appartenenza: ' . $a->comitato()->nome);
    $m->da = $me; 
    $m->a = $a->volontario();
    $m->_NOME       = $a->volontario()->nome;
    $m->_COMITATO   = $a->comitato()->nome;
    $m->invia();
    $v= $a->volontario()->id;
    $a = Appartenenza::filtra(['volontario', $v]);
    foreach($a as $_a){
    $_a->cancella();    
    }
    
    $f = TitoloPersonale::filtra([
    ['volontario', $v]
    ]);
    
    foreach ($f as $_f) {
        $_f->cancella();
    }
    
    $v = new Volontario($v);
    $v->cancella();
    redirect('presidente.appartenenzepending&neg');
}
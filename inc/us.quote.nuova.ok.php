<?php

/*
 * ©2013 Croce Rossa Italiana
 */


$parametri = ['vol', 'inputImporto', 'inputData'];
controllaParametri($parametri, 'us.dash&err');


$v = Utente::id($_POST['vol']);

proteggiDatiSensibili($v, [APP_SOCI , APP_PRESIDENTE]);

if (!$t = Tesseramento::attivo()) {
  redirect('us.quoteNo&err');
}

$importo = (float) $_POST['inputImporto'];
$importo = round($importo, 2);
$attivo = false;

if($v->stato == VOLONTARIO) {
	$attivo = true;
}
$quotaMin = $attivo ? $t->attivo : $t->ordinario;

if ($importo < $quotaMin) {
    redirect('us.quote.nuova&id='.$id.'&importo');
}

$app = $v->appartenenzaAttuale();

$quotaBen = $quotaMin + (float) $app->comitato()->quotaBenemeriti();

$anno = date('Y');

/* Controllo se gà vi è una quota pagata per l'anno in corso */
$gia = Quota::filtra([['appartenenza', $app],['anno', $anno]]);

foreach ($gia as $_g) {
	if (!$_g->annullata())
		redirect('us.quoteNo&gia');
}

$time = DT::createFromFormat('d/m/Y', $_POST['inputData']);

$q = new Quota();
$q->appartenenza 	= $app;
$q->timestamp 		= $time->getTimestamp();
$q->tConferma 		= time();
$q->pConferma 		= $me;
$q->anno 			= $anno;
$q->quota 			= $importo;

$causale = 'Rinnovo quota '.$anno;
if ($importo > $quotaBen) {
	$q->benemerito = BENEMERITO_SI;
	$causale = $causale . ". Promozione a socio benemerito per l'anno " . $anno . " per il versamento di una quota superiore a " . soldi($quotaBen) . " &#0128;.";
}

$q->causale 		= $causale;
$q->assegnaProgressivo();


$p = new PDF('ricevutaquota', 'ricevuta.pdf');
$p->_COMITATO 	= $app->comitato()->locale()->nomeCompleto();
$p->_INDIRIZZO 	= $app->comitato()->locale()->formattato;
$p->_PIVA 		= $app->comitato()->piva();
$p->_ID 		= $q->progressivo();
$p->_NOME 		= $v->nome;
$p->_COGNOME 	= $v->cognome;
$p->_FISCALE 	= $v->codiceFiscale;
$p->_NASCITA 	= date('d/m/Y', $v->dataNascita);
$p->_LUOGO 		= $v->luogoNascita;
$p->_IMPORTO    = soldi($q->quota - ($q->quota - $quotaMin));
$p->_QUOTA      = $q->causale;
if ($q->quota - $quotaMin > 0) {
    $p->_OFFERTA    = 'Offerta';
    $p->_OFFERIMPORTO = solfi($q->quota - $quotaMin) . "  &#0128; ";
} else {
	$p->_OFFERTA    = '';
    $p->_OFFERIMPORTO = '';
}
$p->_TOTALE     = soldi($q->quota);
$p->_LUOGO 		= $app->comitato()->locale()->comune;
$p->_DATA 		= date('d-m-Y', time());
$p->_CHINOME	= $me->nomeCompleto();
$p->_CHICF		= $me->codiceFiscale;
$f = $p->salvaFile();                                


/* Invio ricevuta all'utente */

$m = new Email('ricevutaQuota', 'Ricevuta versamento Quota');
$m->a 		= $v;
$m->da 		= $me;
$m->_NOME 	= $v->nome;
$m->allega($f);
$m->invia();

redirect('us.quoteNo&ok');

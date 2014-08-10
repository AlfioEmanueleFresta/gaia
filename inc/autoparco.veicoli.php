<?php

/*
 * ©2014 Croce Rossa Italiana
 */

paginaApp([APP_AUTOPARCO , APP_PRESIDENTE]);

?>
<?php if ( isset($_GET['new']) ) { ?>
    <div class="alert alert-success">
        <i class="icon-save"></i> <strong>Veicolo aggiunto</strong>.
        Il Veicolo è stato aggiunto con successo.
    </div>
<?php } elseif ( isset($_GET['del']) )  { ?>
    <div class="alert alert-block alert-error">
        <i class="icon-exclamation-sign"></i> <strong>Veicolo cancellato</strong>
        Il Veicolo è stato cancellato con successo.
    </div>
<?php }elseif ( isset($_GET['dup']) ) { ?>
    <div class="alert alert-error">
        <i class="icon-warning-sign"></i> <strong>Veicolo presente</strong>.
        Il Veicolo è già presente in elenco.
    </div>
<?php } elseif ( isset($_GET['mod']) )  { ?>
    <div class="alert alert-block alert-success">
        <i class="icon-edit"></i> <strong>Veicolo modificato</strong>
        Il Veicolo è stato modificato con successo.
    </div>
<?php } elseif ( isset($_GET['regFT']) ) { ?>
    <div class="alert alert-success">
        <i class="icon-ok"></i> <strong>Fermo tecnico registrato</strong>.
        Il fermo tecnico è stato registrato con successo
    </div>
<?php } elseif ( isset($_GET['outFT']) ) { ?>
    <div class="alert alert-success">
        <i class="icon-ok"></i> <strong>Veicolo nuovamente attivo</strong>.
        Il veicolo è uscito dal fermo tecnico
    </div>
<?php }elseif ( isset($_GET['manOk']) ) { ?>
    <div class="alert alert-success">
        <i class="icon-ok"></i> <strong>Intervento di manutenzione registrato e veicolo nuovamente attivo</strong>.
        E' stata registrata una manutenzione ed il veicolo è uscito dal fermo tecnico
    </div>
<?php } ?>
<?php if (isset($_GET['err'])) { ?>
    <div class="alert alert-block alert-error">
        <h4><i class="icon-warning-sign"></i> <strong>Qualcosa non ha funzionato</strong>.</h4>
        <p>L'operazione che stavi tentando di eseguire non è andata a buon fine. Per favore riprova.</p>
    </div> 
<?php } ?>
<script type="text/javascript"><?php require './js/presidente.utenti.js'; ?></script>
<br/>
<div class="row-fluid">
    <div class="span4">
        <h2>
            <i class="icon-truck muted"></i>
            Veicoli
        </h2>
    </div>

    <div class="span4">
        <div class="btn-group btn-group-vertical span12">
            <a href="?p=autoparco.dash" class="btn btn-block ">
                <i class="icon-reply"></i> Torna alla dash
            </a>
        </div>
    </div>
    
    <div class="span4 allinea-destra">
        <div class="input-prepend">
            <span class="add-on"><i class="icon-search"></i></span>
            <input autofocus required id="cercaUtente" placeholder="Cerca Veicolo..." type="text">
        </div>
        <a class="btn btn-success" href="?p=autoparco.veicolo.nuovo">
            <i class="icon-plus"></i> Aggiungi Veicolo
        </a>
    </div>  
    <br/>
</div>

<hr />

<div class="row-fluid">
    <div class="span12">
        <table class="table table-striped table-bordered table-condensed" id="tabellaUtenti">
            <thead>
                <th>Targa</th>
                <th>Destinazione ed uso</th>
                <!--<th>Km Attuali</th>
                <th>Consumo Medio</th>-->
                <th>Collocazione</th>
                <th>Fermo tecnico</th>
                <th>Azioni</th>
            </thead>
            <?php
            $comitati = $me->comitatiApp([APP_PRESIDENTE,APP_AUTOPARCO],false);
            foreach ( $comitati as $comitato ){
                foreach(Veicolo::filtra([['comitato', $comitato->oid()],['stato', VEI_ATTIVO]],'targa ASC') as $veicolo){
                    ?>
                    <tr>
                        <td><?= $veicolo->targa; ?></td>
                        <td><?= $veicolo->uso; ?></td>
                        <!--<td><?= "in sviluppo"; ?></td>
                        <td><?= "in sviluppo"; ?></td>-->
                        <td><?= $veicolo->collocazione(); ?></td>
                        <td><?= $veicolo->fermoTecnicoDettagli(); ?></td>
                        <td>
                            <div class="btn-group">
                                <a  href="?p=autoparco.veicolo.dettagli&id=<?= $veicolo->id; ?>" title="Visualizza dettagli veicolo" class="btn btn-small">
                                    <i class="icon-eye-open"></i> Dettagli
                                </a>
                                <a  href="?p=autoparco.veicolo.fermotecnico&id=<?= $veicolo->id; ?>" title="Fermo tecnico Veicolo" class="btn btn-small btn-warning">
                                    <i class="icon-unlink"></i> Fermo tecnico
                                </a>
                                <a  href="?p=autoparco.veicolo.colloca&id=<?= $veicolo->id; ?>" title="Colloca Veicolo" class="btn btn-small btn-primary">
                                    <i class="icon-arrow-right"></i> Collocazione
                                </a>
                                <a  href="?p=autoparco.veicolo.manutenzione&id=<?= $veicolo->id; ?>" title="Manutenzione Veicolo" class="btn btn-small btn-success">
                                    <i class="icon-wrench"></i> Manutenzione
                                </a>
                                <?php if ( $me->admin() ) { ?>
                                    <a  onClick="return confirm('Vuoi veramente cancellare questo veicolo ?');" href="?p=autoparco.veicolo.cancella&id=<?= $veicolo->id; ?>" title="Cancella Veicolo" class="btn btn-small btn-danger">
                                        <i class="icon-trash"></i> Cancella
                                    </a>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                <?php } }?>
        </table>
    </div>
</div>
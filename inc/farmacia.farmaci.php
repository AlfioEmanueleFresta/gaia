<?php

/*
 * ©2014 Croce Rossa Italiana
 */

paginaApp([APP_PRESIDENTE, APP_FARMACIA]);
if(!$presidente && $me->appartenenzaAttuale()->comitato()->regionale()!='1' ){
    redirect("errore.permessi");
}

?>

<?php if ( isset($_GET['new']) ) { ?>
    <div class="alert alert-success">
        <i class="icon-save"></i> <strong>Farmaco aggiunto</strong>.
        Il farmaco è stato aggiunto con successo.
    </div>
<?php } elseif ( isset($_GET['del']) )  { ?>
    <div class="alert alert-block alert-error">
        <i class="icon-exclamation-sign"></i> <strong>Farmaco cancellato</strong>
        Il farmaco è stato cancellato con successo.
    </div>
<?php }elseif ( isset($_GET['dup']) ) { ?>
    <div class="alert alert-error">
        <i class="icon-warning-sign"></i> <strong>Farmaco presente</strong>.
        Il farmaco è già presente in elenco.
    </div>
<?php } elseif ( isset($_GET['mod']) )  { ?>
    <div class="alert alert-block alert-success">
        <i class="icon-edit"></i> <strong>Farmaco modificato</strong>
        Il farmaco è stato modificato con successo.
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
    <div class="span8">
        <h2>
            <i class="icon-certificate muted"></i>
            Elenco Farmaci
        </h2>
    </div>
    
    <div class="span4 allinea-destra">
        <div class="input-prepend">
            <span class="add-on"><i class="icon-search"></i></span>
            <input autofocus required id="cercaUtente" placeholder="Cerca farmaco..." type="text">
        </div>
    </div>  
    <br/>  
    <div class="span4 allinea-destra">
        <a class="btn btn-success" href="?p=farmacia.farmaco.nuovo">
            <i class="icon-plus"></i> Aggiungi farmaco
        </a>
    </div> 
</div>

<hr />

<div class="row-fluid">
 <div class="span12">
     <table class="table table-striped table-bordered table-condensed" id="tabellaUtenti">
        <thead>
            <th>Descrizione</th>
            <th>Principio Attivo</th>
            <th>Tipo</th>
            <th>Barcode</th>
            <th>Azioni</th>
        </thead>
        <?php
        foreach(Farmaco::elenco('nome ASC') as $c){
            ?>
            <tr>
                <td><?php echo $c->nome; ?></td>
                <td><?php echo $c->pAttivo; ?></td>
                <td><?php echo($conf['farmaci'][$c->tipo]); ?></td>
                <td><?php echo $c->barcode; ?></td>
                <td>
                    <div class="btn-group">
                        <a  onClick="return confirm('Vuoi veramente cancellare questo farmaco ?');" href="?p=farmacia.farmaco.cancella&id=<?php echo $c->id; ?>" title="Cancella Farmaco" class="btn btn-small btn-warning">
                            <i class="icon-trash"></i> Cancella
                        </a>
                        <a  href="?p=farmacia.farmaco.modifica&id=<?php echo $c->id; ?>" title="Modifica Farmaco" class="btn btn-small btn-info">
                            <i class="icon-edit"></i> Modifica
                        </a>
                    </div>
                </td>
            </tr>
            
            <?php }
            
            ?>
        </table>
    </div>
</div>
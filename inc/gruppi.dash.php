<?php

/*
 * ©2013 Croce Rossa Italiana
 */

?>
<script type="text/javascript"><?php require './js/presidente.utenti.js'; ?></script>
<br/>
<div class="row-fluid">
    <div class="span12">
        <?php if ( isset($_GET['newref']) ) { ?>
            <div class="alert alert-success">
                <i class="icon-save"></i> <strong>Nuovo referente nominato</strong>.
                Il volontario è stato nominato con successo come referente del gruppo.
            </div>
        <?php } ?>
        <?php if ( isset($_GET['ok']) ) { ?>
            <div class="alert alert-success">
                <i class="icon-save"></i> <strong>Modifiche effettuate</strong>.
                Le modifiche sono state effettuate con successo.
            </div>
        <?php } ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span5 allinea-sinistra">
        <h2>
            <i class="icon-group muted"></i>
            Elenco gruppi
        </h2>
    </div>
    <div class="span3 allinea-centro">
                <div class="btn-group btn-group-vertical span12">
                        <a href="?p=utente.gruppo" class="btn btn-block">
                            <i class="icon-reply"></i>
                            Torna ai Gruppi
                        </a>
                </div>
            </div>
    <div class="span4 allinea-destra">
        <div class="input-prepend">
            <span class="add-on"><i class="icon-search"></i></span>
            <input autofocus required id="cercaUtente" placeholder="Cerca Volontari..." type="text">
        </div>
    </div>    
</div>

<?php

/*
 * il presidente vede tutti i gruppi del suo comitato, il referente il gruppo di cui è referente
 */

$gruppi = $me->gruppiDiCompetenza();

if ( isset($_GET['cancellato'] ) ) {
    ?>
    <div class="alert alert-success">
        <i class="icon-trash"></i> Gruppo cancellato con successo
    </div>
    <?php
}
?>
 <table class="table table-striped table-bordered table-condensed" id="tabellaUtenti">
            <thead>
                <th>Cognome</th>
                <th>Nome</th>
                <th>Cellulare</th>
                <th>Azioni</th>
            </thead>
<?php
foreach ($gruppi as $gruppo){
        $g = $gruppo->membri();
    ?>
        <tr class="success">
                    <td colspan="7" class="grassetto">
                            <?php echo $gruppo->nome; ?>
                            <span class="label label-warning">
                                <?= count($g); ?>
                            </span>
                                <a class="btn btn-success btn-small pull-right" href="?p=utente.mail.nuova&id=<?= $gruppo->id; ?>&gruppo">
                                    <i class="icon-envelope"></i> Invia mail
                                </a>
                     <?php if ( $me->presidenziante() || $me->admin() ){ ?>
                                <a class="btn btn-small btn-danger pull-right" onclick="return confirm('Sei davvero sicuro di voler eliminare il gruppo?');" href="?p=gruppi.elimina&id=<?= $gruppo->id; ?>" title="Elimina gruppo">
                                    <i class="icon-trash"></i> Elimina
                                </a>
                                <a class="btn btn-small btn-info pull-right" href="?p=gruppo.modifica&id=<?= $gruppo->id; ?>" title="Modifica gruppo">
                                    <i class="icon-edit"></i> Modifica gruppo
                                </a>
                                <a class="btn btn-small pull-right" href="?p=gruppo.referente.nuovo&id=<?= $gruppo->id; ?>">
                                    <i class="icon-pencil"></i> 
                                    <?php if($gruppo->referente()){ echo $gruppo->referente()->nomeCompleto(); }else{ ?> Seleziona un volontario <?php } ?>
                                </a>
                     <?php } ?>
                    </td>
                </tr>
    <?php
        foreach($g as $volontario){
    ?>
                    <tr>
                        <td><?= $volontario->cognome; ?>    </td>
                        <td><?= $volontario->nome; ?>       </td>
                        <td><?= $volontario->cellulare(); ?></td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-small" href="?p=public.utente&id=<?php echo $volontario->id; ?>" target="_new"  title="Dettagli">
                                    <i class="icon-eye-open"></i> Dettagli
                                </a>

                                <a class="btn btn-small btn-success" href="?p=utente.mail.nuova&id=<?php echo $volontario->id; ?>" target="_new" title="Invia Mail">
                                    <i class="icon-envelope"></i>
                                </a>
                            </div>
                       </td>
                    </tr>
    <?php
        }
}

?>
 </table>
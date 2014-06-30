<?php

/*
 * ©2014 Croce Rossa Italiana
 */

paginaApp([APP_PRESIDENTE, APP_FARMACIA]);
if(!$presidente && $me->appartenenzaAttuale()->comitato()->regionale()!='1' ){
    redirect("errore.permessi");
}
?>

<div class="row-fluid">
    <div class="span3">
        <?php menuVolontario(); ?>
    </div>
    <div class="span9">
        <div class="row-fluid">          
            <div class="span12">
                <h3>Farmacia</h3>
            </div>
        </div>
        
        <div class="row-fluid">
            <div class="span3">
                
            </div>
            
            <div class="span6 allinea-centro">
                <img src="https://upload.wikimedia.org/wikipedia/it/thumb/4/4a/Emblema_CRI.svg/75px-Emblema_CRI.svg.png" />
            </div>

            <div class="span3">
                <table class="table table-striped table-condensed">
                    
                    <tr><td>Num. Volontari</td><td><?php echo $me->numVolontariDiCompetenza(); ?></td></tr>
                    <tr><td>Num. Soci Ordinari</td><td><?php echo $me->numOrdinariDiCompetenza(); ?></td></tr>
                    
                </table>
            </div>
        </div>
        <div class="row-fluid">
            <hr />
            <div class="alert alert-block alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="icon-user"></i> <strong>Alcune indicazioni utili</strong><br />
                Se provi ad inserire un volontario o un socio ordinario ma non riesci a completare l'operazione 
                può essere che la persona abbia provato a registrarsi autonomamente e che l'operazione non sia andata a
                buon fine. <a href="?p=utente.supporto"><i class="icon-envelope"></i> Contatta il supporto</a> e spiega il 
                problema così che sia possibile risolvere la situazione.
                <br />
                Per caricare i volontari o i soci ordinari del tuo comitato in blocco sono disponibili dei format
                in excel da compilare e spedire al supporto che provvederà all'importazione. Non caricare i volontari
                uno ad uno: <a href="?p=utente.supporto"><i class="icon-envelope"></i> contatta il supporto</a> e ti 
                forniranno tutte le indicazioni per caricare in massa volontari e soci ordinari.
            </div>
        </div>
        <div class="row-fluid">
        <div class="span12">
            <div class="span6">
                <div class="row-fluid">
                    <div class="btn-group btn-group-vertical span12">
                        <a href="?p=presidente.utenti" class="btn btn-primary btn-block">
                            <i class="icon-list"></i>
                            Elenco Farmaci
                        </a>
                        <br/>
                    </div>
                </div>
                <hr/>
                <div class="row-fluid">
                    <div class="btn-group btn-group-vertical span12">
                        <a href="?p=us.elettorato" class="btn btn-danger btn-block">
                            <i class="icon-list"></i>
                            Elenco Presidi
                        </a>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="row-fluid">
                    <div class="btn-group btn-group-vertical span12">
                        <a href="?p=farmacia.farmaci" class="btn btn-block">
                            <i class="icon-plus"></i>
                            Registra Farmaco
                        </a>
                        <a href="?p=us.quote.ricerca" class="btn btn-block">
                            <i class="icon-certificate"></i>
                            Inserisci nuovo farmaco
                        </a>
                    </div>
                </div>
                <hr/>
                <div class="row-fluid">
                    <div class="btn-group btn-group-vertical span12">
                        <a href="?p=us.quoteNo" class="btn btn-block">
                            <i class="icon-plus"></i>
                            Registra Presidio
                        </a>
                        <a href="?p=us.quote.ricerca" class="btn btn-block">
                            <i class="icon-certificate"></i>
                            Inserisci nuovo presidio
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

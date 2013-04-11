<?php

/*
 * ©2013 Croce Rossa Italiana
 */

richiediComitato();
$a = new Attivita($_GET['id']);


?>


<div class="row-fluid">
    
    <div class="span3">
        <?php menuVolontario(); ?>
     


    </div>

    <div class="span9">
        
        <div class="row-fluid">
            

            <div class="span8 btn-group">
                
                <a href="?p=attivita" class="btn btn-large">
                    <i class="icon-reply"></i> Calendario
                </a>
                
                <?php if ( $a->modificabileDa($me) ) { ?>
                <a href="?p=attivita.nuova&id=<?php echo $a->id; ?>" class="btn btn-large btn-info">
                    <i class="icon-edit"></i>
                    Modifica
                </a>
                <?php } ?>
            </div>
            
            <div class="span4 allinea-destra">
                <span class="muted">
                    <strong>Ultimo aggiornamento</strong>:<br />
                    <i class="icon-time"></i> <?php echo date('d/m/Y H:i:s', $a->timestamp); ?>
                </span>
            </div>
           
            
        </div>
        
        <hr />
        
        <div class="row-fluid allinea-centro">
            <div class="alert alert-block alert-success">
                <h2><?php echo $a->nome; ?></h2>
                <h4 class="muted"><i class="icon-map-marker"></i> <?php echo $a->luogo; ?></h4>
            </div>
        </div>
        
        
        <div class="row-fluid allinea-centro">
            <div class="span3">
                <span>
                    <i class="icon-user"></i>
                    Referente
                </span><br />
                <a href="?p=utente.mail.nuova&id=<?php echo $a->referente()->id;?>">
                    <?php echo $a->referente()->nome . ' ' . $a->referente()->cognome; ?>
                     </a>
                <br />
                    <span class="muted">+39</span> <?php echo $a->referente()->cellulare; ?>
               
            </div>  
            
            <div class="span3">
                <span>
                    <i class="icon-globe"></i>
                    Località
                </span><br />
                <a target="_new" href="<?php echo $a->linkMappa(); ?>">
                    Vedi sulla mappa
                </a>
            </div>   
            
            <div class="span3">
                <span>
                    <i class="icon-home"></i>
                    Organizzato da
                </span><br />
                <span class="text-info"><?php echo $a->comitato()->nome; ?></span>
            </div>   
            
            <div class="span3">
                <span>
                   <i class="icon-lock"></i>
                    Partecipazione
                </span><br />
                <span class="text-info">
                <?php if ( $a->pubblica ) { ?>
                    <strong>Permessa a tutti i volontari di Croce Rossa Italiana</strong>
                <?php } else { ?>
                    Permessa ai volontari del comitato organizzatore.
                <?php } ?>
                </span>
                
            </div>
        </div>
        
        <hr />
        
        <div class="row-fluid">
            
            <div class="span5">
               <div class="row-fluid allinea-centro">
                    <i class="icon-certificate"></i> Tipologia attività<br />
                    <span class="text-info"><?php echo $conf['app_attivita'][$a->tipo]; ?></span>
                </div>
                <hr />
                <p><i class="icon-info-sign"></i> Ulteriori informazioni</p>
                <blockquote class="span12"><?php echo nl2br($a->descrizione); ?></blockquote>
            </div>
            
            <div class="span7">

                <?php
                $ts = $a->turniScoperti();
                $tsn = count($ts);
                if ( $ts ) { ?>
                
                <div class="alert alert-block alert-error allinea-centro">
                    
                    <h2 class="text-error ">
                        <i class="icon-warning-sign"></i>
                        Ci sono <?php echo $tsn; ?> turni scoperti
                    </h2>
                    
                    <p>Aiutaci a colmare i posti mancanti!</p>
                    
                </div>
                
                <?php } ?>
            </div>
            
        </div>
        
        
        
        
        <hr />
        
        <h2><i class="icon-time"></i> Elenco turni dell'Attività</h2>
        
        <div class="row-fluid">
            <table class="table table-bordered table-striped" id="turniAttivita">
                <thead>
                    <th>Nome</th>
                    <th>Data ed ora</th>
                    <th>Volontari</th>
                    <th>Partecipa</th>
                </thead>
                
                <tr style="display: none;" id="rigaMostraTuttiTurni">
                    <td colspan="4">
                        <a id="mostraTuttiTurni" class="btn btn-block">
                            <i class="icon-info-sign"></i>
                            Ci sono <span id="numTurniNascosti"></span> turni passati nascosti.
                            <strong>Clicca per mostrare i turni nascosti.</strong>
                        </a>
                    </td>
                </tr>
                
                <?php foreach ( $a->turni() as $turno ) { ?>
                
                    <tr<?php if ( $turno->scoperto() ) { ?> class="warning"<?php } ?> data-timestamp="<?php echo $turno->fine()->toJSON(); ?>">

                        <td>
                            <big><strong><?php echo $turno->nome; ?></strong></big>

                            <br />
                                <?php echo $turno->durata()->format('%H ore %i min'); ?>

                        </td>
                        <td>
                            Inizio: 
                            <strong><?php echo $turno->inizio()->format('d-m-Y \a\l\l\e H:i'); ?></strong>
                            <br />
                            Fine:
                            <strong><?php echo $turno->fine()->format('d-m-Y \a\l\l\e H:i'); ?></strong>
                        </td>
                        
                        <td>
                            <?php if ( $turno->scoperto() ) { ?>
                                <span class="label label-warning">
                                    Scoperto!
                                </span><br />
                            <?php } ?>
                            <?php if ( $turno->pieno() ) { ?>
                                <span class="label label-important">
                                    Pieno!
                                </span><br />
                            <?php } ?>
                            <?php $pp = $turno->partecipazioni(); ?>
                            <strong>Volontari: <?php echo count($pp); ?></strong><br />
                            Min. <?php echo $turno->minimo; ?> &mdash; Max. <?php echo $turno->massimo; ?>
                            <?php if ( $pp ) { ?><br /><?php } ?>
                            <?php foreach ( $pp as $ppp ) { 
                                $vv = $ppp->volontario();
                            ?>
                                <a href="#" title="<?php echo $vv->nomeCompleto(); ?>">
                                    <img class="img-circle" src="<?php echo $vv->avatar()->img(10); ?>" />
                                </a>
                            <?php } ?>
                            
                            
                        </td>
                        <td>
                            
                            <?php if ( $pk = $turno->partecipazione($me) ) { ?>
                                
                                
                                 <a class="btn btn-block btn-info btn-large disabled" href="">
                                      <?php echo $conf['partecipazione'][$pk->stato]; ?>
                                 </a>
                                 <a class="btn btn-block btn-danger " href="?p=attivita.ritirati&turno=<?php echo $turno->id; ?>">
                                      <i class="icon-remove"></i>
                                      Ritirati
                                 </a>
                                
                                
                                
                            <?php } elseif ( $turno->puoRichiederePartecipazione($me) ) { ?>
                                <a href="?p=attivita.partecipa&turno=<?php echo $turno->id; ?>" class="btn btn-success btn-large btn-block">
                                    <i class="icon-ok"></i> Partecipa
                                </a>
                                
                                
                            <?php } else { ?>
                                 <a class="btn btn-block disabled">
                                     <i class="icon-info-sign"></i> 
                                     Non puoi partecipare
                                 </a>

                            <?php } ?>
                        </td>
                    </tr>
                
                <?php } ?>
            
            </table>
        </div>
        
        
        
    </div>
      
    
</div>

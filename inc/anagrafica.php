<?php

/*
 * ©2012 Croce Rossa Italiana
 */

paginaPrivata();


?>
<hr />
<div class="row-fluid">
    <div class="span3">
        <?php        menuVolontario(); ?>
    </div>
    <div class="span6">
        <h2><i class="icon-edit muted"></i> Anagrafica</h3>
        
        <?php if ( isset($_GET['ok']) ) { ?>
        <div class="alert alert-success">
            <i class="icon-save"></i> <strong>Salvato</strong>.
            Le modifiche richieste sono state memorizzate con successo.
        </div>
        <?php } else { ?>
        <div class="alert alert-block alert-info">
            <h4><i class="icon-question-sign"></i> Qualcosa è sbagliato?</h4>
            <p>Se qualche informazione è errata e non riesci a modificarla,
                contattaci a <a href="mailto:informatica@cricatania.it">informatica@cricatania.it</a>
                e saremo lieti di aiutarti.</p>
        </div>
        <?php } ?>
        <form class="form-horizontal" action="?p=anagrafica.ok" method="POST">
            <div class="control-group">
              <label class="control-label" for="inputNome">Nome</label>
              <div class="controls">
                <input type="text" name="inputNome" id="inputNome" readonly value="<?php echo $me->nome; ?>">
                <acronym title="Per modificare, contatta informatica@cricatania.it">&nbsp; <i class="icon-lock icon-large"></i></acronym>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="inputCognome">Cognome</label>
              <div class="controls">
                <input type="text" name="inputCognome" id="inputCognome" readonly value="<?php echo $me->cognome; ?>">
                <acronym title="Per modificare, contatta informatica@cricatania.it">&nbsp; <i class="icon-lock icon-large"></i></acronym>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="inputCodiceFiscale">Codice Fiscale</label>
              <div class="controls">
                <input type="text" name="inputCodiceFiscale" id="inputCodiceFiscale" readonly value="<?php echo $me->codiceFiscale; ?>">
                <acronym title="Per modificare, contatta informatica@cricatania.it">&nbsp; <i class="icon-lock icon-large"></i></acronym>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="inputDataNascita">Data di Nascita</label>
              <div class="controls">
                <input type="text" class="input-small" name="inputDataNascita" id="inputDataNascita" readonly value="<?php echo date('d-m-Y', $me->dataNascita); ?>">
                <acronym title="Per modificare, contatta informatica@cricatania.it">&nbsp; <i class="icon-lock icon-large"></i></acronym>

              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="inputProvinciaNascita">Provincia di Nascita</label>
              <div class="controls">
                <input class="input-mini" type="text" name="inputProvinciaNascita" id="inputProvinciaNascita" readonly value="<?php echo $me->provinciaNascita; ?>">
                <acronym title="Per modificare, contatta informatica@cricatania.it">&nbsp; <i class="icon-lock icon-large"></i></acronym>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="inputComuneNascita">Comune di Nascita</label>
              <div class="controls">
                <input type="text" name="inputComuneNascita" id="inputComuneNascita" readonly value="<?php echo $me->comuneNascita; ?>">
                <acronym title="Per modificare, contatta informatica@cricatania.it">&nbsp; <i class="icon-lock icon-large"></i></acronym>
              </div>
            </div>

            <div class="control-group">
               <label class="control-label" for="inputIndirizzo">Indirizzo</label>
               <div class="controls">
                 <input value="<?php echo $me->indirizzo; ?>" type="text" id="inputIndirizzo" name="inputIndirizzo" required />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label" for="inputCivico">Civico</label>
               <div class="controls">
                 <input value="<?php echo $me->civico; ?>" type="text" id="inputCivico" name="inputCivico" class="input-small" required />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label" for="inputComuneResidenza">Comune di residenza</label>
               <div class="controls">
                 <input value="<?php echo $me->comuneResidenza; ?>" type="text" id="inputComuneResidenza" name="inputComuneResidenza" required />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label" for="inputCAPResidenza">CAP di residenza</label>
               <div class="controls">
                 <input value="<?php echo $me->CAPResidenza; ?>" class="input-small" type="text" id="inputCAPResidenza" name="inputCAPResidenza" required pattern="[0-9]{5}" />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label" for="inputProvinciaResidenza">Provincia di residenza</label>
               <div class="controls">
                 <input value="<?php echo $me->provinciaResidenza; ?>" class="input-mini" type="text" id="inputProvinciaResidenza" name="inputProvinciaResidenza" required pattern="[A-Za-z]{2}" />
                 &nbsp; <span class="muted">ad es.: CT</span>
               </div>
             </div>
            <div class="control-group">
            <label class="control-label" for="inputgruppoSanguigno">Gruppo Sanguigno</label>
            <div class="controls">
                <select class="input-small" id="inputgruppoSanguigno" name="inputgruppoSanguigno"  required>
                <?php
                    foreach ( $conf['sangue_gruppo'] as $numero => $gruppo ) { ?>
                    <option value="<?php echo $numero; ?>" <?php if ( $numero == $me->grsanguigno ) { ?>selected<?php } ?>><?php echo $gruppo; ?></option>
                    <?php } ?>
                </select>   
            </div>
          </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success btn-large">
                    <i class="icon-save"></i>
                    Salva modifiche
                </button>
            </div>
          </form>

    </div>
    
    <div class="span3 allinea-centro">
        <h3>Fotografia</h3>
        <?php if ( isset($_GET['aok']) ) { ?>
            <div class="alert alert-success">
                <i class="icon-ok"></i> Fotografia modificata!
            </div>
        <?php } elseif ( isset($_GET['aerr']) ) { ?>
            <div class="alert alert-error">
                <i class="icon-warning-sign"></i>
                <strong>Errore</strong> &mdash; File troppo grande o non valido.
            </div>
        <?php } else { ?>
            <hr />
            <p>Questa è la tua fotografia.</p>
        <?php } ?>
            
        <img src="<?php echo $me->avatar()->img(20); ?>" class="img-polaroid" />
        <hr />
        <form id="caricaFoto" action="?p=anagrafica.avatar" method="POST" enctype="multipart/form-data" class="allinea-sinistra">
            <p>Per modificare la foto:</p>
          <p>1. <strong>Scegli</strong>: <input type="file" name="avatar" required /></p>
          <p>2. <strong>Clicca</strong>:<br />
              <button type="submit" class="btn btn-block btn-success">
              <i class="icon-save"></i> Salva la foto
          </button></p>
        </form>
    </div>
</div>

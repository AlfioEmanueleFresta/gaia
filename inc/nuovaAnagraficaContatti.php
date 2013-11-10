<?php

/*
 * ©2012 Croce Rossa Italiana
 */

?>

<div class="row-fluid">
    <div class="span12 centrato">
            <h2><?php echo $sessione->utente()->nome; ?><span class="muted">, ci siamo quasi.</span></h2>
        <hr />
    </div>
</div>

<?php if ( isset($_GET['esistente'] ) ) { ?>
<div class="alert alert-success">
    <h4>Stai completando la tua registrazione</h4>
    <p>La tua anagrafica è già presente sul nostro database. Ultima la registrazione.</p>
</div>
<?php } ?>



<div class="row-fluid">
    <div class="span4">
        <h2>
            <i class="icon-phone"></i>
            Contatti
        </h2>
        <p>
            Inserisci i tuoi dati di contatto.
        </p>
        <?php if ( $sessione->tipoRegistrazione == VOLONTARIO ) { ?>
        <p>
            Verrai informato sulle attività nel tuo territorio.
        </p>
        <p>
            <i class="icon-key"></i> Inserisci inoltre la password che userai per accedere.
        </p>
        <?php } ?>
    </div>
    <div class="span8">
          <?php if ( isset($_GET['email'] ) ) { ?>
              <div class="alert alert-block alert-error">
                  <h4>Email già in uso</h4>
                  <p>Questa email è già usata da un altro utente.</p>
                  <p>Devi avere un indirizzo email univoco in quanto questo viene usato per 
                     comunicazioni personali ed al momento dell'accesso.</p>
              </div>
          <?php } ?>
          <?php if (isset($_GET['e'])) { ?>
              <div class="alert alert-block alert-error">
                  <h4>Inserisci una password complessa</h4>
                  <p>Le password complesse sono più difficili da indovinare.</p>
                  <p>Scegli una password tra 6 e 15 caratteri.</p>
              </div>
          <?php } ?>
        <form class="form-horizontal" action="?p=nuovaAnagraficaContatti.ok" method="POST">
          <div class="control-group input-prepend">
            <label class="control-label" for="inputEmail">Email</label>
            <div class="controls">
              <span class="add-on"><i class="icon-envelope"></i></span>
              <input type="email" id="inputEmail" name="inputEmail" autofocus required value="<?php echo $me->email; ?>"/>
            </div>
          </div>
          <div class="control-group input-prepend">
            <label class="control-label" for="inputCellulare">Cellulare</label>
            <div class="controls ">
              <span class="add-on">+39</span>
              <input type="text" id="inputCellulare" name="inputCellulare" required pattern="[0-9]{9,11}" value="<?php echo $me->cellulare; ?>"/>
            </div>
          </div>
          <?php if ( $sessione->tipoRegistrazione == VOLONTARIO ) { ?>
            <div class="control-group input-prepend">
              <label class="control-label" for="inputCellulareServizio">Cell. servizio</label>
              <div class="controls">
                <span class="add-on">+39</span>
                <input type="text" id="inputCellulareServizio" name="inputCellulareServizio" pattern="[0-9]{9,11}" value="<?php echo $me->cellulareServizio; ?>"/>
              </div>
            </div>
          <?php } ?>
          <hr />
          <div class="control-group input-prepend">
              <label class="control-label" for="inputPassword">Password</label>
              <div class="controls ">
                  <span class="add-on"><i class="icon-key"></i></span>
                  <input type="password" id="inputPassword" name="inputPassword" required pattern=".{6,15}" />
              </div>
          </div>
          <p class="centrato muted">Scegli una password complessa, dai 6 ai 15 caratteri.</p>
          <hr/>
          <div class="control-group">
            <div class="controls">
              <button type="submit" class="btn btn-large btn-success">
                  <i class="icon-ok"></i>
                  Avanti
              </button>
            </div>
          </div>
        </form>

    </div>
</div>
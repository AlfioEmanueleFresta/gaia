<?php

/*
 * ©2012 Croce Rossa Italiana
 */

paginaPrivata();

?>
<div class="row-fluid">
    <div class="span3">
        <?php        menuVolontario(); ?>
    </div>
    <div class="span9">
        <h2><i class="icon-envelope muted"></i> Comunicazioni email</h3>
        <hr />
        <?php if ( isset($_GET['ok']) ) { ?>
        <div class="alert alert-success">
            <i class="icon-save"></i> <strong>Indirizzo salvato</strong>.
            Le comunicazioni verranno ora inviate alla nuova email.
        </div>
        <?php } elseif ( isset($_GET['ep']) )  { ?>
        <div class="alert alert-block alert-error">
            <h4><i class="icon-exclamation-sign"></i> Email già in uso</h4>
            <p>L'email che hai inserito risulta già in uso.</p>
            <p>Ti preghiamo di inserire il tuo indirizzo email personale.</p>
        </div>
        <?php } elseif ( isset($_GET['pass']) )  { ?>
        <div class="alert alert-block alert-error">
            <h4><i class="icon-exclamation-sign"></i> Password errata!</h4>
            <p>La password che hai inserito non risulta corretta</p>
        </div>
        <?php } ?>
        <form class="form-horizontal" action="?p=utente.email.conferma" method="POST">

            <div class="control-group">
                <div class="alert alert-warning alert-block">
                    <p><h4><i class="icon-warning-sign"></i> Nota bene</h4></p>
                    <p>L'<strong>Email Principale</strong> è quella che <strong>usi per accedere</strong> ed è 
                       dove ti invieremo tutte le comunicazioni importanti.</p>
                    <p>L'<strong>Email di Servizio</strong> è quella da partiranno le comunicazioni che spedisci
                    nel caso tu abbia qualche incarico in un Comitato CRI.</p>
                    <p>Se <strong>non sei in possesso</strong> di un cellulare di servizio 
                    lascia il campo vuoto</p>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputEmail">Email principale</label>
                    <div class="controls">
                        <input type="email" autofocus name="inputEmail" id="inputEmail" required value="<?php echo $me->email; ?>">
                    </div>
                </div>
                <?php if ($me->volontario()){ ?>
                <div class="control-group">
                    <label class="control-label" for="inputemailServizio">Email di servizio</label>
                    <div class="controls">
                        <input type="email" autofocus name="inputemailServizio" id="inputemailServizio" value="<?php echo $me->emailServizio; ?>">
                    </div>
                </div>
                <?php } ?>
            <div class="form-actions">
                <button type="submit" class="btn btn-success btn-large">
                    <i class="icon-save"></i>
                    Cambia email
                </button>
            </div>
          </form>

    </div>

</div>
</div>


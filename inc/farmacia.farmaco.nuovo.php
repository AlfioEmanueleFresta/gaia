<?php

/*
 * ©2014 Croce Rossa Italiana
 */

paginaApp([APP_PRESIDENTE, APP_FARMACIA]);

?>
<div class="row-fluid">
    <?php if (isset($_GET['err'])) { ?>
    <div class="alert alert-block alert-error">
        <h4><i class="icon-warning-sign"></i> <strong>Qualcosa non ha funzionato</strong>.</h4>
        <p>L'operazione che stavi tentando di eseguire non è andata a buon fine. Per favore riprova.</p>
    </div> 
    <?php } ?>
    <h2><i class="icon-chevron-right muted"></i> Aggiungi nuovo Farmaco</h2>
    <div class="alert alert-block alert-info ">
        <div class="row-fluid">
            <span class="span7">
                <p>Con questo modulo si possono aggiungere i Farmaci al DB di GAIA</p>
                <p>Es: Plasil</p>
            </span>
        </div>
    </div>           
</div>
<form class="form-horizontal" action="?p=farmacia.farmaco.nuovo.ok" method="POST">
    <div class="control-group">
        <label class="control-label" for="inputTipo">Tipologia farmaco</label>
        <div class="controls">
            <select class="input-large" id="inputTipo" name="inputTipo" required>
                <?php
                foreach ( $conf['farmaci'] as $numero => $gruppo ) { ?>
                    <option value="<?php echo $numero; ?>"><?php echo $gruppo; ?></option>
                <?php } ?>
            </select>   
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputNome">Descrizione </label>
        <div class="controls">
            <input class="input-xxlarge" type="text" name="inputNome" id="inputNome" placeholder="Menarini Tachipirina 125mg" required>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPrincipio">Principio Attivo </label>
        <div class="controls">
            <input class="input-xxlarge" type="text" name="inputPrincipio" id="inputPrincipio" placeholder="Paracetamolo">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputBarcode">Barcode </label>
        <div class="controls">
            <input class="input-large" type="text" name="inputBarcode" id="inputBarcode">
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
          <button type="submit" class="btn btn-large btn-success">
              <i class="icon-ok"></i>
              Aggiungi
          </button>
      </div>
  </div>


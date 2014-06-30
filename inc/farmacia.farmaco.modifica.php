<?php

/*
 * ©2014 Croce Rossa Italiana
 */

paginaApp([APP_PRESIDENTE, APP_FARMACIA]);
controllaParametri(array('id'), 'farmacia.farmaci&err');
$t = $_GET['id'];
$f = Farmaco::id($t);
?>
<div class="row-fluid">
  <h2><i class="icon-chevron-right muted"></i> Modifica Farmaco</h2>
    <div class="alert alert-block alert-info ">
      <div class="row-fluid">
        <span class="span7">
          <p>Con questo modulo si possono modificare i Farmaci al DB di GAIA</p>
        </span>
      </div>
    </div>           
</div>
<form class="form-horizontal" action="?p=farmacia.farmaco.modifica.ok&id=<?php echo $t; ?>" method="POST">
  <div class="control-group">
    <label class="control-label" for="inputTipo">Tipologia farmaco</label>
    <div class="controls">
      <select class="input-large" id="inputTipo" name="inputTipo"  required>
        <?php
          foreach ( $conf['farmaci'] as $numero => $gruppo ) { ?>
            <option value="<?php echo $numero; ?>" <?php if ( $numero==$f->tipo ) { ?>selected<?php } ?>><?php echo $gruppo; ?></option>
        <?php } ?>
      </select>   
    </div>
  </div>

    <div class="control-group">
      <label class="control-label" for="inputNome">Descrizione</label>
      <div class="controls">
        <input class="input-xxlarge" type="text" name="inputNome" id="inputNome" value="<?php echo $f->nome; ?>">
      </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputPrincipio">Principio Attivo </label>
        <div class="controls">
            <input class="input-xxlarge" type="text" name="inputPrincipio" id="inputPrincipio" value="<?php echo $f->pAttivo; ?>">
        </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="inputBarcode">Barcode</label>
      <div class="controls">
        <input class="input-xxlarge" type="text" name="inputBarcode" id="inputBarcode" value="<?php echo $f->barcode; ?>">
      </div>
    </div>

  <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn btn-large btn-success">
            <i class="icon-ok"></i>
            Modifica Farmaco
        </button>
    </div>
  </div>
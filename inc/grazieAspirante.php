<?php

/*
 * ©2012 Croce Rossa Italiana
 */

paginaPubblica();

?>

<div class="alert alert-block alert-success">
  <h4>Grazie, <?php echo $sessione->utente()->nome; ?>.</h4>
  <p>Ti contatteremo al più presto con informazioni sul prossimo corso base.</p>
</div>

<a href="?p=home">Torna alla home</a>.
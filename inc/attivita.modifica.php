<?php

/* 
 * ©2013 Croce Rossa Italiana
 */

paginaPrivata();
paginaAttivita();
caricaSelettore();

$a = new Attivita(@$_GET['id']);

if (!$a->haPosizione()) {
    redirect('attivita.localita&id=' . $a->id);
}

$del        = $me->delegazioni(APP_ATTIVITA);
$comitati   = $me->comitatiDelegazioni(APP_ATTIVITA);
$domini     = $me->dominiDelegazioni(APP_ATTIVITA);

?>

<form action="?p=attivita.modifica.ok" method="POST">
<input type="hidden" name="id" value="<?php echo $a->id; ?>" />
    
<div class="row-fluid">
    
    <div class="span7">
        <h2><i class="icon-flag muted"></i> Dettagli dell'attività</h2>
    </div>
    
    <div class="span5">
        <button type="submit" name="azione" value="salva" class="btn btn-success btn-block btn-large">
            <i class="icon-save"></i> Salva l'attività
        </button>
    </div>
    
</div>
    <hr />
<div class="row-fluid">
    <div class="span8">    



          <div class="form-horizontal">
          <div class="control-group">
            <label class="control-label" for="inputNome">Nome</label>
            <div class="controls">
              <input class="input-xlarge grassetto" value="<?php echo $a->nome; ?>" type="text" id="inputNome" name="inputNome" placeholder="Es.: Aggiungi un Posto a Tavola" required autofocus pattern=".{2,}" />
            </div>
          </div>   
              
          <div class="control-group">
            <label class="control-label" for="inputVisibilita">Quali volontari possono chiedere di partecipare?</label>
            <div class="controls">
                <select class="input-xxlarge" name="inputVisibilita">
                    <?php foreach ( $conf['att_vis'] as $num => $nom ) { ?>
                        <option value="<?php echo $num; ?>"
                            <?php if ( $a->visibilita == $num ) { ?>
                                selected="selected"
                            <?php } ?>
                                >
                                    <?php echo $nom; ?>
                        </option>
                    <?php } ?>
                </select>
                <p class="text-info"><i class="icon-info-sign"></i> I volontari al di fuori di questa selezione non vedranno l'attività nel calendario.</p>
            </div>
          </div>   
          <div class="control-group">
            <label class="control-label" for="inputDescrizione">Descrizione ed informazioni per i volontari</label>
            <div class="controls">
              <textarea rows="10" class="input-xlarge conEditor" type="text" id="inputDescrizione" name="inputDescrizione"><?php echo $a->descrizione; ?></textarea>
            </div>
          </div>
          
      
       

        </div>
    

    </div>
    
    <div class="span4">
        
        <p>
            <strong>Referente</strong><br />
            <?php echo $a->referente()->nomeCompleto(); ?>
        </p>
        
        <p>
            <strong>Organizzatore</strong><br />
            <?php echo $a->comitato()->nomeCompleto(); ?>
        </p>
        
        <p>
            <strong>Area d'intervento</strong><br />
            <?php echo $a->area()->nomeCompleto(); ?>
        </p>    
        
        <p>
            <strong>Posizione geografica</strong><br />
            <?php echo $a->luogo; ?>
        </p>
        
        
    </div>
    
    
</div>
    
    <hr />
    
    
    <div class="row-fluid">
        
        <div class="span8">
            <h2>
                <i class="icon-time muted"></i>
                Giorni e turni dell'attività
            </h2>
            
        </div>
        
        <div class="span4">
            <button type="submit" name="azione" value="aggiungiTurno" class="btn btn-block btn-large btn-primary">
               <i class="icon-plus"></i>
               Aggiungi nuovo turno
            </button>
        </div>
        
    </div>
            
<div class="row-fluid">
        
    
    <div class="span12">
        
        <div id="i1" class="alert alert-block alert-info nascosto">
            <h4><i class="icon-info-sign"></i> <strong>Minimo e massimo</strong>.</h4>
            <p>Minimo e Massimo ti permettono di specificare il numero minimo e massimo di volontari.</p>
            <p>Un turno con <strong>carenza di volontari sarà evidenziato</strong>; al contempo uno che ha già il numero
                massimo, <strong>non permetterà ulteriori richieste di partecipazione</strong>.</p>
        </div>
        
        <div id="i2" class="alert alert-block alert-info nascosto">
            <h4><i class="icon-info-sign"></i> <strong>Nome del turno</strong>.</h4>
            <p>In un'<strong>attività ripetitiva</strong>, può essere un nome crescente (Turno 1, Turno 2, Turno 3,...).</p>
            <p>In un'<strong>attività di piazza</strong>, può essere usato per identificare vari turni anche contemporanei (Servizio coi Bambini, Gioco dell'Oca, ecc).</p>
        </div>
        
        <table class="table table-striped table-bordered" id="tabellaTurni">
             <thead>
                 <th>Nome <a href="#" onclick="$('#i2').toggle(500);"><i class="icon-question-sign"></i></a></th>
                 <th>Inizio</th>
                 <th>Fine</th>
                 <th>Min vv. <a href="#" onclick="$('#i1').toggle(500);"><i class="icon-question-sign"></i></a></th>
                 <th>Max vv. <a href="#" onclick="$('#i1').toggle(500);"><i class="icon-question-sign"></i></a></th>
                 <th>Partecipazioni</th>
                 <th>&nbsp;</th>
             </thead>
             
                 <?php 
                 $t = $a->turni();
                 if ( !$t ) {
                     $x = new Turno();
                     $x->attivita = $a->id;
                     $x->inizio   = time();
                     $x->fine     = strtotime('+2 hours');
                     $x->nome     = 'Turno 1';
                     $x->minimo   = 1;
                     $x->massimo  = 4;
                     $t[] = $x;
                 }
                 foreach ( $t as $_t ) { ?>
                    <tr class="unTurno">
                        <td>
                            <input class="span12 grassetto" required type="text" name="<?php echo $_t->id; ?>_nome" value="<?php echo $_t->nome; ?>" />
                        </td>
                        <td>
                            <input class="dt span12 grassetto" required type="text" name="<?php echo $_t->id; ?>_inizio" value="<?php echo $_t->inizio()->format('d/m/Y H:i'); ?>" />
                        </td>
                        <td>
                            <input class="dt span12 grassetto" required type="text" name="<?php echo $_t->id; ?>_fine" value="<?php echo $_t->fine()->format('d/m/Y H:i'); ?>" />
                        </td>
                        <td>
                            <input class="input-mini" type="number" required min="0" max="999" step="1" name="<?php echo $_t->id; ?>_minimo" value="<?php echo $_t->minimo; ?>" />
                        </td>                        
                        <td>
                            <input class="input-mini" type="number" required min="0" max="999" step="1" name="<?php echo $_t->id; ?>_massimo" value="<?php echo $_t->massimo; ?>" />
                        </td>
                        <?php
                        $part   = $_t->partecipazioni();
                        $partC  = $_t->partecipazioniStato(AUT_OK);
                        ?>
                        <td>
                            <?php echo count($part) ?> richieste;<br />
                            <strong><?php echo count($partC); ?> accettate</strong>.
                        </td>
                        <td>
                            <?php if ( $partC ) { ?>
                                Incancellabile.
                            <?php } else { ?>
                                <button class="btn btn-block btn-danger" type="submit" name="azione" value="<?php echo $_t->id; ?>"
                                        onclick="return confirm('Sei sicuro? Eventuali richieste di partecipazione al turno in attesa verranno eliminate.');">
                                    <i class="icon-remove"></i>
                                    Rimuovi
                                </button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>

             
         </table>

        
    </div>
    
<!--Mappa-->    
</div>
</form>
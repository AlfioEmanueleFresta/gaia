<?php

/*
 * ©2012 Croce Rossa Italiana
 */

class Attivita extends GeoEntita {
        
    protected static
        $_t  = 'attivita',
        $_dt = 'dettagliAttivita';

    public function comitato() {
    	if ( $this->comitato ) {
    		return new Comitato($this->comitato);
    	} else { 
    		return null;
    	}
    }

    public function referente() {
    	return new Volontario($this->referente);
    }
    
    public static function ricercaPubbliche($x, $y, $raggio) {
        return Attivita::filtraRaggio($x, $y, $raggio, [
            ['pubblica',    ATTIVITA_PUBBLICA]
        ]);
    }
    
    public function turni() {
        $q = $this->db->prepare("
            SELECT      id
            FROM        turni
            WHERE       attivita = :id
            ORDER BY    inizio ASC,
                        nome   ASC");
        $q->bindParam(':id',    $this->id);
        $q->execute();
        $r = [];
        while ( $k = $q->fetch(PDO::FETCH_NUM) ) {
            $r[] = new Turno($k[0]);
        }
        return $r;
    }
    
    public function turniScoperti() {
        $t = [];
        foreach ( $this->turni() as $_t ) {
            if ( count($_t->partecipazioni()) < $_t->minimo && $_t->inizio()->getTimestamp() > time() ) {
                $t[] = $_t;
            }
        }
        return $t;
    }
    
    public function cancella() {
        foreach ( $this->turni() as $t ) {
            $t->cancella();
        }
        parent::cancella();
    }
    
    public function linkMappa() {
        $n = urlencode($this->luogo);
        $c = $this->coordinate();
        $c = $c[0] . ',' . $c[1];
        return "http://maps.google.com/?q={$n}@{$c}";
    }
    
    public function modificabileDa(Utente $u) {
        if (
                    $this->referente == $u->id 
                or
                    ( 
                            in_array($this->comitato(), $u->comitatiDelegazioni(APP_ATTIVITA))
                            and
                            in_array($this->tipo, $u->dominiDelegazioni(APP_ATTIVITA))
                        )
            )
        {
            return true;
        } else {
            return false;
        }
    }
}
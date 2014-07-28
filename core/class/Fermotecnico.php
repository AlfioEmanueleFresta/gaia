<?php

/*
 * ©2014 Croce Rossa Italiana
 */

class Fermotecnico extends Entita {

	protected static
        $_t     = 'fermotecnico',
        $_dt    =  null;

    /**
     * Ritorna true se attuale
     * @return True or False
     */
    public function attuale() {
        return ( ( $this->fine > time() ) || ( !$this->fine ) );
    }

    /**
     * Ritorna veicolo
     * @return Object Veicolo
     */
    public function veicolo() {
        return Veicolo::id($this->veicolo);
    }

    /**
     * Ritorna autoparco
     * @return Object Autoparco
     */
    public function autoparco() {
        return Autoparco::id($this->veicolo()->autoparco);
    }

    /**
     * Ritorna la data di inizio collocazione
     * @return DT
     */
    public function inizio() {
    	if ( $this->inizio ){
    		return date('d/m/Y H:i', $this->inizio);
    	}else{
    		return "Indeterminato";
    	}
    }

    /**
     * Ritorna la data di fine collocazione
     * @return DT
     */
    public function fine() {
    	if ( $this->fine ){
    		return date('d/m/Y H:i', $this->fine);
    	}else{
    		return "Indeterminato";
    	}
    }
    
    /**
     * Ritorna oggetto volontario che ha dichiarato fuoriuso
     * @return Object Volontatario
     */
    public function pInizio() {
        return Volontario::id($this->pInizio);
    }

}
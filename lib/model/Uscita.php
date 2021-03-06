<?php

class Uscita extends Fattura
{

  protected $stato_string = array(
    self::NON_PAGATA => 'non pagata',
    self::PAGATA     => 'pagata',
    self::RIFIUTATA  => 'rifiutata',
    self::INVIATA    => 'inviata'
  );
                                  
  protected $color_stato = array(
    self::NON_PAGATA => 'red',
    self::PAGATA     => 'green',
    self::RIFIUTATA  => 'white',
    self::INVIATA    => 'white'
  );
                                 
  public function __construct()
  {
    parent::__construct();
    $this->setClassKey(FatturaPeer::CLASSKEY_3);
  }

  public function checkInRitardo()
  {
    return strtotime($this->getDataScadenza()) < time() && $this->getStato() == self::NON_PAGATA;
  }

  public function  addToCashFlow(CashFlow $cf)
  {
    $cash_flow_entrance = new CashFlowExitAdapter($this);
    $cf->addOutcoming($cash_flow_entrance);;
  }
}

<?php

class FinancialDocumentPeer extends FatturaPeer
{
  public static function doSelect(Criteria $criteria, PropelPDO $con = null)
  {
    $criteria->add(FatturaPeer::NUM_FATTURA, 0, Criteria::NOT_EQUAL);
    $criteria->add(FatturaPeer::CLASS_KEY, array(FatturaPeer::CLASSKEY_ACQUISTO, FatturaPeer::CLASSKEY_VENDITA), Criteria::IN);
    return parent::doSelect($criteria, $con);
  }

  public static function  doSelectPaid(Criteria $criteria = null)
  {
    $criteria->add(FatturaPeer::NUM_FATTURA, 0, Criteria::NOT_EQUAL);
    $criteria->add(FatturaPeer::CLASS_KEY, array(FatturaPeer::CLASSKEY_ACQUISTO, FatturaPeer::CLASSKEY_VENDITA), Criteria::IN);
    return parent::doSelectPaid($criteria);
  }

  public static function  doSelectTurnover($year, $month = null, Criteria $criteria = null)
  {
    if (null === $criteria)
    {
      $criteria = new Criteria();
    }
    
    $criteria->add(FatturaPeer::NUM_FATTURA, 0, Criteria::NOT_EQUAL);
    $criteria->add(FatturaPeer::CLASS_KEY, array(FatturaPeer::CLASSKEY_ACQUISTO, FatturaPeer::CLASSKEY_VENDITA), Criteria::IN);
    return parent::doSelectTurnover($year, $month, $criteria);
  }
}

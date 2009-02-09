<?php


abstract class BaseDettagliFatturaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'dettagli_fattura';

	
	const CLASS_DEFAULT = 'lib.model.DettagliFattura';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'dettagli_fattura.ID';

	
	const FATTURA_ID = 'dettagli_fattura.FATTURA_ID';

	
	const DESCRIZIONE = 'dettagli_fattura.DESCRIZIONE';

	
	const QTY = 'dettagli_fattura.QTY';

	
	const SCONTO = 'dettagli_fattura.SCONTO';

	
	const IVA = 'dettagli_fattura.IVA';

	
	const PREZZO = 'dettagli_fattura.PREZZO';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'FatturaId', 'Descrizione', 'Qty', 'Sconto', 'Iva', 'Prezzo', ),
		BasePeer::TYPE_COLNAME => array (DettagliFatturaPeer::ID, DettagliFatturaPeer::FATTURA_ID, DettagliFatturaPeer::DESCRIZIONE, DettagliFatturaPeer::QTY, DettagliFatturaPeer::SCONTO, DettagliFatturaPeer::IVA, DettagliFatturaPeer::PREZZO, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'fattura_id', 'descrizione', 'qty', 'sconto', 'iva', 'prezzo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'FatturaId' => 1, 'Descrizione' => 2, 'Qty' => 3, 'Sconto' => 4, 'Iva' => 5, 'Prezzo' => 6, ),
		BasePeer::TYPE_COLNAME => array (DettagliFatturaPeer::ID => 0, DettagliFatturaPeer::FATTURA_ID => 1, DettagliFatturaPeer::DESCRIZIONE => 2, DettagliFatturaPeer::QTY => 3, DettagliFatturaPeer::SCONTO => 4, DettagliFatturaPeer::IVA => 5, DettagliFatturaPeer::PREZZO => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'fattura_id' => 1, 'descrizione' => 2, 'qty' => 3, 'sconto' => 4, 'iva' => 5, 'prezzo' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.map.DettagliFatturaMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DettagliFatturaPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(DettagliFatturaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DettagliFatturaPeer::ID);

		$criteria->addSelectColumn(DettagliFatturaPeer::FATTURA_ID);

		$criteria->addSelectColumn(DettagliFatturaPeer::DESCRIZIONE);

		$criteria->addSelectColumn(DettagliFatturaPeer::QTY);

		$criteria->addSelectColumn(DettagliFatturaPeer::SCONTO);

		$criteria->addSelectColumn(DettagliFatturaPeer::IVA);

		$criteria->addSelectColumn(DettagliFatturaPeer::PREZZO);

	}

	const COUNT = 'COUNT(dettagli_fattura.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT dettagli_fattura.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DettagliFatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DettagliFatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DettagliFatturaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = DettagliFatturaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DettagliFatturaPeer::populateObjects(DettagliFatturaPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DettagliFatturaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DettagliFatturaPeer::getOMClass();
		$cls = sfPropel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinFattura(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DettagliFatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DettagliFatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DettagliFatturaPeer::FATTURA_ID, FatturaPeer::ID);

		$rs = DettagliFatturaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinFattura(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DettagliFatturaPeer::addSelectColumns($c);
		$startcol = (DettagliFatturaPeer::NUM_COLUMNS - DettagliFatturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FatturaPeer::addSelectColumns($c);

		$c->addJoin(DettagliFatturaPeer::FATTURA_ID, FatturaPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DettagliFatturaPeer::getOMClass();

			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FatturaPeer::getOMClass($rs, $startcol);

			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFattura(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDettagliFattura($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDettagliFatturas();
				$obj2->addDettagliFattura($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DettagliFatturaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DettagliFatturaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DettagliFatturaPeer::FATTURA_ID, FatturaPeer::ID);

		$rs = DettagliFatturaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DettagliFatturaPeer::addSelectColumns($c);
		$startcol2 = (DettagliFatturaPeer::NUM_COLUMNS - DettagliFatturaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FatturaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FatturaPeer::NUM_COLUMNS;

		$c->addJoin(DettagliFatturaPeer::FATTURA_ID, FatturaPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DettagliFatturaPeer::getOMClass();


			$cls = sfPropel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = FatturaPeer::getOMClass($rs, $startcol2);


			$cls = sfPropel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFattura(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDettagliFattura($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDettagliFatturas();
				$obj2->addDettagliFattura($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array();
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return DettagliFatturaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DettagliFatturaPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(DettagliFatturaPeer::ID);
			$selectCriteria->add(DettagliFatturaPeer::ID, $criteria->remove(DettagliFatturaPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(DettagliFatturaPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(DettagliFatturaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DettagliFattura) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DettagliFatturaPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(DettagliFattura $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DettagliFatturaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DettagliFatturaPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(DettagliFatturaPeer::DATABASE_NAME, DettagliFatturaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DettagliFatturaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(DettagliFatturaPeer::DATABASE_NAME);

		$criteria->add(DettagliFatturaPeer::ID, $pk);


		$v = DettagliFatturaPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(DettagliFatturaPeer::ID, $pks, Criteria::IN);
			$objs = DettagliFatturaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDettagliFatturaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			Propel::registerMapBuilder('lib.model.map.DettagliFatturaMapBuilder');
}

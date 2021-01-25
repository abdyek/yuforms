<?php

namespace Map;

use \Submit;
use \SubmitQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'submit' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SubmitTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SubmitTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'yuforms';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'submit';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Submit';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Submit';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id field
     */
    const COL_ID = 'submit.id';

    /**
     * the column name for the response field
     */
    const COL_RESPONSE = 'submit.response';

    /**
     * the column name for the multi_response field
     */
    const COL_MULTI_RESPONSE = 'submit.multi_response';

    /**
     * the column name for the ip_address field
     */
    const COL_IP_ADDRESS = 'submit.ip_address';

    /**
     * the column name for the form_item_id field
     */
    const COL_FORM_ITEM_ID = 'submit.form_item_id';

    /**
     * the column name for the share_id field
     */
    const COL_SHARE_ID = 'submit.share_id';

    /**
     * the column name for the member_id field
     */
    const COL_MEMBER_ID = 'submit.member_id';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Response', 'MultiResponse', 'IpAddress', 'FormItemId', 'ShareId', 'MemberId', ),
        self::TYPE_CAMELNAME     => array('id', 'response', 'multiResponse', 'ipAddress', 'formItemId', 'shareId', 'memberId', ),
        self::TYPE_COLNAME       => array(SubmitTableMap::COL_ID, SubmitTableMap::COL_RESPONSE, SubmitTableMap::COL_MULTI_RESPONSE, SubmitTableMap::COL_IP_ADDRESS, SubmitTableMap::COL_FORM_ITEM_ID, SubmitTableMap::COL_SHARE_ID, SubmitTableMap::COL_MEMBER_ID, ),
        self::TYPE_FIELDNAME     => array('id', 'response', 'multi_response', 'ip_address', 'form_item_id', 'share_id', 'member_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Response' => 1, 'MultiResponse' => 2, 'IpAddress' => 3, 'FormItemId' => 4, 'ShareId' => 5, 'MemberId' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'response' => 1, 'multiResponse' => 2, 'ipAddress' => 3, 'formItemId' => 4, 'shareId' => 5, 'memberId' => 6, ),
        self::TYPE_COLNAME       => array(SubmitTableMap::COL_ID => 0, SubmitTableMap::COL_RESPONSE => 1, SubmitTableMap::COL_MULTI_RESPONSE => 2, SubmitTableMap::COL_IP_ADDRESS => 3, SubmitTableMap::COL_FORM_ITEM_ID => 4, SubmitTableMap::COL_SHARE_ID => 5, SubmitTableMap::COL_MEMBER_ID => 6, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'response' => 1, 'multi_response' => 2, 'ip_address' => 3, 'form_item_id' => 4, 'share_id' => 5, 'member_id' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Id' => 'ID',
        'Submit.Id' => 'ID',
        'id' => 'ID',
        'submit.id' => 'ID',
        'SubmitTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'id' => 'ID',
        'submit.id' => 'ID',
        'Response' => 'RESPONSE',
        'Submit.Response' => 'RESPONSE',
        'response' => 'RESPONSE',
        'submit.response' => 'RESPONSE',
        'SubmitTableMap::COL_RESPONSE' => 'RESPONSE',
        'COL_RESPONSE' => 'RESPONSE',
        'response' => 'RESPONSE',
        'submit.response' => 'RESPONSE',
        'MultiResponse' => 'MULTI_RESPONSE',
        'Submit.MultiResponse' => 'MULTI_RESPONSE',
        'multiResponse' => 'MULTI_RESPONSE',
        'submit.multiResponse' => 'MULTI_RESPONSE',
        'SubmitTableMap::COL_MULTI_RESPONSE' => 'MULTI_RESPONSE',
        'COL_MULTI_RESPONSE' => 'MULTI_RESPONSE',
        'multi_response' => 'MULTI_RESPONSE',
        'submit.multi_response' => 'MULTI_RESPONSE',
        'IpAddress' => 'IP_ADDRESS',
        'Submit.IpAddress' => 'IP_ADDRESS',
        'ipAddress' => 'IP_ADDRESS',
        'submit.ipAddress' => 'IP_ADDRESS',
        'SubmitTableMap::COL_IP_ADDRESS' => 'IP_ADDRESS',
        'COL_IP_ADDRESS' => 'IP_ADDRESS',
        'ip_address' => 'IP_ADDRESS',
        'submit.ip_address' => 'IP_ADDRESS',
        'FormItemId' => 'FORM_ITEM_ID',
        'Submit.FormItemId' => 'FORM_ITEM_ID',
        'formItemId' => 'FORM_ITEM_ID',
        'submit.formItemId' => 'FORM_ITEM_ID',
        'SubmitTableMap::COL_FORM_ITEM_ID' => 'FORM_ITEM_ID',
        'COL_FORM_ITEM_ID' => 'FORM_ITEM_ID',
        'form_item_id' => 'FORM_ITEM_ID',
        'submit.form_item_id' => 'FORM_ITEM_ID',
        'ShareId' => 'SHARE_ID',
        'Submit.ShareId' => 'SHARE_ID',
        'shareId' => 'SHARE_ID',
        'submit.shareId' => 'SHARE_ID',
        'SubmitTableMap::COL_SHARE_ID' => 'SHARE_ID',
        'COL_SHARE_ID' => 'SHARE_ID',
        'share_id' => 'SHARE_ID',
        'submit.share_id' => 'SHARE_ID',
        'MemberId' => 'MEMBER_ID',
        'Submit.MemberId' => 'MEMBER_ID',
        'memberId' => 'MEMBER_ID',
        'submit.memberId' => 'MEMBER_ID',
        'SubmitTableMap::COL_MEMBER_ID' => 'MEMBER_ID',
        'COL_MEMBER_ID' => 'MEMBER_ID',
        'member_id' => 'MEMBER_ID',
        'submit.member_id' => 'MEMBER_ID',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('submit');
        $this->setPhpName('Submit');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Submit');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('response', 'Response', 'VARCHAR', true, 256, null);
        $this->addColumn('multi_response', 'MultiResponse', 'BOOLEAN', true, 1, false);
        $this->addColumn('ip_address', 'IpAddress', 'VARCHAR', false, 15, null);
        $this->addForeignKey('form_item_id', 'FormItemId', 'INTEGER', 'form_item', 'id', true, null, null);
        $this->addForeignKey('share_id', 'ShareId', 'INTEGER', 'share', 'id', true, null, null);
        $this->addForeignKey('member_id', 'MemberId', 'INTEGER', 'member', 'id', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('FormItem', '\\FormItem', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':form_item_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Share', '\\Share', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':share_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Member', '\\Member', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':member_id',
    1 => ':id',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? SubmitTableMap::CLASS_DEFAULT : SubmitTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Submit object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SubmitTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SubmitTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SubmitTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SubmitTableMap::OM_CLASS;
            /** @var Submit $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SubmitTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SubmitTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SubmitTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Submit $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SubmitTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SubmitTableMap::COL_ID);
            $criteria->addSelectColumn(SubmitTableMap::COL_RESPONSE);
            $criteria->addSelectColumn(SubmitTableMap::COL_MULTI_RESPONSE);
            $criteria->addSelectColumn(SubmitTableMap::COL_IP_ADDRESS);
            $criteria->addSelectColumn(SubmitTableMap::COL_FORM_ITEM_ID);
            $criteria->addSelectColumn(SubmitTableMap::COL_SHARE_ID);
            $criteria->addSelectColumn(SubmitTableMap::COL_MEMBER_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.response');
            $criteria->addSelectColumn($alias . '.multi_response');
            $criteria->addSelectColumn($alias . '.ip_address');
            $criteria->addSelectColumn($alias . '.form_item_id');
            $criteria->addSelectColumn($alias . '.share_id');
            $criteria->addSelectColumn($alias . '.member_id');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria object containing the columns to remove.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function removeSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(SubmitTableMap::COL_ID);
            $criteria->removeSelectColumn(SubmitTableMap::COL_RESPONSE);
            $criteria->removeSelectColumn(SubmitTableMap::COL_MULTI_RESPONSE);
            $criteria->removeSelectColumn(SubmitTableMap::COL_IP_ADDRESS);
            $criteria->removeSelectColumn(SubmitTableMap::COL_FORM_ITEM_ID);
            $criteria->removeSelectColumn(SubmitTableMap::COL_SHARE_ID);
            $criteria->removeSelectColumn(SubmitTableMap::COL_MEMBER_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.response');
            $criteria->removeSelectColumn($alias . '.multi_response');
            $criteria->removeSelectColumn($alias . '.ip_address');
            $criteria->removeSelectColumn($alias . '.form_item_id');
            $criteria->removeSelectColumn($alias . '.share_id');
            $criteria->removeSelectColumn($alias . '.member_id');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(SubmitTableMap::DATABASE_NAME)->getTable(SubmitTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SubmitTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SubmitTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SubmitTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Submit or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Submit object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SubmitTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Submit) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SubmitTableMap::DATABASE_NAME);
            $criteria->add(SubmitTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SubmitQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SubmitTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SubmitTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the submit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SubmitQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Submit or Criteria object.
     *
     * @param mixed               $criteria Criteria or Submit object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SubmitTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Submit object
        }

        if ($criteria->containsKey(SubmitTableMap::COL_ID) && $criteria->keyContainsValue(SubmitTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SubmitTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SubmitQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SubmitTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SubmitTableMap::buildTableMap();

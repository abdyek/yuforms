<?php

namespace Map;

use \Share;
use \ShareQuery;
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
 * This class defines the structure of the 'share' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ShareTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ShareTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'yuforms';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'share';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Share';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Share';

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
    const COL_ID = 'share.id';

    /**
     * the column name for the start_date_time field
     */
    const COL_START_DATE_TIME = 'share.start_date_time';

    /**
     * the column name for the stop_date_time field
     */
    const COL_STOP_DATE_TIME = 'share.stop_date_time';

    /**
     * the column name for the session_type field
     */
    const COL_SESSION_TYPE = 'share.session_type';

    /**
     * the column name for the submit_count field
     */
    const COL_SUBMIT_COUNT = 'share.submit_count';

    /**
     * the column name for the member_id field
     */
    const COL_MEMBER_ID = 'share.member_id';

    /**
     * the column name for the form_id field
     */
    const COL_FORM_ID = 'share.form_id';

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
        self::TYPE_PHPNAME       => array('Id', 'StartDateTime', 'StopDateTime', 'SessionType', 'SubmitCount', 'MemberId', 'FormId', ),
        self::TYPE_CAMELNAME     => array('id', 'startDateTime', 'stopDateTime', 'sessionType', 'submitCount', 'memberId', 'formId', ),
        self::TYPE_COLNAME       => array(ShareTableMap::COL_ID, ShareTableMap::COL_START_DATE_TIME, ShareTableMap::COL_STOP_DATE_TIME, ShareTableMap::COL_SESSION_TYPE, ShareTableMap::COL_SUBMIT_COUNT, ShareTableMap::COL_MEMBER_ID, ShareTableMap::COL_FORM_ID, ),
        self::TYPE_FIELDNAME     => array('id', 'start_date_time', 'stop_date_time', 'session_type', 'submit_count', 'member_id', 'form_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'StartDateTime' => 1, 'StopDateTime' => 2, 'SessionType' => 3, 'SubmitCount' => 4, 'MemberId' => 5, 'FormId' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'startDateTime' => 1, 'stopDateTime' => 2, 'sessionType' => 3, 'submitCount' => 4, 'memberId' => 5, 'formId' => 6, ),
        self::TYPE_COLNAME       => array(ShareTableMap::COL_ID => 0, ShareTableMap::COL_START_DATE_TIME => 1, ShareTableMap::COL_STOP_DATE_TIME => 2, ShareTableMap::COL_SESSION_TYPE => 3, ShareTableMap::COL_SUBMIT_COUNT => 4, ShareTableMap::COL_MEMBER_ID => 5, ShareTableMap::COL_FORM_ID => 6, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'start_date_time' => 1, 'stop_date_time' => 2, 'session_type' => 3, 'submit_count' => 4, 'member_id' => 5, 'form_id' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Id' => 'ID',
        'Share.Id' => 'ID',
        'id' => 'ID',
        'share.id' => 'ID',
        'ShareTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'id' => 'ID',
        'share.id' => 'ID',
        'StartDateTime' => 'START_DATE_TIME',
        'Share.StartDateTime' => 'START_DATE_TIME',
        'startDateTime' => 'START_DATE_TIME',
        'share.startDateTime' => 'START_DATE_TIME',
        'ShareTableMap::COL_START_DATE_TIME' => 'START_DATE_TIME',
        'COL_START_DATE_TIME' => 'START_DATE_TIME',
        'start_date_time' => 'START_DATE_TIME',
        'share.start_date_time' => 'START_DATE_TIME',
        'StopDateTime' => 'STOP_DATE_TIME',
        'Share.StopDateTime' => 'STOP_DATE_TIME',
        'stopDateTime' => 'STOP_DATE_TIME',
        'share.stopDateTime' => 'STOP_DATE_TIME',
        'ShareTableMap::COL_STOP_DATE_TIME' => 'STOP_DATE_TIME',
        'COL_STOP_DATE_TIME' => 'STOP_DATE_TIME',
        'stop_date_time' => 'STOP_DATE_TIME',
        'share.stop_date_time' => 'STOP_DATE_TIME',
        'SessionType' => 'SESSION_TYPE',
        'Share.SessionType' => 'SESSION_TYPE',
        'sessionType' => 'SESSION_TYPE',
        'share.sessionType' => 'SESSION_TYPE',
        'ShareTableMap::COL_SESSION_TYPE' => 'SESSION_TYPE',
        'COL_SESSION_TYPE' => 'SESSION_TYPE',
        'session_type' => 'SESSION_TYPE',
        'share.session_type' => 'SESSION_TYPE',
        'SubmitCount' => 'SUBMIT_COUNT',
        'Share.SubmitCount' => 'SUBMIT_COUNT',
        'submitCount' => 'SUBMIT_COUNT',
        'share.submitCount' => 'SUBMIT_COUNT',
        'ShareTableMap::COL_SUBMIT_COUNT' => 'SUBMIT_COUNT',
        'COL_SUBMIT_COUNT' => 'SUBMIT_COUNT',
        'submit_count' => 'SUBMIT_COUNT',
        'share.submit_count' => 'SUBMIT_COUNT',
        'MemberId' => 'MEMBER_ID',
        'Share.MemberId' => 'MEMBER_ID',
        'memberId' => 'MEMBER_ID',
        'share.memberId' => 'MEMBER_ID',
        'ShareTableMap::COL_MEMBER_ID' => 'MEMBER_ID',
        'COL_MEMBER_ID' => 'MEMBER_ID',
        'member_id' => 'MEMBER_ID',
        'share.member_id' => 'MEMBER_ID',
        'FormId' => 'FORM_ID',
        'Share.FormId' => 'FORM_ID',
        'formId' => 'FORM_ID',
        'share.formId' => 'FORM_ID',
        'ShareTableMap::COL_FORM_ID' => 'FORM_ID',
        'COL_FORM_ID' => 'FORM_ID',
        'form_id' => 'FORM_ID',
        'share.form_id' => 'FORM_ID',
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
        $this->setName('share');
        $this->setPhpName('Share');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Share');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('start_date_time', 'StartDateTime', 'TIMESTAMP', true, null, null);
        $this->addColumn('stop_date_time', 'StopDateTime', 'TIMESTAMP', true, null, null);
        $this->addColumn('session_type', 'SessionType', 'VARCHAR', true, 20, null);
        $this->addColumn('submit_count', 'SubmitCount', 'INTEGER', true, null, 0);
        $this->addForeignKey('member_id', 'MemberId', 'INTEGER', 'member', 'id', true, null, null);
        $this->addForeignKey('form_id', 'FormId', 'INTEGER', 'form', 'id', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Member', '\\Member', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':member_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Form', '\\Form', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':form_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Submit', '\\Submit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':share_id',
    1 => ':id',
  ),
), null, null, 'Submits', false);
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
        return $withPrefix ? ShareTableMap::CLASS_DEFAULT : ShareTableMap::OM_CLASS;
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
     * @return array           (Share object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ShareTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ShareTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ShareTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ShareTableMap::OM_CLASS;
            /** @var Share $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ShareTableMap::addInstanceToPool($obj, $key);
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
            $key = ShareTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ShareTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Share $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ShareTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ShareTableMap::COL_ID);
            $criteria->addSelectColumn(ShareTableMap::COL_START_DATE_TIME);
            $criteria->addSelectColumn(ShareTableMap::COL_STOP_DATE_TIME);
            $criteria->addSelectColumn(ShareTableMap::COL_SESSION_TYPE);
            $criteria->addSelectColumn(ShareTableMap::COL_SUBMIT_COUNT);
            $criteria->addSelectColumn(ShareTableMap::COL_MEMBER_ID);
            $criteria->addSelectColumn(ShareTableMap::COL_FORM_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.start_date_time');
            $criteria->addSelectColumn($alias . '.stop_date_time');
            $criteria->addSelectColumn($alias . '.session_type');
            $criteria->addSelectColumn($alias . '.submit_count');
            $criteria->addSelectColumn($alias . '.member_id');
            $criteria->addSelectColumn($alias . '.form_id');
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
            $criteria->removeSelectColumn(ShareTableMap::COL_ID);
            $criteria->removeSelectColumn(ShareTableMap::COL_START_DATE_TIME);
            $criteria->removeSelectColumn(ShareTableMap::COL_STOP_DATE_TIME);
            $criteria->removeSelectColumn(ShareTableMap::COL_SESSION_TYPE);
            $criteria->removeSelectColumn(ShareTableMap::COL_SUBMIT_COUNT);
            $criteria->removeSelectColumn(ShareTableMap::COL_MEMBER_ID);
            $criteria->removeSelectColumn(ShareTableMap::COL_FORM_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.start_date_time');
            $criteria->removeSelectColumn($alias . '.stop_date_time');
            $criteria->removeSelectColumn($alias . '.session_type');
            $criteria->removeSelectColumn($alias . '.submit_count');
            $criteria->removeSelectColumn($alias . '.member_id');
            $criteria->removeSelectColumn($alias . '.form_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(ShareTableMap::DATABASE_NAME)->getTable(ShareTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ShareTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ShareTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ShareTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Share or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Share object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ShareTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Share) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ShareTableMap::DATABASE_NAME);
            $criteria->add(ShareTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ShareQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ShareTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ShareTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the share table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ShareQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Share or Criteria object.
     *
     * @param mixed               $criteria Criteria or Share object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShareTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Share object
        }

        if ($criteria->containsKey(ShareTableMap::COL_ID) && $criteria->keyContainsValue(ShareTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ShareTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ShareQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ShareTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ShareTableMap::buildTableMap();

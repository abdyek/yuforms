<?php

namespace Map;

use \Form;
use \FormQuery;
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
 * This class defines the structure of the 'form' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class FormTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.FormTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'yuforms';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'form';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Form';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Form';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id field
     */
    const COL_ID = 'form.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'form.name';

    /**
     * the column name for the create_date_time field
     */
    const COL_CREATE_DATE_TIME = 'form.create_date_time';

    /**
     * the column name for the last_edit_date_time field
     */
    const COL_LAST_EDIT_DATE_TIME = 'form.last_edit_date_time';

    /**
     * the column name for the member_id field
     */
    const COL_MEMBER_ID = 'form.member_id';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'CreateDateTime', 'LastEditDateTime', 'MemberId', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'createDateTime', 'lastEditDateTime', 'memberId', ),
        self::TYPE_COLNAME       => array(FormTableMap::COL_ID, FormTableMap::COL_NAME, FormTableMap::COL_CREATE_DATE_TIME, FormTableMap::COL_LAST_EDIT_DATE_TIME, FormTableMap::COL_MEMBER_ID, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'create_date_time', 'last_edit_date_time', 'member_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'CreateDateTime' => 2, 'LastEditDateTime' => 3, 'MemberId' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'createDateTime' => 2, 'lastEditDateTime' => 3, 'memberId' => 4, ),
        self::TYPE_COLNAME       => array(FormTableMap::COL_ID => 0, FormTableMap::COL_NAME => 1, FormTableMap::COL_CREATE_DATE_TIME => 2, FormTableMap::COL_LAST_EDIT_DATE_TIME => 3, FormTableMap::COL_MEMBER_ID => 4, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'create_date_time' => 2, 'last_edit_date_time' => 3, 'member_id' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Id' => 'ID',
        'Form.Id' => 'ID',
        'id' => 'ID',
        'form.id' => 'ID',
        'FormTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'id' => 'ID',
        'form.id' => 'ID',
        'Name' => 'NAME',
        'Form.Name' => 'NAME',
        'name' => 'NAME',
        'form.name' => 'NAME',
        'FormTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'name' => 'NAME',
        'form.name' => 'NAME',
        'CreateDateTime' => 'CREATE_DATE_TIME',
        'Form.CreateDateTime' => 'CREATE_DATE_TIME',
        'createDateTime' => 'CREATE_DATE_TIME',
        'form.createDateTime' => 'CREATE_DATE_TIME',
        'FormTableMap::COL_CREATE_DATE_TIME' => 'CREATE_DATE_TIME',
        'COL_CREATE_DATE_TIME' => 'CREATE_DATE_TIME',
        'create_date_time' => 'CREATE_DATE_TIME',
        'form.create_date_time' => 'CREATE_DATE_TIME',
        'LastEditDateTime' => 'LAST_EDIT_DATE_TIME',
        'Form.LastEditDateTime' => 'LAST_EDIT_DATE_TIME',
        'lastEditDateTime' => 'LAST_EDIT_DATE_TIME',
        'form.lastEditDateTime' => 'LAST_EDIT_DATE_TIME',
        'FormTableMap::COL_LAST_EDIT_DATE_TIME' => 'LAST_EDIT_DATE_TIME',
        'COL_LAST_EDIT_DATE_TIME' => 'LAST_EDIT_DATE_TIME',
        'last_edit_date_time' => 'LAST_EDIT_DATE_TIME',
        'form.last_edit_date_time' => 'LAST_EDIT_DATE_TIME',
        'MemberId' => 'MEMBER_ID',
        'Form.MemberId' => 'MEMBER_ID',
        'memberId' => 'MEMBER_ID',
        'form.memberId' => 'MEMBER_ID',
        'FormTableMap::COL_MEMBER_ID' => 'MEMBER_ID',
        'COL_MEMBER_ID' => 'MEMBER_ID',
        'member_id' => 'MEMBER_ID',
        'form.member_id' => 'MEMBER_ID',
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
        $this->setName('form');
        $this->setPhpName('Form');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Form');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('create_date_time', 'CreateDateTime', 'TIMESTAMP', true, null, null);
        $this->addColumn('last_edit_date_time', 'LastEditDateTime', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('member_id', 'MemberId', 'INTEGER', 'member', 'id', true, null, null);
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
        $this->addRelation('Share', '\\Share', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':form_id',
    1 => ':id',
  ),
), null, null, 'Shares', false);
        $this->addRelation('FormItem', '\\FormItem', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':form_id',
    1 => ':id',
  ),
), null, null, 'FormItems', false);
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
        return $withPrefix ? FormTableMap::CLASS_DEFAULT : FormTableMap::OM_CLASS;
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
     * @return array           (Form object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FormTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FormTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FormTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FormTableMap::OM_CLASS;
            /** @var Form $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FormTableMap::addInstanceToPool($obj, $key);
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
            $key = FormTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FormTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Form $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FormTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FormTableMap::COL_ID);
            $criteria->addSelectColumn(FormTableMap::COL_NAME);
            $criteria->addSelectColumn(FormTableMap::COL_CREATE_DATE_TIME);
            $criteria->addSelectColumn(FormTableMap::COL_LAST_EDIT_DATE_TIME);
            $criteria->addSelectColumn(FormTableMap::COL_MEMBER_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.create_date_time');
            $criteria->addSelectColumn($alias . '.last_edit_date_time');
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
            $criteria->removeSelectColumn(FormTableMap::COL_ID);
            $criteria->removeSelectColumn(FormTableMap::COL_NAME);
            $criteria->removeSelectColumn(FormTableMap::COL_CREATE_DATE_TIME);
            $criteria->removeSelectColumn(FormTableMap::COL_LAST_EDIT_DATE_TIME);
            $criteria->removeSelectColumn(FormTableMap::COL_MEMBER_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.create_date_time');
            $criteria->removeSelectColumn($alias . '.last_edit_date_time');
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
        return Propel::getServiceContainer()->getDatabaseMap(FormTableMap::DATABASE_NAME)->getTable(FormTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FormTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FormTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FormTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Form or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Form object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FormTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Form) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FormTableMap::DATABASE_NAME);
            $criteria->add(FormTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = FormQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FormTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FormTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the form table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FormQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Form or Criteria object.
     *
     * @param mixed               $criteria Criteria or Form object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Form object
        }

        if ($criteria->containsKey(FormTableMap::COL_ID) && $criteria->keyContainsValue(FormTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FormTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = FormQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FormTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FormTableMap::buildTableMap();

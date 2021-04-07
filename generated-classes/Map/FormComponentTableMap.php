<?php

namespace Map;

use \FormComponent;
use \FormComponentQuery;
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
 * This class defines the structure of the 'form_component' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class FormComponentTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.FormComponentTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'yuforms';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'form_component';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\FormComponent';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'FormComponent';

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
    const COL_ID = 'form_component.id';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'form_component.title';

    /**
     * the column name for the form_component_name field
     */
    const COL_FORM_COMPONENT_NAME = 'form_component.form_component_name';

    /**
     * the column name for the has_options field
     */
    const COL_HAS_OPTIONS = 'form_component.has_options';

    /**
     * the column name for the multi_response field
     */
    const COL_MULTI_RESPONSE = 'form_component.multi_response';

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
        self::TYPE_PHPNAME       => array('Id', 'Title', 'FormComponentName', 'HasOptions', 'MultiResponse', ),
        self::TYPE_CAMELNAME     => array('id', 'title', 'formComponentName', 'hasOptions', 'multiResponse', ),
        self::TYPE_COLNAME       => array(FormComponentTableMap::COL_ID, FormComponentTableMap::COL_TITLE, FormComponentTableMap::COL_FORM_COMPONENT_NAME, FormComponentTableMap::COL_HAS_OPTIONS, FormComponentTableMap::COL_MULTI_RESPONSE, ),
        self::TYPE_FIELDNAME     => array('id', 'title', 'form_component_name', 'has_options', 'multi_response', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Title' => 1, 'FormComponentName' => 2, 'HasOptions' => 3, 'MultiResponse' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'title' => 1, 'formComponentName' => 2, 'hasOptions' => 3, 'multiResponse' => 4, ),
        self::TYPE_COLNAME       => array(FormComponentTableMap::COL_ID => 0, FormComponentTableMap::COL_TITLE => 1, FormComponentTableMap::COL_FORM_COMPONENT_NAME => 2, FormComponentTableMap::COL_HAS_OPTIONS => 3, FormComponentTableMap::COL_MULTI_RESPONSE => 4, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'title' => 1, 'form_component_name' => 2, 'has_options' => 3, 'multi_response' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Id' => 'ID',
        'FormComponent.Id' => 'ID',
        'id' => 'ID',
        'formComponent.id' => 'ID',
        'FormComponentTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'id' => 'ID',
        'form_component.id' => 'ID',
        'Title' => 'TITLE',
        'FormComponent.Title' => 'TITLE',
        'title' => 'TITLE',
        'formComponent.title' => 'TITLE',
        'FormComponentTableMap::COL_TITLE' => 'TITLE',
        'COL_TITLE' => 'TITLE',
        'title' => 'TITLE',
        'form_component.title' => 'TITLE',
        'FormComponentName' => 'FORM_COMPONENT_NAME',
        'FormComponent.FormComponentName' => 'FORM_COMPONENT_NAME',
        'formComponentName' => 'FORM_COMPONENT_NAME',
        'formComponent.formComponentName' => 'FORM_COMPONENT_NAME',
        'FormComponentTableMap::COL_FORM_COMPONENT_NAME' => 'FORM_COMPONENT_NAME',
        'COL_FORM_COMPONENT_NAME' => 'FORM_COMPONENT_NAME',
        'form_component_name' => 'FORM_COMPONENT_NAME',
        'form_component.form_component_name' => 'FORM_COMPONENT_NAME',
        'HasOptions' => 'HAS_OPTIONS',
        'FormComponent.HasOptions' => 'HAS_OPTIONS',
        'hasOptions' => 'HAS_OPTIONS',
        'formComponent.hasOptions' => 'HAS_OPTIONS',
        'FormComponentTableMap::COL_HAS_OPTIONS' => 'HAS_OPTIONS',
        'COL_HAS_OPTIONS' => 'HAS_OPTIONS',
        'has_options' => 'HAS_OPTIONS',
        'form_component.has_options' => 'HAS_OPTIONS',
        'MultiResponse' => 'MULTI_RESPONSE',
        'FormComponent.MultiResponse' => 'MULTI_RESPONSE',
        'multiResponse' => 'MULTI_RESPONSE',
        'formComponent.multiResponse' => 'MULTI_RESPONSE',
        'FormComponentTableMap::COL_MULTI_RESPONSE' => 'MULTI_RESPONSE',
        'COL_MULTI_RESPONSE' => 'MULTI_RESPONSE',
        'multi_response' => 'MULTI_RESPONSE',
        'form_component.multi_response' => 'MULTI_RESPONSE',
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
        $this->setName('form_component');
        $this->setPhpName('FormComponent');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\FormComponent');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 256, null);
        $this->addColumn('form_component_name', 'FormComponentName', 'VARCHAR', true, 256, null);
        $this->addColumn('has_options', 'HasOptions', 'BOOLEAN', true, 1, false);
        $this->addColumn('multi_response', 'MultiResponse', 'BOOLEAN', true, 1, false);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Question', '\\Question', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':form_component_id',
    1 => ':id',
  ),
), null, null, 'Questions', false);
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
        return $withPrefix ? FormComponentTableMap::CLASS_DEFAULT : FormComponentTableMap::OM_CLASS;
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
     * @return array           (FormComponent object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FormComponentTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FormComponentTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FormComponentTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FormComponentTableMap::OM_CLASS;
            /** @var FormComponent $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FormComponentTableMap::addInstanceToPool($obj, $key);
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
            $key = FormComponentTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FormComponentTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var FormComponent $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FormComponentTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FormComponentTableMap::COL_ID);
            $criteria->addSelectColumn(FormComponentTableMap::COL_TITLE);
            $criteria->addSelectColumn(FormComponentTableMap::COL_FORM_COMPONENT_NAME);
            $criteria->addSelectColumn(FormComponentTableMap::COL_HAS_OPTIONS);
            $criteria->addSelectColumn(FormComponentTableMap::COL_MULTI_RESPONSE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.form_component_name');
            $criteria->addSelectColumn($alias . '.has_options');
            $criteria->addSelectColumn($alias . '.multi_response');
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
            $criteria->removeSelectColumn(FormComponentTableMap::COL_ID);
            $criteria->removeSelectColumn(FormComponentTableMap::COL_TITLE);
            $criteria->removeSelectColumn(FormComponentTableMap::COL_FORM_COMPONENT_NAME);
            $criteria->removeSelectColumn(FormComponentTableMap::COL_HAS_OPTIONS);
            $criteria->removeSelectColumn(FormComponentTableMap::COL_MULTI_RESPONSE);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.title');
            $criteria->removeSelectColumn($alias . '.form_component_name');
            $criteria->removeSelectColumn($alias . '.has_options');
            $criteria->removeSelectColumn($alias . '.multi_response');
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
        return Propel::getServiceContainer()->getDatabaseMap(FormComponentTableMap::DATABASE_NAME)->getTable(FormComponentTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FormComponentTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FormComponentTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FormComponentTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a FormComponent or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or FormComponent object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FormComponentTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \FormComponent) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FormComponentTableMap::DATABASE_NAME);
            $criteria->add(FormComponentTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = FormComponentQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FormComponentTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FormComponentTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the form_component table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FormComponentQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a FormComponent or Criteria object.
     *
     * @param mixed               $criteria Criteria or FormComponent object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormComponentTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from FormComponent object
        }

        if ($criteria->containsKey(FormComponentTableMap::COL_ID) && $criteria->keyContainsValue(FormComponentTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FormComponentTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = FormComponentQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FormComponentTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FormComponentTableMap::buildTableMap();

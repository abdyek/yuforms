<?php

namespace Map;

use \Member;
use \MemberQuery;
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
 * This class defines the structure of the 'member' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class MemberTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.MemberTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'yuforms';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'member';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Member';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Member';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id field
     */
    const COL_ID = 'member.id';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'member.email';

    /**
     * the column name for the first_name field
     */
    const COL_FIRST_NAME = 'member.first_name';

    /**
     * the column name for the last_name field
     */
    const COL_LAST_NAME = 'member.last_name';

    /**
     * the column name for the confirmed_email field
     */
    const COL_CONFIRMED_EMAIL = 'member.confirmed_email';

    /**
     * the column name for the password_hash field
     */
    const COL_PASSWORD_HASH = 'member.password_hash';

    /**
     * the column name for the activation_code field
     */
    const COL_ACTIVATION_CODE = 'member.activation_code';

    /**
     * the column name for the recovery_code field
     */
    const COL_RECOVERY_CODE = 'member.recovery_code';

    /**
     * the column name for the sign_up_date_time field
     */
    const COL_SIGN_UP_DATE_TIME = 'member.sign_up_date_time';

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
        self::TYPE_PHPNAME       => array('Id', 'Email', 'FirstName', 'LastName', 'ConfirmedEmail', 'PasswordHash', 'ActivationCode', 'RecoveryCode', 'SignUpDateTime', ),
        self::TYPE_CAMELNAME     => array('id', 'email', 'firstName', 'lastName', 'confirmedEmail', 'passwordHash', 'activationCode', 'recoveryCode', 'signUpDateTime', ),
        self::TYPE_COLNAME       => array(MemberTableMap::COL_ID, MemberTableMap::COL_EMAIL, MemberTableMap::COL_FIRST_NAME, MemberTableMap::COL_LAST_NAME, MemberTableMap::COL_CONFIRMED_EMAIL, MemberTableMap::COL_PASSWORD_HASH, MemberTableMap::COL_ACTIVATION_CODE, MemberTableMap::COL_RECOVERY_CODE, MemberTableMap::COL_SIGN_UP_DATE_TIME, ),
        self::TYPE_FIELDNAME     => array('id', 'email', 'first_name', 'last_name', 'confirmed_email', 'password_hash', 'activation_code', 'recovery_code', 'sign_up_date_time', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Email' => 1, 'FirstName' => 2, 'LastName' => 3, 'ConfirmedEmail' => 4, 'PasswordHash' => 5, 'ActivationCode' => 6, 'RecoveryCode' => 7, 'SignUpDateTime' => 8, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'email' => 1, 'firstName' => 2, 'lastName' => 3, 'confirmedEmail' => 4, 'passwordHash' => 5, 'activationCode' => 6, 'recoveryCode' => 7, 'signUpDateTime' => 8, ),
        self::TYPE_COLNAME       => array(MemberTableMap::COL_ID => 0, MemberTableMap::COL_EMAIL => 1, MemberTableMap::COL_FIRST_NAME => 2, MemberTableMap::COL_LAST_NAME => 3, MemberTableMap::COL_CONFIRMED_EMAIL => 4, MemberTableMap::COL_PASSWORD_HASH => 5, MemberTableMap::COL_ACTIVATION_CODE => 6, MemberTableMap::COL_RECOVERY_CODE => 7, MemberTableMap::COL_SIGN_UP_DATE_TIME => 8, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'email' => 1, 'first_name' => 2, 'last_name' => 3, 'confirmed_email' => 4, 'password_hash' => 5, 'activation_code' => 6, 'recovery_code' => 7, 'sign_up_date_time' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [

        'Id' => 'ID',
        'Member.Id' => 'ID',
        'id' => 'ID',
        'member.id' => 'ID',
        'MemberTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'id' => 'ID',
        'member.id' => 'ID',
        'Email' => 'EMAIL',
        'Member.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'member.email' => 'EMAIL',
        'MemberTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'email' => 'EMAIL',
        'member.email' => 'EMAIL',
        'FirstName' => 'FIRST_NAME',
        'Member.FirstName' => 'FIRST_NAME',
        'firstName' => 'FIRST_NAME',
        'member.firstName' => 'FIRST_NAME',
        'MemberTableMap::COL_FIRST_NAME' => 'FIRST_NAME',
        'COL_FIRST_NAME' => 'FIRST_NAME',
        'first_name' => 'FIRST_NAME',
        'member.first_name' => 'FIRST_NAME',
        'LastName' => 'LAST_NAME',
        'Member.LastName' => 'LAST_NAME',
        'lastName' => 'LAST_NAME',
        'member.lastName' => 'LAST_NAME',
        'MemberTableMap::COL_LAST_NAME' => 'LAST_NAME',
        'COL_LAST_NAME' => 'LAST_NAME',
        'last_name' => 'LAST_NAME',
        'member.last_name' => 'LAST_NAME',
        'ConfirmedEmail' => 'CONFIRMED_EMAIL',
        'Member.ConfirmedEmail' => 'CONFIRMED_EMAIL',
        'confirmedEmail' => 'CONFIRMED_EMAIL',
        'member.confirmedEmail' => 'CONFIRMED_EMAIL',
        'MemberTableMap::COL_CONFIRMED_EMAIL' => 'CONFIRMED_EMAIL',
        'COL_CONFIRMED_EMAIL' => 'CONFIRMED_EMAIL',
        'confirmed_email' => 'CONFIRMED_EMAIL',
        'member.confirmed_email' => 'CONFIRMED_EMAIL',
        'PasswordHash' => 'PASSWORD_HASH',
        'Member.PasswordHash' => 'PASSWORD_HASH',
        'passwordHash' => 'PASSWORD_HASH',
        'member.passwordHash' => 'PASSWORD_HASH',
        'MemberTableMap::COL_PASSWORD_HASH' => 'PASSWORD_HASH',
        'COL_PASSWORD_HASH' => 'PASSWORD_HASH',
        'password_hash' => 'PASSWORD_HASH',
        'member.password_hash' => 'PASSWORD_HASH',
        'ActivationCode' => 'ACTIVATION_CODE',
        'Member.ActivationCode' => 'ACTIVATION_CODE',
        'activationCode' => 'ACTIVATION_CODE',
        'member.activationCode' => 'ACTIVATION_CODE',
        'MemberTableMap::COL_ACTIVATION_CODE' => 'ACTIVATION_CODE',
        'COL_ACTIVATION_CODE' => 'ACTIVATION_CODE',
        'activation_code' => 'ACTIVATION_CODE',
        'member.activation_code' => 'ACTIVATION_CODE',
        'RecoveryCode' => 'RECOVERY_CODE',
        'Member.RecoveryCode' => 'RECOVERY_CODE',
        'recoveryCode' => 'RECOVERY_CODE',
        'member.recoveryCode' => 'RECOVERY_CODE',
        'MemberTableMap::COL_RECOVERY_CODE' => 'RECOVERY_CODE',
        'COL_RECOVERY_CODE' => 'RECOVERY_CODE',
        'recovery_code' => 'RECOVERY_CODE',
        'member.recovery_code' => 'RECOVERY_CODE',
        'SignUpDateTime' => 'SIGN_UP_DATE_TIME',
        'Member.SignUpDateTime' => 'SIGN_UP_DATE_TIME',
        'signUpDateTime' => 'SIGN_UP_DATE_TIME',
        'member.signUpDateTime' => 'SIGN_UP_DATE_TIME',
        'MemberTableMap::COL_SIGN_UP_DATE_TIME' => 'SIGN_UP_DATE_TIME',
        'COL_SIGN_UP_DATE_TIME' => 'SIGN_UP_DATE_TIME',
        'sign_up_date_time' => 'SIGN_UP_DATE_TIME',
        'member.sign_up_date_time' => 'SIGN_UP_DATE_TIME',
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
        $this->setName('member');
        $this->setPhpName('Member');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Member');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 255, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', true, 50, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', true, 50, null);
        $this->addColumn('confirmed_email', 'ConfirmedEmail', 'BOOLEAN', true, 1, null);
        $this->addColumn('password_hash', 'PasswordHash', 'VARCHAR', true, 60, null);
        $this->addColumn('activation_code', 'ActivationCode', 'VARCHAR', true, 6, null);
        $this->addColumn('recovery_code', 'RecoveryCode', 'VARCHAR', false, 10, null);
        $this->addColumn('sign_up_date_time', 'SignUpDateTime', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Form', '\\Form', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':member_id',
    1 => ':id',
  ),
), null, null, 'Forms', false);
        $this->addRelation('Submit', '\\Submit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':member_id',
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
        return $withPrefix ? MemberTableMap::CLASS_DEFAULT : MemberTableMap::OM_CLASS;
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
     * @return array           (Member object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = MemberTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MemberTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MemberTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MemberTableMap::OM_CLASS;
            /** @var Member $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MemberTableMap::addInstanceToPool($obj, $key);
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
            $key = MemberTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MemberTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Member $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MemberTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(MemberTableMap::COL_ID);
            $criteria->addSelectColumn(MemberTableMap::COL_EMAIL);
            $criteria->addSelectColumn(MemberTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(MemberTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(MemberTableMap::COL_CONFIRMED_EMAIL);
            $criteria->addSelectColumn(MemberTableMap::COL_PASSWORD_HASH);
            $criteria->addSelectColumn(MemberTableMap::COL_ACTIVATION_CODE);
            $criteria->addSelectColumn(MemberTableMap::COL_RECOVERY_CODE);
            $criteria->addSelectColumn(MemberTableMap::COL_SIGN_UP_DATE_TIME);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.confirmed_email');
            $criteria->addSelectColumn($alias . '.password_hash');
            $criteria->addSelectColumn($alias . '.activation_code');
            $criteria->addSelectColumn($alias . '.recovery_code');
            $criteria->addSelectColumn($alias . '.sign_up_date_time');
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
            $criteria->removeSelectColumn(MemberTableMap::COL_ID);
            $criteria->removeSelectColumn(MemberTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(MemberTableMap::COL_FIRST_NAME);
            $criteria->removeSelectColumn(MemberTableMap::COL_LAST_NAME);
            $criteria->removeSelectColumn(MemberTableMap::COL_CONFIRMED_EMAIL);
            $criteria->removeSelectColumn(MemberTableMap::COL_PASSWORD_HASH);
            $criteria->removeSelectColumn(MemberTableMap::COL_ACTIVATION_CODE);
            $criteria->removeSelectColumn(MemberTableMap::COL_RECOVERY_CODE);
            $criteria->removeSelectColumn(MemberTableMap::COL_SIGN_UP_DATE_TIME);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.first_name');
            $criteria->removeSelectColumn($alias . '.last_name');
            $criteria->removeSelectColumn($alias . '.confirmed_email');
            $criteria->removeSelectColumn($alias . '.password_hash');
            $criteria->removeSelectColumn($alias . '.activation_code');
            $criteria->removeSelectColumn($alias . '.recovery_code');
            $criteria->removeSelectColumn($alias . '.sign_up_date_time');
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
        return Propel::getServiceContainer()->getDatabaseMap(MemberTableMap::DATABASE_NAME)->getTable(MemberTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(MemberTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(MemberTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new MemberTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Member or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Member object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(MemberTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Member) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MemberTableMap::DATABASE_NAME);
            $criteria->add(MemberTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = MemberQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MemberTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MemberTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the member table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return MemberQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Member or Criteria object.
     *
     * @param mixed               $criteria Criteria or Member object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MemberTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Member object
        }

        if ($criteria->containsKey(MemberTableMap::COL_ID) && $criteria->keyContainsValue(MemberTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MemberTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = MemberQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // MemberTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
MemberTableMap::buildTableMap();

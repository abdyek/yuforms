<?php

namespace Base;

use \FormItem as ChildFormItem;
use \FormItemQuery as ChildFormItemQuery;
use \Member as ChildMember;
use \MemberQuery as ChildMemberQuery;
use \Share as ChildShare;
use \ShareQuery as ChildShareQuery;
use \SubmitQuery as ChildSubmitQuery;
use \Exception;
use \PDO;
use Map\SubmitTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'submit' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Submit implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\SubmitTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the response field.
     *
     * @var        string
     */
    protected $response;

    /**
     * The value for the multi_response field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $multi_response;

    /**
     * The value for the ip_address field.
     *
     * @var        string|null
     */
    protected $ip_address;

    /**
     * The value for the form_item_id field.
     *
     * @var        int
     */
    protected $form_item_id;

    /**
     * The value for the share_id field.
     *
     * @var        int
     */
    protected $share_id;

    /**
     * The value for the member_id field.
     *
     * @var        int|null
     */
    protected $member_id;

    /**
     * @var        ChildFormItem
     */
    protected $aFormItem;

    /**
     * @var        ChildShare
     */
    protected $aShare;

    /**
     * @var        ChildMember
     */
    protected $aMember;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->multi_response = false;
    }

    /**
     * Initializes internal state of Base\Submit object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Submit</code> instance.  If
     * <code>obj</code> is an instance of <code>Submit</code>, delegates to
     * <code>equals(Submit)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param  string  $keyType                (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [response] column value.
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Get the [multi_response] column value.
     *
     * @return boolean
     */
    public function getMultiResponse()
    {
        return $this->multi_response;
    }

    /**
     * Get the [multi_response] column value.
     *
     * @return boolean
     */
    public function isMultiResponse()
    {
        return $this->getMultiResponse();
    }

    /**
     * Get the [ip_address] column value.
     *
     * @return string|null
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }

    /**
     * Get the [form_item_id] column value.
     *
     * @return int
     */
    public function getFormItemId()
    {
        return $this->form_item_id;
    }

    /**
     * Get the [share_id] column value.
     *
     * @return int
     */
    public function getShareId()
    {
        return $this->share_id;
    }

    /**
     * Get the [member_id] column value.
     *
     * @return int|null
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this|\Submit The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[SubmitTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [response] column.
     *
     * @param string $v New value
     * @return $this|\Submit The current object (for fluent API support)
     */
    public function setResponse($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->response !== $v) {
            $this->response = $v;
            $this->modifiedColumns[SubmitTableMap::COL_RESPONSE] = true;
        }

        return $this;
    } // setResponse()

    /**
     * Sets the value of the [multi_response] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Submit The current object (for fluent API support)
     */
    public function setMultiResponse($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->multi_response !== $v) {
            $this->multi_response = $v;
            $this->modifiedColumns[SubmitTableMap::COL_MULTI_RESPONSE] = true;
        }

        return $this;
    } // setMultiResponse()

    /**
     * Set the value of [ip_address] column.
     *
     * @param string|null $v New value
     * @return $this|\Submit The current object (for fluent API support)
     */
    public function setIpAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ip_address !== $v) {
            $this->ip_address = $v;
            $this->modifiedColumns[SubmitTableMap::COL_IP_ADDRESS] = true;
        }

        return $this;
    } // setIpAddress()

    /**
     * Set the value of [form_item_id] column.
     *
     * @param int $v New value
     * @return $this|\Submit The current object (for fluent API support)
     */
    public function setFormItemId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->form_item_id !== $v) {
            $this->form_item_id = $v;
            $this->modifiedColumns[SubmitTableMap::COL_FORM_ITEM_ID] = true;
        }

        if ($this->aFormItem !== null && $this->aFormItem->getId() !== $v) {
            $this->aFormItem = null;
        }

        return $this;
    } // setFormItemId()

    /**
     * Set the value of [share_id] column.
     *
     * @param int $v New value
     * @return $this|\Submit The current object (for fluent API support)
     */
    public function setShareId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->share_id !== $v) {
            $this->share_id = $v;
            $this->modifiedColumns[SubmitTableMap::COL_SHARE_ID] = true;
        }

        if ($this->aShare !== null && $this->aShare->getId() !== $v) {
            $this->aShare = null;
        }

        return $this;
    } // setShareId()

    /**
     * Set the value of [member_id] column.
     *
     * @param int|null $v New value
     * @return $this|\Submit The current object (for fluent API support)
     */
    public function setMemberId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->member_id !== $v) {
            $this->member_id = $v;
            $this->modifiedColumns[SubmitTableMap::COL_MEMBER_ID] = true;
        }

        if ($this->aMember !== null && $this->aMember->getId() !== $v) {
            $this->aMember = null;
        }

        return $this;
    } // setMemberId()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->multi_response !== false) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SubmitTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SubmitTableMap::translateFieldName('Response', TableMap::TYPE_PHPNAME, $indexType)];
            $this->response = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SubmitTableMap::translateFieldName('MultiResponse', TableMap::TYPE_PHPNAME, $indexType)];
            $this->multi_response = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SubmitTableMap::translateFieldName('IpAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ip_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SubmitTableMap::translateFieldName('FormItemId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->form_item_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SubmitTableMap::translateFieldName('ShareId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->share_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SubmitTableMap::translateFieldName('MemberId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->member_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = SubmitTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Submit'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aFormItem !== null && $this->form_item_id !== $this->aFormItem->getId()) {
            $this->aFormItem = null;
        }
        if ($this->aShare !== null && $this->share_id !== $this->aShare->getId()) {
            $this->aShare = null;
        }
        if ($this->aMember !== null && $this->member_id !== $this->aMember->getId()) {
            $this->aMember = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SubmitTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSubmitQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aFormItem = null;
            $this->aShare = null;
            $this->aMember = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Submit::setDeleted()
     * @see Submit::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SubmitTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSubmitQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SubmitTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                SubmitTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aFormItem !== null) {
                if ($this->aFormItem->isModified() || $this->aFormItem->isNew()) {
                    $affectedRows += $this->aFormItem->save($con);
                }
                $this->setFormItem($this->aFormItem);
            }

            if ($this->aShare !== null) {
                if ($this->aShare->isModified() || $this->aShare->isNew()) {
                    $affectedRows += $this->aShare->save($con);
                }
                $this->setShare($this->aShare);
            }

            if ($this->aMember !== null) {
                if ($this->aMember->isModified() || $this->aMember->isNew()) {
                    $affectedRows += $this->aMember->save($con);
                }
                $this->setMember($this->aMember);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[SubmitTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SubmitTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SubmitTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(SubmitTableMap::COL_RESPONSE)) {
            $modifiedColumns[':p' . $index++]  = 'response';
        }
        if ($this->isColumnModified(SubmitTableMap::COL_MULTI_RESPONSE)) {
            $modifiedColumns[':p' . $index++]  = 'multi_response';
        }
        if ($this->isColumnModified(SubmitTableMap::COL_IP_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'ip_address';
        }
        if ($this->isColumnModified(SubmitTableMap::COL_FORM_ITEM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'form_item_id';
        }
        if ($this->isColumnModified(SubmitTableMap::COL_SHARE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'share_id';
        }
        if ($this->isColumnModified(SubmitTableMap::COL_MEMBER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'member_id';
        }

        $sql = sprintf(
            'INSERT INTO submit (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'response':
                        $stmt->bindValue($identifier, $this->response, PDO::PARAM_STR);
                        break;
                    case 'multi_response':
                        $stmt->bindValue($identifier, (int) $this->multi_response, PDO::PARAM_INT);
                        break;
                    case 'ip_address':
                        $stmt->bindValue($identifier, $this->ip_address, PDO::PARAM_STR);
                        break;
                    case 'form_item_id':
                        $stmt->bindValue($identifier, $this->form_item_id, PDO::PARAM_INT);
                        break;
                    case 'share_id':
                        $stmt->bindValue($identifier, $this->share_id, PDO::PARAM_INT);
                        break;
                    case 'member_id':
                        $stmt->bindValue($identifier, $this->member_id, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SubmitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getResponse();
                break;
            case 2:
                return $this->getMultiResponse();
                break;
            case 3:
                return $this->getIpAddress();
                break;
            case 4:
                return $this->getFormItemId();
                break;
            case 5:
                return $this->getShareId();
                break;
            case 6:
                return $this->getMemberId();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Submit'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Submit'][$this->hashCode()] = true;
        $keys = SubmitTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getResponse(),
            $keys[2] => $this->getMultiResponse(),
            $keys[3] => $this->getIpAddress(),
            $keys[4] => $this->getFormItemId(),
            $keys[5] => $this->getShareId(),
            $keys[6] => $this->getMemberId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aFormItem) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'formItem';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'form_item';
                        break;
                    default:
                        $key = 'FormItem';
                }

                $result[$key] = $this->aFormItem->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aShare) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'share';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'share';
                        break;
                    default:
                        $key = 'Share';
                }

                $result[$key] = $this->aShare->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aMember) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'member';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'member';
                        break;
                    default:
                        $key = 'Member';
                }

                $result[$key] = $this->aMember->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Submit
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SubmitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Submit
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setResponse($value);
                break;
            case 2:
                $this->setMultiResponse($value);
                break;
            case 3:
                $this->setIpAddress($value);
                break;
            case 4:
                $this->setFormItemId($value);
                break;
            case 5:
                $this->setShareId($value);
                break;
            case 6:
                $this->setMemberId($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return     $this|\Submit
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = SubmitTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setResponse($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setMultiResponse($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIpAddress($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setFormItemId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setShareId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setMemberId($arr[$keys[6]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Submit The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(SubmitTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SubmitTableMap::COL_ID)) {
            $criteria->add(SubmitTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(SubmitTableMap::COL_RESPONSE)) {
            $criteria->add(SubmitTableMap::COL_RESPONSE, $this->response);
        }
        if ($this->isColumnModified(SubmitTableMap::COL_MULTI_RESPONSE)) {
            $criteria->add(SubmitTableMap::COL_MULTI_RESPONSE, $this->multi_response);
        }
        if ($this->isColumnModified(SubmitTableMap::COL_IP_ADDRESS)) {
            $criteria->add(SubmitTableMap::COL_IP_ADDRESS, $this->ip_address);
        }
        if ($this->isColumnModified(SubmitTableMap::COL_FORM_ITEM_ID)) {
            $criteria->add(SubmitTableMap::COL_FORM_ITEM_ID, $this->form_item_id);
        }
        if ($this->isColumnModified(SubmitTableMap::COL_SHARE_ID)) {
            $criteria->add(SubmitTableMap::COL_SHARE_ID, $this->share_id);
        }
        if ($this->isColumnModified(SubmitTableMap::COL_MEMBER_ID)) {
            $criteria->add(SubmitTableMap::COL_MEMBER_ID, $this->member_id);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildSubmitQuery::create();
        $criteria->add(SubmitTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Submit (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setResponse($this->getResponse());
        $copyObj->setMultiResponse($this->getMultiResponse());
        $copyObj->setIpAddress($this->getIpAddress());
        $copyObj->setFormItemId($this->getFormItemId());
        $copyObj->setShareId($this->getShareId());
        $copyObj->setMemberId($this->getMemberId());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Submit Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildFormItem object.
     *
     * @param  ChildFormItem $v
     * @return $this|\Submit The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFormItem(ChildFormItem $v = null)
    {
        if ($v === null) {
            $this->setFormItemId(NULL);
        } else {
            $this->setFormItemId($v->getId());
        }

        $this->aFormItem = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildFormItem object, it will not be re-added.
        if ($v !== null) {
            $v->addSubmit($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildFormItem object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildFormItem The associated ChildFormItem object.
     * @throws PropelException
     */
    public function getFormItem(ConnectionInterface $con = null)
    {
        if ($this->aFormItem === null && ($this->form_item_id != 0)) {
            $this->aFormItem = ChildFormItemQuery::create()->findPk($this->form_item_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFormItem->addSubmits($this);
             */
        }

        return $this->aFormItem;
    }

    /**
     * Declares an association between this object and a ChildShare object.
     *
     * @param  ChildShare $v
     * @return $this|\Submit The current object (for fluent API support)
     * @throws PropelException
     */
    public function setShare(ChildShare $v = null)
    {
        if ($v === null) {
            $this->setShareId(NULL);
        } else {
            $this->setShareId($v->getId());
        }

        $this->aShare = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildShare object, it will not be re-added.
        if ($v !== null) {
            $v->addSubmit($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildShare object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildShare The associated ChildShare object.
     * @throws PropelException
     */
    public function getShare(ConnectionInterface $con = null)
    {
        if ($this->aShare === null && ($this->share_id != 0)) {
            $this->aShare = ChildShareQuery::create()->findPk($this->share_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aShare->addSubmits($this);
             */
        }

        return $this->aShare;
    }

    /**
     * Declares an association between this object and a ChildMember object.
     *
     * @param  ChildMember|null $v
     * @return $this|\Submit The current object (for fluent API support)
     * @throws PropelException
     */
    public function setMember(ChildMember $v = null)
    {
        if ($v === null) {
            $this->setMemberId(NULL);
        } else {
            $this->setMemberId($v->getId());
        }

        $this->aMember = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildMember object, it will not be re-added.
        if ($v !== null) {
            $v->addSubmit($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildMember object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildMember|null The associated ChildMember object.
     * @throws PropelException
     */
    public function getMember(ConnectionInterface $con = null)
    {
        if ($this->aMember === null && ($this->member_id != 0)) {
            $this->aMember = ChildMemberQuery::create()->findPk($this->member_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMember->addSubmits($this);
             */
        }

        return $this->aMember;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aFormItem) {
            $this->aFormItem->removeSubmit($this);
        }
        if (null !== $this->aShare) {
            $this->aShare->removeSubmit($this);
        }
        if (null !== $this->aMember) {
            $this->aMember->removeSubmit($this);
        }
        $this->id = null;
        $this->response = null;
        $this->multi_response = null;
        $this->ip_address = null;
        $this->form_item_id = null;
        $this->share_id = null;
        $this->member_id = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

        $this->aFormItem = null;
        $this->aShare = null;
        $this->aMember = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SubmitTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}

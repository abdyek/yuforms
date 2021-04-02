<?php

namespace Base;

use \Form as ChildForm;
use \FormQuery as ChildFormQuery;
use \Share as ChildShare;
use \ShareQuery as ChildShareQuery;
use \Submit as ChildSubmit;
use \SubmitQuery as ChildSubmitQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\ShareTableMap;
use Map\SubmitTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'share' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Share implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ShareTableMap';


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
     * The value for the start_date_time field.
     *
     * @var        DateTime
     */
    protected $start_date_time;

    /**
     * The value for the stop_date_time field.
     *
     * @var        DateTime|null
     */
    protected $stop_date_time;

    /**
     * The value for the session_type field.
     *
     * @var        string
     */
    protected $session_type;

    /**
     * The value for the submit_count field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $submit_count;

    /**
     * The value for the form_id field.
     *
     * @var        int
     */
    protected $form_id;

    /**
     * @var        ChildForm
     */
    protected $aForm;

    /**
     * @var        ObjectCollection|ChildSubmit[] Collection to store aggregation of ChildSubmit objects.
     */
    protected $collSubmits;
    protected $collSubmitsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSubmit[]
     */
    protected $submitsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->submit_count = 0;
    }

    /**
     * Initializes internal state of Base\Share object.
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
     * Compares this with another <code>Share</code> instance.  If
     * <code>obj</code> is an instance of <code>Share</code>, delegates to
     * <code>equals(Share)</code>.  Otherwise, returns <code>false</code>.
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
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
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
     * Get the [optionally formatted] temporal [start_date_time] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getStartDateTime($format = null)
    {
        if ($format === null) {
            return $this->start_date_time;
        } else {
            return $this->start_date_time instanceof \DateTimeInterface ? $this->start_date_time->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [stop_date_time] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getStopDateTime($format = null)
    {
        if ($format === null) {
            return $this->stop_date_time;
        } else {
            return $this->stop_date_time instanceof \DateTimeInterface ? $this->stop_date_time->format($format) : null;
        }
    }

    /**
     * Get the [session_type] column value.
     *
     * @return string
     */
    public function getSessionType()
    {
        return $this->session_type;
    }

    /**
     * Get the [submit_count] column value.
     *
     * @return int
     */
    public function getSubmitCount()
    {
        return $this->submit_count;
    }

    /**
     * Get the [form_id] column value.
     *
     * @return int
     */
    public function getFormId()
    {
        return $this->form_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this|\Share The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ShareTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Sets the value of [start_date_time] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Share The current object (for fluent API support)
     */
    public function setStartDateTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->start_date_time !== null || $dt !== null) {
            if ($this->start_date_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->start_date_time->format("Y-m-d H:i:s.u")) {
                $this->start_date_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ShareTableMap::COL_START_DATE_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setStartDateTime()

    /**
     * Sets the value of [stop_date_time] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Share The current object (for fluent API support)
     */
    public function setStopDateTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->stop_date_time !== null || $dt !== null) {
            if ($this->stop_date_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->stop_date_time->format("Y-m-d H:i:s.u")) {
                $this->stop_date_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ShareTableMap::COL_STOP_DATE_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setStopDateTime()

    /**
     * Set the value of [session_type] column.
     *
     * @param string $v New value
     * @return $this|\Share The current object (for fluent API support)
     */
    public function setSessionType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->session_type !== $v) {
            $this->session_type = $v;
            $this->modifiedColumns[ShareTableMap::COL_SESSION_TYPE] = true;
        }

        return $this;
    } // setSessionType()

    /**
     * Set the value of [submit_count] column.
     *
     * @param int $v New value
     * @return $this|\Share The current object (for fluent API support)
     */
    public function setSubmitCount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->submit_count !== $v) {
            $this->submit_count = $v;
            $this->modifiedColumns[ShareTableMap::COL_SUBMIT_COUNT] = true;
        }

        return $this;
    } // setSubmitCount()

    /**
     * Set the value of [form_id] column.
     *
     * @param int $v New value
     * @return $this|\Share The current object (for fluent API support)
     */
    public function setFormId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->form_id !== $v) {
            $this->form_id = $v;
            $this->modifiedColumns[ShareTableMap::COL_FORM_ID] = true;
        }

        if ($this->aForm !== null && $this->aForm->getId() !== $v) {
            $this->aForm = null;
        }

        return $this;
    } // setFormId()

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
            if ($this->submit_count !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ShareTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ShareTableMap::translateFieldName('StartDateTime', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->start_date_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ShareTableMap::translateFieldName('StopDateTime', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->stop_date_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ShareTableMap::translateFieldName('SessionType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->session_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ShareTableMap::translateFieldName('SubmitCount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->submit_count = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ShareTableMap::translateFieldName('FormId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->form_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = ShareTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Share'), 0, $e);
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
        if ($this->aForm !== null && $this->form_id !== $this->aForm->getId()) {
            $this->aForm = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ShareTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildShareQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aForm = null;
            $this->collSubmits = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Share::setDeleted()
     * @see Share::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShareTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildShareQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ShareTableMap::DATABASE_NAME);
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
                ShareTableMap::addInstanceToPool($this);
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

            if ($this->aForm !== null) {
                if ($this->aForm->isModified() || $this->aForm->isNew()) {
                    $affectedRows += $this->aForm->save($con);
                }
                $this->setForm($this->aForm);
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

            if ($this->submitsScheduledForDeletion !== null) {
                if (!$this->submitsScheduledForDeletion->isEmpty()) {
                    \SubmitQuery::create()
                        ->filterByPrimaryKeys($this->submitsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->submitsScheduledForDeletion = null;
                }
            }

            if ($this->collSubmits !== null) {
                foreach ($this->collSubmits as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[ShareTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ShareTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ShareTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ShareTableMap::COL_START_DATE_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'start_date_time';
        }
        if ($this->isColumnModified(ShareTableMap::COL_STOP_DATE_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'stop_date_time';
        }
        if ($this->isColumnModified(ShareTableMap::COL_SESSION_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'session_type';
        }
        if ($this->isColumnModified(ShareTableMap::COL_SUBMIT_COUNT)) {
            $modifiedColumns[':p' . $index++]  = 'submit_count';
        }
        if ($this->isColumnModified(ShareTableMap::COL_FORM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'form_id';
        }

        $sql = sprintf(
            'INSERT INTO share (%s) VALUES (%s)',
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
                    case 'start_date_time':
                        $stmt->bindValue($identifier, $this->start_date_time ? $this->start_date_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'stop_date_time':
                        $stmt->bindValue($identifier, $this->stop_date_time ? $this->stop_date_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'session_type':
                        $stmt->bindValue($identifier, $this->session_type, PDO::PARAM_STR);
                        break;
                    case 'submit_count':
                        $stmt->bindValue($identifier, $this->submit_count, PDO::PARAM_INT);
                        break;
                    case 'form_id':
                        $stmt->bindValue($identifier, $this->form_id, PDO::PARAM_INT);
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
        $pos = ShareTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getStartDateTime();
                break;
            case 2:
                return $this->getStopDateTime();
                break;
            case 3:
                return $this->getSessionType();
                break;
            case 4:
                return $this->getSubmitCount();
                break;
            case 5:
                return $this->getFormId();
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

        if (isset($alreadyDumpedObjects['Share'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Share'][$this->hashCode()] = true;
        $keys = ShareTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getStartDateTime(),
            $keys[2] => $this->getStopDateTime(),
            $keys[3] => $this->getSessionType(),
            $keys[4] => $this->getSubmitCount(),
            $keys[5] => $this->getFormId(),
        );
        if ($result[$keys[1]] instanceof \DateTimeInterface) {
            $result[$keys[1]] = $result[$keys[1]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aForm) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'form';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'form';
                        break;
                    default:
                        $key = 'Form';
                }

                $result[$key] = $this->aForm->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSubmits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'submits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'submits';
                        break;
                    default:
                        $key = 'Submits';
                }

                $result[$key] = $this->collSubmits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Share
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ShareTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Share
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setStartDateTime($value);
                break;
            case 2:
                $this->setStopDateTime($value);
                break;
            case 3:
                $this->setSessionType($value);
                break;
            case 4:
                $this->setSubmitCount($value);
                break;
            case 5:
                $this->setFormId($value);
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
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ShareTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setStartDateTime($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setStopDateTime($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setSessionType($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSubmitCount($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFormId($arr[$keys[5]]);
        }
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
     * @return $this|\Share The current object, for fluid interface
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
        $criteria = new Criteria(ShareTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ShareTableMap::COL_ID)) {
            $criteria->add(ShareTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ShareTableMap::COL_START_DATE_TIME)) {
            $criteria->add(ShareTableMap::COL_START_DATE_TIME, $this->start_date_time);
        }
        if ($this->isColumnModified(ShareTableMap::COL_STOP_DATE_TIME)) {
            $criteria->add(ShareTableMap::COL_STOP_DATE_TIME, $this->stop_date_time);
        }
        if ($this->isColumnModified(ShareTableMap::COL_SESSION_TYPE)) {
            $criteria->add(ShareTableMap::COL_SESSION_TYPE, $this->session_type);
        }
        if ($this->isColumnModified(ShareTableMap::COL_SUBMIT_COUNT)) {
            $criteria->add(ShareTableMap::COL_SUBMIT_COUNT, $this->submit_count);
        }
        if ($this->isColumnModified(ShareTableMap::COL_FORM_ID)) {
            $criteria->add(ShareTableMap::COL_FORM_ID, $this->form_id);
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
        $criteria = ChildShareQuery::create();
        $criteria->add(ShareTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Share (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setStartDateTime($this->getStartDateTime());
        $copyObj->setStopDateTime($this->getStopDateTime());
        $copyObj->setSessionType($this->getSessionType());
        $copyObj->setSubmitCount($this->getSubmitCount());
        $copyObj->setFormId($this->getFormId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSubmits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSubmit($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

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
     * @return \Share Clone of current object.
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
     * Declares an association between this object and a ChildForm object.
     *
     * @param  ChildForm $v
     * @return $this|\Share The current object (for fluent API support)
     * @throws PropelException
     */
    public function setForm(ChildForm $v = null)
    {
        if ($v === null) {
            $this->setFormId(NULL);
        } else {
            $this->setFormId($v->getId());
        }

        $this->aForm = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildForm object, it will not be re-added.
        if ($v !== null) {
            $v->addShare($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildForm object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildForm The associated ChildForm object.
     * @throws PropelException
     */
    public function getForm(ConnectionInterface $con = null)
    {
        if ($this->aForm === null && ($this->form_id != 0)) {
            $this->aForm = ChildFormQuery::create()->findPk($this->form_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aForm->addShares($this);
             */
        }

        return $this->aForm;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Submit' === $relationName) {
            $this->initSubmits();
            return;
        }
    }

    /**
     * Clears out the collSubmits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSubmits()
     */
    public function clearSubmits()
    {
        $this->collSubmits = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSubmits collection loaded partially.
     */
    public function resetPartialSubmits($v = true)
    {
        $this->collSubmitsPartial = $v;
    }

    /**
     * Initializes the collSubmits collection.
     *
     * By default this just sets the collSubmits collection to an empty array (like clearcollSubmits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSubmits($overrideExisting = true)
    {
        if (null !== $this->collSubmits && !$overrideExisting) {
            return;
        }

        $collectionClassName = SubmitTableMap::getTableMap()->getCollectionClassName();

        $this->collSubmits = new $collectionClassName;
        $this->collSubmits->setModel('\Submit');
    }

    /**
     * Gets an array of ChildSubmit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildShare is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSubmit[] List of ChildSubmit objects
     * @throws PropelException
     */
    public function getSubmits(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSubmitsPartial && !$this->isNew();
        if (null === $this->collSubmits || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSubmits) {
                    $this->initSubmits();
                } else {
                    $collectionClassName = SubmitTableMap::getTableMap()->getCollectionClassName();

                    $collSubmits = new $collectionClassName;
                    $collSubmits->setModel('\Submit');

                    return $collSubmits;
                }
            } else {
                $collSubmits = ChildSubmitQuery::create(null, $criteria)
                    ->filterByShare($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSubmitsPartial && count($collSubmits)) {
                        $this->initSubmits(false);

                        foreach ($collSubmits as $obj) {
                            if (false == $this->collSubmits->contains($obj)) {
                                $this->collSubmits->append($obj);
                            }
                        }

                        $this->collSubmitsPartial = true;
                    }

                    return $collSubmits;
                }

                if ($partial && $this->collSubmits) {
                    foreach ($this->collSubmits as $obj) {
                        if ($obj->isNew()) {
                            $collSubmits[] = $obj;
                        }
                    }
                }

                $this->collSubmits = $collSubmits;
                $this->collSubmitsPartial = false;
            }
        }

        return $this->collSubmits;
    }

    /**
     * Sets a collection of ChildSubmit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $submits A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildShare The current object (for fluent API support)
     */
    public function setSubmits(Collection $submits, ConnectionInterface $con = null)
    {
        /** @var ChildSubmit[] $submitsToDelete */
        $submitsToDelete = $this->getSubmits(new Criteria(), $con)->diff($submits);


        $this->submitsScheduledForDeletion = $submitsToDelete;

        foreach ($submitsToDelete as $submitRemoved) {
            $submitRemoved->setShare(null);
        }

        $this->collSubmits = null;
        foreach ($submits as $submit) {
            $this->addSubmit($submit);
        }

        $this->collSubmits = $submits;
        $this->collSubmitsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Submit objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Submit objects.
     * @throws PropelException
     */
    public function countSubmits(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSubmitsPartial && !$this->isNew();
        if (null === $this->collSubmits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSubmits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSubmits());
            }

            $query = ChildSubmitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByShare($this)
                ->count($con);
        }

        return count($this->collSubmits);
    }

    /**
     * Method called to associate a ChildSubmit object to this object
     * through the ChildSubmit foreign key attribute.
     *
     * @param  ChildSubmit $l ChildSubmit
     * @return $this|\Share The current object (for fluent API support)
     */
    public function addSubmit(ChildSubmit $l)
    {
        if ($this->collSubmits === null) {
            $this->initSubmits();
            $this->collSubmitsPartial = true;
        }

        if (!$this->collSubmits->contains($l)) {
            $this->doAddSubmit($l);

            if ($this->submitsScheduledForDeletion and $this->submitsScheduledForDeletion->contains($l)) {
                $this->submitsScheduledForDeletion->remove($this->submitsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSubmit $submit The ChildSubmit object to add.
     */
    protected function doAddSubmit(ChildSubmit $submit)
    {
        $this->collSubmits[]= $submit;
        $submit->setShare($this);
    }

    /**
     * @param  ChildSubmit $submit The ChildSubmit object to remove.
     * @return $this|ChildShare The current object (for fluent API support)
     */
    public function removeSubmit(ChildSubmit $submit)
    {
        if ($this->getSubmits()->contains($submit)) {
            $pos = $this->collSubmits->search($submit);
            $this->collSubmits->remove($pos);
            if (null === $this->submitsScheduledForDeletion) {
                $this->submitsScheduledForDeletion = clone $this->collSubmits;
                $this->submitsScheduledForDeletion->clear();
            }
            $this->submitsScheduledForDeletion[]= clone $submit;
            $submit->setShare(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Share is new, it will return
     * an empty collection; or if this Share has previously
     * been saved, it will retrieve related Submits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Share.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSubmit[] List of ChildSubmit objects
     */
    public function getSubmitsJoinFormItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSubmitQuery::create(null, $criteria);
        $query->joinWith('FormItem', $joinBehavior);

        return $this->getSubmits($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Share is new, it will return
     * an empty collection; or if this Share has previously
     * been saved, it will retrieve related Submits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Share.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSubmit[] List of ChildSubmit objects
     */
    public function getSubmitsJoinMember(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSubmitQuery::create(null, $criteria);
        $query->joinWith('Member', $joinBehavior);

        return $this->getSubmits($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aForm) {
            $this->aForm->removeShare($this);
        }
        $this->id = null;
        $this->start_date_time = null;
        $this->stop_date_time = null;
        $this->session_type = null;
        $this->submit_count = null;
        $this->form_id = null;
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
            if ($this->collSubmits) {
                foreach ($this->collSubmits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSubmits = null;
        $this->aForm = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ShareTableMap::DEFAULT_STRING_FORMAT);
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

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}

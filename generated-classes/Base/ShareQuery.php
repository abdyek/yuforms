<?php

namespace Base;

use \Share as ChildShare;
use \ShareQuery as ChildShareQuery;
use \Exception;
use \PDO;
use Map\ShareTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'share' table.
 *
 *
 *
 * @method     ChildShareQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildShareQuery orderByStartDateTime($order = Criteria::ASC) Order by the start_date_time column
 * @method     ChildShareQuery orderByStopDateTime($order = Criteria::ASC) Order by the stop_date_time column
 * @method     ChildShareQuery orderBySessionType($order = Criteria::ASC) Order by the session_type column
 * @method     ChildShareQuery orderBySubmitCount($order = Criteria::ASC) Order by the submit_count column
 * @method     ChildShareQuery orderByFormId($order = Criteria::ASC) Order by the form_id column
 *
 * @method     ChildShareQuery groupById() Group by the id column
 * @method     ChildShareQuery groupByStartDateTime() Group by the start_date_time column
 * @method     ChildShareQuery groupByStopDateTime() Group by the stop_date_time column
 * @method     ChildShareQuery groupBySessionType() Group by the session_type column
 * @method     ChildShareQuery groupBySubmitCount() Group by the submit_count column
 * @method     ChildShareQuery groupByFormId() Group by the form_id column
 *
 * @method     ChildShareQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShareQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShareQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShareQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildShareQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildShareQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildShareQuery leftJoinForm($relationAlias = null) Adds a LEFT JOIN clause to the query using the Form relation
 * @method     ChildShareQuery rightJoinForm($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Form relation
 * @method     ChildShareQuery innerJoinForm($relationAlias = null) Adds a INNER JOIN clause to the query using the Form relation
 *
 * @method     ChildShareQuery joinWithForm($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Form relation
 *
 * @method     ChildShareQuery leftJoinWithForm() Adds a LEFT JOIN clause and with to the query using the Form relation
 * @method     ChildShareQuery rightJoinWithForm() Adds a RIGHT JOIN clause and with to the query using the Form relation
 * @method     ChildShareQuery innerJoinWithForm() Adds a INNER JOIN clause and with to the query using the Form relation
 *
 * @method     ChildShareQuery leftJoinSubmit($relationAlias = null) Adds a LEFT JOIN clause to the query using the Submit relation
 * @method     ChildShareQuery rightJoinSubmit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Submit relation
 * @method     ChildShareQuery innerJoinSubmit($relationAlias = null) Adds a INNER JOIN clause to the query using the Submit relation
 *
 * @method     ChildShareQuery joinWithSubmit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Submit relation
 *
 * @method     ChildShareQuery leftJoinWithSubmit() Adds a LEFT JOIN clause and with to the query using the Submit relation
 * @method     ChildShareQuery rightJoinWithSubmit() Adds a RIGHT JOIN clause and with to the query using the Submit relation
 * @method     ChildShareQuery innerJoinWithSubmit() Adds a INNER JOIN clause and with to the query using the Submit relation
 *
 * @method     \FormQuery|\SubmitQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildShare|null findOne(ConnectionInterface $con = null) Return the first ChildShare matching the query
 * @method     ChildShare findOneOrCreate(ConnectionInterface $con = null) Return the first ChildShare matching the query, or a new ChildShare object populated from the query conditions when no match is found
 *
 * @method     ChildShare|null findOneById(int $id) Return the first ChildShare filtered by the id column
 * @method     ChildShare|null findOneByStartDateTime(string $start_date_time) Return the first ChildShare filtered by the start_date_time column
 * @method     ChildShare|null findOneByStopDateTime(string $stop_date_time) Return the first ChildShare filtered by the stop_date_time column
 * @method     ChildShare|null findOneBySessionType(string $session_type) Return the first ChildShare filtered by the session_type column
 * @method     ChildShare|null findOneBySubmitCount(int $submit_count) Return the first ChildShare filtered by the submit_count column
 * @method     ChildShare|null findOneByFormId(int $form_id) Return the first ChildShare filtered by the form_id column *

 * @method     ChildShare requirePk($key, ConnectionInterface $con = null) Return the ChildShare by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShare requireOne(ConnectionInterface $con = null) Return the first ChildShare matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShare requireOneById(int $id) Return the first ChildShare filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShare requireOneByStartDateTime(string $start_date_time) Return the first ChildShare filtered by the start_date_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShare requireOneByStopDateTime(string $stop_date_time) Return the first ChildShare filtered by the stop_date_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShare requireOneBySessionType(string $session_type) Return the first ChildShare filtered by the session_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShare requireOneBySubmitCount(int $submit_count) Return the first ChildShare filtered by the submit_count column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShare requireOneByFormId(int $form_id) Return the first ChildShare filtered by the form_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShare[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildShare objects based on current ModelCriteria
 * @method     ChildShare[]|ObjectCollection findById(int $id) Return ChildShare objects filtered by the id column
 * @method     ChildShare[]|ObjectCollection findByStartDateTime(string $start_date_time) Return ChildShare objects filtered by the start_date_time column
 * @method     ChildShare[]|ObjectCollection findByStopDateTime(string $stop_date_time) Return ChildShare objects filtered by the stop_date_time column
 * @method     ChildShare[]|ObjectCollection findBySessionType(string $session_type) Return ChildShare objects filtered by the session_type column
 * @method     ChildShare[]|ObjectCollection findBySubmitCount(int $submit_count) Return ChildShare objects filtered by the submit_count column
 * @method     ChildShare[]|ObjectCollection findByFormId(int $form_id) Return ChildShare objects filtered by the form_id column
 * @method     ChildShare[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ShareQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ShareQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'yuforms', $modelName = '\\Share', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShareQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShareQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildShareQuery) {
            return $criteria;
        }
        $query = new ChildShareQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildShare|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShareTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ShareTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildShare A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, start_date_time, stop_date_time, session_type, submit_count, form_id FROM share WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildShare $obj */
            $obj = new ChildShare();
            $obj->hydrate($row);
            ShareTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildShare|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildShareQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ShareTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildShareQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ShareTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShareQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ShareTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ShareTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShareTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the start_date_time column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDateTime('2011-03-14'); // WHERE start_date_time = '2011-03-14'
     * $query->filterByStartDateTime('now'); // WHERE start_date_time = '2011-03-14'
     * $query->filterByStartDateTime(array('max' => 'yesterday')); // WHERE start_date_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $startDateTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShareQuery The current query, for fluid interface
     */
    public function filterByStartDateTime($startDateTime = null, $comparison = null)
    {
        if (is_array($startDateTime)) {
            $useMinMax = false;
            if (isset($startDateTime['min'])) {
                $this->addUsingAlias(ShareTableMap::COL_START_DATE_TIME, $startDateTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDateTime['max'])) {
                $this->addUsingAlias(ShareTableMap::COL_START_DATE_TIME, $startDateTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShareTableMap::COL_START_DATE_TIME, $startDateTime, $comparison);
    }

    /**
     * Filter the query on the stop_date_time column
     *
     * Example usage:
     * <code>
     * $query->filterByStopDateTime('2011-03-14'); // WHERE stop_date_time = '2011-03-14'
     * $query->filterByStopDateTime('now'); // WHERE stop_date_time = '2011-03-14'
     * $query->filterByStopDateTime(array('max' => 'yesterday')); // WHERE stop_date_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $stopDateTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShareQuery The current query, for fluid interface
     */
    public function filterByStopDateTime($stopDateTime = null, $comparison = null)
    {
        if (is_array($stopDateTime)) {
            $useMinMax = false;
            if (isset($stopDateTime['min'])) {
                $this->addUsingAlias(ShareTableMap::COL_STOP_DATE_TIME, $stopDateTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stopDateTime['max'])) {
                $this->addUsingAlias(ShareTableMap::COL_STOP_DATE_TIME, $stopDateTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShareTableMap::COL_STOP_DATE_TIME, $stopDateTime, $comparison);
    }

    /**
     * Filter the query on the session_type column
     *
     * Example usage:
     * <code>
     * $query->filterBySessionType('fooValue');   // WHERE session_type = 'fooValue'
     * $query->filterBySessionType('%fooValue%', Criteria::LIKE); // WHERE session_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sessionType The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShareQuery The current query, for fluid interface
     */
    public function filterBySessionType($sessionType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sessionType)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShareTableMap::COL_SESSION_TYPE, $sessionType, $comparison);
    }

    /**
     * Filter the query on the submit_count column
     *
     * Example usage:
     * <code>
     * $query->filterBySubmitCount(1234); // WHERE submit_count = 1234
     * $query->filterBySubmitCount(array(12, 34)); // WHERE submit_count IN (12, 34)
     * $query->filterBySubmitCount(array('min' => 12)); // WHERE submit_count > 12
     * </code>
     *
     * @param     mixed $submitCount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShareQuery The current query, for fluid interface
     */
    public function filterBySubmitCount($submitCount = null, $comparison = null)
    {
        if (is_array($submitCount)) {
            $useMinMax = false;
            if (isset($submitCount['min'])) {
                $this->addUsingAlias(ShareTableMap::COL_SUBMIT_COUNT, $submitCount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($submitCount['max'])) {
                $this->addUsingAlias(ShareTableMap::COL_SUBMIT_COUNT, $submitCount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShareTableMap::COL_SUBMIT_COUNT, $submitCount, $comparison);
    }

    /**
     * Filter the query on the form_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFormId(1234); // WHERE form_id = 1234
     * $query->filterByFormId(array(12, 34)); // WHERE form_id IN (12, 34)
     * $query->filterByFormId(array('min' => 12)); // WHERE form_id > 12
     * </code>
     *
     * @see       filterByForm()
     *
     * @param     mixed $formId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShareQuery The current query, for fluid interface
     */
    public function filterByFormId($formId = null, $comparison = null)
    {
        if (is_array($formId)) {
            $useMinMax = false;
            if (isset($formId['min'])) {
                $this->addUsingAlias(ShareTableMap::COL_FORM_ID, $formId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($formId['max'])) {
                $this->addUsingAlias(ShareTableMap::COL_FORM_ID, $formId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShareTableMap::COL_FORM_ID, $formId, $comparison);
    }

    /**
     * Filter the query by a related \Form object
     *
     * @param \Form|ObjectCollection $form The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildShareQuery The current query, for fluid interface
     */
    public function filterByForm($form, $comparison = null)
    {
        if ($form instanceof \Form) {
            return $this
                ->addUsingAlias(ShareTableMap::COL_FORM_ID, $form->getId(), $comparison);
        } elseif ($form instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ShareTableMap::COL_FORM_ID, $form->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByForm() only accepts arguments of type \Form or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Form relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildShareQuery The current query, for fluid interface
     */
    public function joinForm($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Form');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Form');
        }

        return $this;
    }

    /**
     * Use the Form relation Form object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \FormQuery A secondary query class using the current class as primary query
     */
    public function useFormQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinForm($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Form', '\FormQuery');
    }

    /**
     * Filter the query by a related \Submit object
     *
     * @param \Submit|ObjectCollection $submit the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildShareQuery The current query, for fluid interface
     */
    public function filterBySubmit($submit, $comparison = null)
    {
        if ($submit instanceof \Submit) {
            return $this
                ->addUsingAlias(ShareTableMap::COL_ID, $submit->getShareId(), $comparison);
        } elseif ($submit instanceof ObjectCollection) {
            return $this
                ->useSubmitQuery()
                ->filterByPrimaryKeys($submit->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySubmit() only accepts arguments of type \Submit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Submit relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildShareQuery The current query, for fluid interface
     */
    public function joinSubmit($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Submit');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Submit');
        }

        return $this;
    }

    /**
     * Use the Submit relation Submit object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SubmitQuery A secondary query class using the current class as primary query
     */
    public function useSubmitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSubmit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Submit', '\SubmitQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildShare $share Object to remove from the list of results
     *
     * @return $this|ChildShareQuery The current query, for fluid interface
     */
    public function prune($share = null)
    {
        if ($share) {
            $this->addUsingAlias(ShareTableMap::COL_ID, $share->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the share table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShareTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShareTableMap::clearInstancePool();
            ShareTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShareTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShareTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShareTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShareTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ShareQuery

<?php

namespace Base;

use \Form as ChildForm;
use \FormQuery as ChildFormQuery;
use \Exception;
use \PDO;
use Map\FormTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'form' table.
 *
 *
 *
 * @method     ChildFormQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildFormQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildFormQuery orderByCreateDateTime($order = Criteria::ASC) Order by the create_date_time column
 * @method     ChildFormQuery orderByLastEditDateTime($order = Criteria::ASC) Order by the last_edit_date_time column
 * @method     ChildFormQuery orderByIsTemplate($order = Criteria::ASC) Order by the is_template column
 * @method     ChildFormQuery orderByMemberId($order = Criteria::ASC) Order by the member_id column
 *
 * @method     ChildFormQuery groupById() Group by the id column
 * @method     ChildFormQuery groupByName() Group by the name column
 * @method     ChildFormQuery groupByCreateDateTime() Group by the create_date_time column
 * @method     ChildFormQuery groupByLastEditDateTime() Group by the last_edit_date_time column
 * @method     ChildFormQuery groupByIsTemplate() Group by the is_template column
 * @method     ChildFormQuery groupByMemberId() Group by the member_id column
 *
 * @method     ChildFormQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFormQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFormQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFormQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFormQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFormQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFormQuery leftJoinMember($relationAlias = null) Adds a LEFT JOIN clause to the query using the Member relation
 * @method     ChildFormQuery rightJoinMember($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Member relation
 * @method     ChildFormQuery innerJoinMember($relationAlias = null) Adds a INNER JOIN clause to the query using the Member relation
 *
 * @method     ChildFormQuery joinWithMember($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Member relation
 *
 * @method     ChildFormQuery leftJoinWithMember() Adds a LEFT JOIN clause and with to the query using the Member relation
 * @method     ChildFormQuery rightJoinWithMember() Adds a RIGHT JOIN clause and with to the query using the Member relation
 * @method     ChildFormQuery innerJoinWithMember() Adds a INNER JOIN clause and with to the query using the Member relation
 *
 * @method     ChildFormQuery leftJoinShare($relationAlias = null) Adds a LEFT JOIN clause to the query using the Share relation
 * @method     ChildFormQuery rightJoinShare($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Share relation
 * @method     ChildFormQuery innerJoinShare($relationAlias = null) Adds a INNER JOIN clause to the query using the Share relation
 *
 * @method     ChildFormQuery joinWithShare($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Share relation
 *
 * @method     ChildFormQuery leftJoinWithShare() Adds a LEFT JOIN clause and with to the query using the Share relation
 * @method     ChildFormQuery rightJoinWithShare() Adds a RIGHT JOIN clause and with to the query using the Share relation
 * @method     ChildFormQuery innerJoinWithShare() Adds a INNER JOIN clause and with to the query using the Share relation
 *
 * @method     ChildFormQuery leftJoinFormItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the FormItem relation
 * @method     ChildFormQuery rightJoinFormItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FormItem relation
 * @method     ChildFormQuery innerJoinFormItem($relationAlias = null) Adds a INNER JOIN clause to the query using the FormItem relation
 *
 * @method     ChildFormQuery joinWithFormItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FormItem relation
 *
 * @method     ChildFormQuery leftJoinWithFormItem() Adds a LEFT JOIN clause and with to the query using the FormItem relation
 * @method     ChildFormQuery rightJoinWithFormItem() Adds a RIGHT JOIN clause and with to the query using the FormItem relation
 * @method     ChildFormQuery innerJoinWithFormItem() Adds a INNER JOIN clause and with to the query using the FormItem relation
 *
 * @method     ChildFormQuery leftJoinTemplate($relationAlias = null) Adds a LEFT JOIN clause to the query using the Template relation
 * @method     ChildFormQuery rightJoinTemplate($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Template relation
 * @method     ChildFormQuery innerJoinTemplate($relationAlias = null) Adds a INNER JOIN clause to the query using the Template relation
 *
 * @method     ChildFormQuery joinWithTemplate($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Template relation
 *
 * @method     ChildFormQuery leftJoinWithTemplate() Adds a LEFT JOIN clause and with to the query using the Template relation
 * @method     ChildFormQuery rightJoinWithTemplate() Adds a RIGHT JOIN clause and with to the query using the Template relation
 * @method     ChildFormQuery innerJoinWithTemplate() Adds a INNER JOIN clause and with to the query using the Template relation
 *
 * @method     \MemberQuery|\ShareQuery|\FormItemQuery|\TemplateQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildForm|null findOne(ConnectionInterface $con = null) Return the first ChildForm matching the query
 * @method     ChildForm findOneOrCreate(ConnectionInterface $con = null) Return the first ChildForm matching the query, or a new ChildForm object populated from the query conditions when no match is found
 *
 * @method     ChildForm|null findOneById(int $id) Return the first ChildForm filtered by the id column
 * @method     ChildForm|null findOneByName(string $name) Return the first ChildForm filtered by the name column
 * @method     ChildForm|null findOneByCreateDateTime(string $create_date_time) Return the first ChildForm filtered by the create_date_time column
 * @method     ChildForm|null findOneByLastEditDateTime(string $last_edit_date_time) Return the first ChildForm filtered by the last_edit_date_time column
 * @method     ChildForm|null findOneByIsTemplate(boolean $is_template) Return the first ChildForm filtered by the is_template column
 * @method     ChildForm|null findOneByMemberId(int $member_id) Return the first ChildForm filtered by the member_id column *

 * @method     ChildForm requirePk($key, ConnectionInterface $con = null) Return the ChildForm by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForm requireOne(ConnectionInterface $con = null) Return the first ChildForm matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildForm requireOneById(int $id) Return the first ChildForm filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForm requireOneByName(string $name) Return the first ChildForm filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForm requireOneByCreateDateTime(string $create_date_time) Return the first ChildForm filtered by the create_date_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForm requireOneByLastEditDateTime(string $last_edit_date_time) Return the first ChildForm filtered by the last_edit_date_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForm requireOneByIsTemplate(boolean $is_template) Return the first ChildForm filtered by the is_template column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForm requireOneByMemberId(int $member_id) Return the first ChildForm filtered by the member_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildForm[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildForm objects based on current ModelCriteria
 * @method     ChildForm[]|ObjectCollection findById(int $id) Return ChildForm objects filtered by the id column
 * @method     ChildForm[]|ObjectCollection findByName(string $name) Return ChildForm objects filtered by the name column
 * @method     ChildForm[]|ObjectCollection findByCreateDateTime(string $create_date_time) Return ChildForm objects filtered by the create_date_time column
 * @method     ChildForm[]|ObjectCollection findByLastEditDateTime(string $last_edit_date_time) Return ChildForm objects filtered by the last_edit_date_time column
 * @method     ChildForm[]|ObjectCollection findByIsTemplate(boolean $is_template) Return ChildForm objects filtered by the is_template column
 * @method     ChildForm[]|ObjectCollection findByMemberId(int $member_id) Return ChildForm objects filtered by the member_id column
 * @method     ChildForm[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FormQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\FormQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'yuforms', $modelName = '\\Form', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFormQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFormQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFormQuery) {
            return $criteria;
        }
        $query = new ChildFormQuery();
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
     * @return ChildForm|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FormTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FormTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildForm A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, create_date_time, last_edit_date_time, is_template, member_id FROM form WHERE id = :p0';
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
            /** @var ChildForm $obj */
            $obj = new ChildForm();
            $obj->hydrate($row);
            FormTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildForm|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FormTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FormTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(FormTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(FormTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the create_date_time column
     *
     * Example usage:
     * <code>
     * $query->filterByCreateDateTime('2011-03-14'); // WHERE create_date_time = '2011-03-14'
     * $query->filterByCreateDateTime('now'); // WHERE create_date_time = '2011-03-14'
     * $query->filterByCreateDateTime(array('max' => 'yesterday')); // WHERE create_date_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $createDateTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByCreateDateTime($createDateTime = null, $comparison = null)
    {
        if (is_array($createDateTime)) {
            $useMinMax = false;
            if (isset($createDateTime['min'])) {
                $this->addUsingAlias(FormTableMap::COL_CREATE_DATE_TIME, $createDateTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createDateTime['max'])) {
                $this->addUsingAlias(FormTableMap::COL_CREATE_DATE_TIME, $createDateTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormTableMap::COL_CREATE_DATE_TIME, $createDateTime, $comparison);
    }

    /**
     * Filter the query on the last_edit_date_time column
     *
     * Example usage:
     * <code>
     * $query->filterByLastEditDateTime('2011-03-14'); // WHERE last_edit_date_time = '2011-03-14'
     * $query->filterByLastEditDateTime('now'); // WHERE last_edit_date_time = '2011-03-14'
     * $query->filterByLastEditDateTime(array('max' => 'yesterday')); // WHERE last_edit_date_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastEditDateTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByLastEditDateTime($lastEditDateTime = null, $comparison = null)
    {
        if (is_array($lastEditDateTime)) {
            $useMinMax = false;
            if (isset($lastEditDateTime['min'])) {
                $this->addUsingAlias(FormTableMap::COL_LAST_EDIT_DATE_TIME, $lastEditDateTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastEditDateTime['max'])) {
                $this->addUsingAlias(FormTableMap::COL_LAST_EDIT_DATE_TIME, $lastEditDateTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormTableMap::COL_LAST_EDIT_DATE_TIME, $lastEditDateTime, $comparison);
    }

    /**
     * Filter the query on the is_template column
     *
     * Example usage:
     * <code>
     * $query->filterByIsTemplate(true); // WHERE is_template = true
     * $query->filterByIsTemplate('yes'); // WHERE is_template = true
     * </code>
     *
     * @param     boolean|string $isTemplate The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByIsTemplate($isTemplate = null, $comparison = null)
    {
        if (is_string($isTemplate)) {
            $isTemplate = in_array(strtolower($isTemplate), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(FormTableMap::COL_IS_TEMPLATE, $isTemplate, $comparison);
    }

    /**
     * Filter the query on the member_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMemberId(1234); // WHERE member_id = 1234
     * $query->filterByMemberId(array(12, 34)); // WHERE member_id IN (12, 34)
     * $query->filterByMemberId(array('min' => 12)); // WHERE member_id > 12
     * </code>
     *
     * @see       filterByMember()
     *
     * @param     mixed $memberId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByMemberId($memberId = null, $comparison = null)
    {
        if (is_array($memberId)) {
            $useMinMax = false;
            if (isset($memberId['min'])) {
                $this->addUsingAlias(FormTableMap::COL_MEMBER_ID, $memberId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($memberId['max'])) {
                $this->addUsingAlias(FormTableMap::COL_MEMBER_ID, $memberId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormTableMap::COL_MEMBER_ID, $memberId, $comparison);
    }

    /**
     * Filter the query by a related \Member object
     *
     * @param \Member|ObjectCollection $member The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFormQuery The current query, for fluid interface
     */
    public function filterByMember($member, $comparison = null)
    {
        if ($member instanceof \Member) {
            return $this
                ->addUsingAlias(FormTableMap::COL_MEMBER_ID, $member->getId(), $comparison);
        } elseif ($member instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FormTableMap::COL_MEMBER_ID, $member->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMember() only accepts arguments of type \Member or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Member relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function joinMember($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Member');

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
            $this->addJoinObject($join, 'Member');
        }

        return $this;
    }

    /**
     * Use the Member relation Member object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MemberQuery A secondary query class using the current class as primary query
     */
    public function useMemberQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMember($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Member', '\MemberQuery');
    }

    /**
     * Use the Member relation Member object
     *
     * @param callable(\MemberQuery):\MemberQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMemberQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMemberQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \Share object
     *
     * @param \Share|ObjectCollection $share the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFormQuery The current query, for fluid interface
     */
    public function filterByShare($share, $comparison = null)
    {
        if ($share instanceof \Share) {
            return $this
                ->addUsingAlias(FormTableMap::COL_ID, $share->getFormId(), $comparison);
        } elseif ($share instanceof ObjectCollection) {
            return $this
                ->useShareQuery()
                ->filterByPrimaryKeys($share->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByShare() only accepts arguments of type \Share or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Share relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function joinShare($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Share');

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
            $this->addJoinObject($join, 'Share');
        }

        return $this;
    }

    /**
     * Use the Share relation Share object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ShareQuery A secondary query class using the current class as primary query
     */
    public function useShareQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShare($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Share', '\ShareQuery');
    }

    /**
     * Use the Share relation Share object
     *
     * @param callable(\ShareQuery):\ShareQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShareQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShareQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \FormItem object
     *
     * @param \FormItem|ObjectCollection $formItem the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFormQuery The current query, for fluid interface
     */
    public function filterByFormItem($formItem, $comparison = null)
    {
        if ($formItem instanceof \FormItem) {
            return $this
                ->addUsingAlias(FormTableMap::COL_ID, $formItem->getFormId(), $comparison);
        } elseif ($formItem instanceof ObjectCollection) {
            return $this
                ->useFormItemQuery()
                ->filterByPrimaryKeys($formItem->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFormItem() only accepts arguments of type \FormItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FormItem relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function joinFormItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FormItem');

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
            $this->addJoinObject($join, 'FormItem');
        }

        return $this;
    }

    /**
     * Use the FormItem relation FormItem object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \FormItemQuery A secondary query class using the current class as primary query
     */
    public function useFormItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFormItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FormItem', '\FormItemQuery');
    }

    /**
     * Use the FormItem relation FormItem object
     *
     * @param callable(\FormItemQuery):\FormItemQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withFormItemQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useFormItemQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \Template object
     *
     * @param \Template|ObjectCollection $template the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFormQuery The current query, for fluid interface
     */
    public function filterByTemplate($template, $comparison = null)
    {
        if ($template instanceof \Template) {
            return $this
                ->addUsingAlias(FormTableMap::COL_ID, $template->getFormId(), $comparison);
        } elseif ($template instanceof ObjectCollection) {
            return $this
                ->useTemplateQuery()
                ->filterByPrimaryKeys($template->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTemplate() only accepts arguments of type \Template or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Template relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function joinTemplate($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Template');

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
            $this->addJoinObject($join, 'Template');
        }

        return $this;
    }

    /**
     * Use the Template relation Template object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TemplateQuery A secondary query class using the current class as primary query
     */
    public function useTemplateQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTemplate($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Template', '\TemplateQuery');
    }

    /**
     * Use the Template relation Template object
     *
     * @param callable(\TemplateQuery):\TemplateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTemplateQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTemplateQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param   ChildForm $form Object to remove from the list of results
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function prune($form = null)
    {
        if ($form) {
            $this->addUsingAlias(FormTableMap::COL_ID, $form->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the form table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FormTableMap::clearInstancePool();
            FormTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FormTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FormTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FormTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FormTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FormQuery

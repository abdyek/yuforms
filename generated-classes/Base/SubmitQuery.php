<?php

namespace Base;

use \Submit as ChildSubmit;
use \SubmitQuery as ChildSubmitQuery;
use \Exception;
use \PDO;
use Map\SubmitTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'submit' table.
 *
 *
 *
 * @method     ChildSubmitQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSubmitQuery orderByResponse($order = Criteria::ASC) Order by the response column
 * @method     ChildSubmitQuery orderByMultiResponse($order = Criteria::ASC) Order by the multi_response column
 * @method     ChildSubmitQuery orderByIpAddress($order = Criteria::ASC) Order by the ip_address column
 * @method     ChildSubmitQuery orderByFormItemId($order = Criteria::ASC) Order by the form_item_id column
 * @method     ChildSubmitQuery orderByShareId($order = Criteria::ASC) Order by the share_id column
 * @method     ChildSubmitQuery orderByMemberId($order = Criteria::ASC) Order by the member_id column
 *
 * @method     ChildSubmitQuery groupById() Group by the id column
 * @method     ChildSubmitQuery groupByResponse() Group by the response column
 * @method     ChildSubmitQuery groupByMultiResponse() Group by the multi_response column
 * @method     ChildSubmitQuery groupByIpAddress() Group by the ip_address column
 * @method     ChildSubmitQuery groupByFormItemId() Group by the form_item_id column
 * @method     ChildSubmitQuery groupByShareId() Group by the share_id column
 * @method     ChildSubmitQuery groupByMemberId() Group by the member_id column
 *
 * @method     ChildSubmitQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSubmitQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSubmitQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSubmitQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSubmitQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSubmitQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSubmitQuery leftJoinFormItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the FormItem relation
 * @method     ChildSubmitQuery rightJoinFormItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FormItem relation
 * @method     ChildSubmitQuery innerJoinFormItem($relationAlias = null) Adds a INNER JOIN clause to the query using the FormItem relation
 *
 * @method     ChildSubmitQuery joinWithFormItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FormItem relation
 *
 * @method     ChildSubmitQuery leftJoinWithFormItem() Adds a LEFT JOIN clause and with to the query using the FormItem relation
 * @method     ChildSubmitQuery rightJoinWithFormItem() Adds a RIGHT JOIN clause and with to the query using the FormItem relation
 * @method     ChildSubmitQuery innerJoinWithFormItem() Adds a INNER JOIN clause and with to the query using the FormItem relation
 *
 * @method     ChildSubmitQuery leftJoinShare($relationAlias = null) Adds a LEFT JOIN clause to the query using the Share relation
 * @method     ChildSubmitQuery rightJoinShare($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Share relation
 * @method     ChildSubmitQuery innerJoinShare($relationAlias = null) Adds a INNER JOIN clause to the query using the Share relation
 *
 * @method     ChildSubmitQuery joinWithShare($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Share relation
 *
 * @method     ChildSubmitQuery leftJoinWithShare() Adds a LEFT JOIN clause and with to the query using the Share relation
 * @method     ChildSubmitQuery rightJoinWithShare() Adds a RIGHT JOIN clause and with to the query using the Share relation
 * @method     ChildSubmitQuery innerJoinWithShare() Adds a INNER JOIN clause and with to the query using the Share relation
 *
 * @method     ChildSubmitQuery leftJoinMember($relationAlias = null) Adds a LEFT JOIN clause to the query using the Member relation
 * @method     ChildSubmitQuery rightJoinMember($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Member relation
 * @method     ChildSubmitQuery innerJoinMember($relationAlias = null) Adds a INNER JOIN clause to the query using the Member relation
 *
 * @method     ChildSubmitQuery joinWithMember($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Member relation
 *
 * @method     ChildSubmitQuery leftJoinWithMember() Adds a LEFT JOIN clause and with to the query using the Member relation
 * @method     ChildSubmitQuery rightJoinWithMember() Adds a RIGHT JOIN clause and with to the query using the Member relation
 * @method     ChildSubmitQuery innerJoinWithMember() Adds a INNER JOIN clause and with to the query using the Member relation
 *
 * @method     \FormItemQuery|\ShareQuery|\MemberQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSubmit findOne(ConnectionInterface $con = null) Return the first ChildSubmit matching the query
 * @method     ChildSubmit findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSubmit matching the query, or a new ChildSubmit object populated from the query conditions when no match is found
 *
 * @method     ChildSubmit findOneById(int $id) Return the first ChildSubmit filtered by the id column
 * @method     ChildSubmit findOneByResponse(string $response) Return the first ChildSubmit filtered by the response column
 * @method     ChildSubmit findOneByMultiResponse(boolean $multi_response) Return the first ChildSubmit filtered by the multi_response column
 * @method     ChildSubmit findOneByIpAddress(string $ip_address) Return the first ChildSubmit filtered by the ip_address column
 * @method     ChildSubmit findOneByFormItemId(int $form_item_id) Return the first ChildSubmit filtered by the form_item_id column
 * @method     ChildSubmit findOneByShareId(int $share_id) Return the first ChildSubmit filtered by the share_id column
 * @method     ChildSubmit findOneByMemberId(int $member_id) Return the first ChildSubmit filtered by the member_id column *

 * @method     ChildSubmit requirePk($key, ConnectionInterface $con = null) Return the ChildSubmit by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubmit requireOne(ConnectionInterface $con = null) Return the first ChildSubmit matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSubmit requireOneById(int $id) Return the first ChildSubmit filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubmit requireOneByResponse(string $response) Return the first ChildSubmit filtered by the response column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubmit requireOneByMultiResponse(boolean $multi_response) Return the first ChildSubmit filtered by the multi_response column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubmit requireOneByIpAddress(string $ip_address) Return the first ChildSubmit filtered by the ip_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubmit requireOneByFormItemId(int $form_item_id) Return the first ChildSubmit filtered by the form_item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubmit requireOneByShareId(int $share_id) Return the first ChildSubmit filtered by the share_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubmit requireOneByMemberId(int $member_id) Return the first ChildSubmit filtered by the member_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSubmit[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSubmit objects based on current ModelCriteria
 * @method     ChildSubmit[]|ObjectCollection findById(int $id) Return ChildSubmit objects filtered by the id column
 * @method     ChildSubmit[]|ObjectCollection findByResponse(string $response) Return ChildSubmit objects filtered by the response column
 * @method     ChildSubmit[]|ObjectCollection findByMultiResponse(boolean $multi_response) Return ChildSubmit objects filtered by the multi_response column
 * @method     ChildSubmit[]|ObjectCollection findByIpAddress(string $ip_address) Return ChildSubmit objects filtered by the ip_address column
 * @method     ChildSubmit[]|ObjectCollection findByFormItemId(int $form_item_id) Return ChildSubmit objects filtered by the form_item_id column
 * @method     ChildSubmit[]|ObjectCollection findByShareId(int $share_id) Return ChildSubmit objects filtered by the share_id column
 * @method     ChildSubmit[]|ObjectCollection findByMemberId(int $member_id) Return ChildSubmit objects filtered by the member_id column
 * @method     ChildSubmit[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SubmitQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SubmitQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'yuforms', $modelName = '\\Submit', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSubmitQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSubmitQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSubmitQuery) {
            return $criteria;
        }
        $query = new ChildSubmitQuery();
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
     * @return ChildSubmit|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SubmitTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SubmitTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSubmit A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, response, multi_response, ip_address, form_item_id, share_id, member_id FROM submit WHERE id = :p0';
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
            /** @var ChildSubmit $obj */
            $obj = new ChildSubmit();
            $obj->hydrate($row);
            SubmitTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSubmit|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSubmitQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SubmitTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSubmitQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SubmitTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSubmitQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SubmitTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SubmitTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubmitTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the response column
     *
     * Example usage:
     * <code>
     * $query->filterByResponse('fooValue');   // WHERE response = 'fooValue'
     * $query->filterByResponse('%fooValue%', Criteria::LIKE); // WHERE response LIKE '%fooValue%'
     * </code>
     *
     * @param     string $response The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSubmitQuery The current query, for fluid interface
     */
    public function filterByResponse($response = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($response)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubmitTableMap::COL_RESPONSE, $response, $comparison);
    }

    /**
     * Filter the query on the multi_response column
     *
     * Example usage:
     * <code>
     * $query->filterByMultiResponse(true); // WHERE multi_response = true
     * $query->filterByMultiResponse('yes'); // WHERE multi_response = true
     * </code>
     *
     * @param     boolean|string $multiResponse The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSubmitQuery The current query, for fluid interface
     */
    public function filterByMultiResponse($multiResponse = null, $comparison = null)
    {
        if (is_string($multiResponse)) {
            $multiResponse = in_array(strtolower($multiResponse), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SubmitTableMap::COL_MULTI_RESPONSE, $multiResponse, $comparison);
    }

    /**
     * Filter the query on the ip_address column
     *
     * Example usage:
     * <code>
     * $query->filterByIpAddress('fooValue');   // WHERE ip_address = 'fooValue'
     * $query->filterByIpAddress('%fooValue%', Criteria::LIKE); // WHERE ip_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ipAddress The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSubmitQuery The current query, for fluid interface
     */
    public function filterByIpAddress($ipAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ipAddress)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubmitTableMap::COL_IP_ADDRESS, $ipAddress, $comparison);
    }

    /**
     * Filter the query on the form_item_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFormItemId(1234); // WHERE form_item_id = 1234
     * $query->filterByFormItemId(array(12, 34)); // WHERE form_item_id IN (12, 34)
     * $query->filterByFormItemId(array('min' => 12)); // WHERE form_item_id > 12
     * </code>
     *
     * @see       filterByFormItem()
     *
     * @param     mixed $formItemId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSubmitQuery The current query, for fluid interface
     */
    public function filterByFormItemId($formItemId = null, $comparison = null)
    {
        if (is_array($formItemId)) {
            $useMinMax = false;
            if (isset($formItemId['min'])) {
                $this->addUsingAlias(SubmitTableMap::COL_FORM_ITEM_ID, $formItemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($formItemId['max'])) {
                $this->addUsingAlias(SubmitTableMap::COL_FORM_ITEM_ID, $formItemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubmitTableMap::COL_FORM_ITEM_ID, $formItemId, $comparison);
    }

    /**
     * Filter the query on the share_id column
     *
     * Example usage:
     * <code>
     * $query->filterByShareId(1234); // WHERE share_id = 1234
     * $query->filterByShareId(array(12, 34)); // WHERE share_id IN (12, 34)
     * $query->filterByShareId(array('min' => 12)); // WHERE share_id > 12
     * </code>
     *
     * @see       filterByShare()
     *
     * @param     mixed $shareId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSubmitQuery The current query, for fluid interface
     */
    public function filterByShareId($shareId = null, $comparison = null)
    {
        if (is_array($shareId)) {
            $useMinMax = false;
            if (isset($shareId['min'])) {
                $this->addUsingAlias(SubmitTableMap::COL_SHARE_ID, $shareId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shareId['max'])) {
                $this->addUsingAlias(SubmitTableMap::COL_SHARE_ID, $shareId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubmitTableMap::COL_SHARE_ID, $shareId, $comparison);
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
     * @return $this|ChildSubmitQuery The current query, for fluid interface
     */
    public function filterByMemberId($memberId = null, $comparison = null)
    {
        if (is_array($memberId)) {
            $useMinMax = false;
            if (isset($memberId['min'])) {
                $this->addUsingAlias(SubmitTableMap::COL_MEMBER_ID, $memberId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($memberId['max'])) {
                $this->addUsingAlias(SubmitTableMap::COL_MEMBER_ID, $memberId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubmitTableMap::COL_MEMBER_ID, $memberId, $comparison);
    }

    /**
     * Filter the query by a related \FormItem object
     *
     * @param \FormItem|ObjectCollection $formItem The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSubmitQuery The current query, for fluid interface
     */
    public function filterByFormItem($formItem, $comparison = null)
    {
        if ($formItem instanceof \FormItem) {
            return $this
                ->addUsingAlias(SubmitTableMap::COL_FORM_ITEM_ID, $formItem->getId(), $comparison);
        } elseif ($formItem instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SubmitTableMap::COL_FORM_ITEM_ID, $formItem->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildSubmitQuery The current query, for fluid interface
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
     * Filter the query by a related \Share object
     *
     * @param \Share|ObjectCollection $share The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSubmitQuery The current query, for fluid interface
     */
    public function filterByShare($share, $comparison = null)
    {
        if ($share instanceof \Share) {
            return $this
                ->addUsingAlias(SubmitTableMap::COL_SHARE_ID, $share->getId(), $comparison);
        } elseif ($share instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SubmitTableMap::COL_SHARE_ID, $share->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildSubmitQuery The current query, for fluid interface
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
     * Filter the query by a related \Member object
     *
     * @param \Member|ObjectCollection $member The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSubmitQuery The current query, for fluid interface
     */
    public function filterByMember($member, $comparison = null)
    {
        if ($member instanceof \Member) {
            return $this
                ->addUsingAlias(SubmitTableMap::COL_MEMBER_ID, $member->getId(), $comparison);
        } elseif ($member instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SubmitTableMap::COL_MEMBER_ID, $member->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildSubmitQuery The current query, for fluid interface
     */
    public function joinMember($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useMemberQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMember($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Member', '\MemberQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSubmit $submit Object to remove from the list of results
     *
     * @return $this|ChildSubmitQuery The current query, for fluid interface
     */
    public function prune($submit = null)
    {
        if ($submit) {
            $this->addUsingAlias(SubmitTableMap::COL_ID, $submit->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the submit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SubmitTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SubmitTableMap::clearInstancePool();
            SubmitTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SubmitTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SubmitTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SubmitTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SubmitTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SubmitQuery

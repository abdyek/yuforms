<?php

namespace Base;

use \FormComponent as ChildFormComponent;
use \FormComponentQuery as ChildFormComponentQuery;
use \Exception;
use \PDO;
use Map\FormComponentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'form_component' table.
 *
 *
 *
 * @method     ChildFormComponentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildFormComponentQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildFormComponentQuery orderByFormComponentName($order = Criteria::ASC) Order by the form_component_name column
 * @method     ChildFormComponentQuery orderByHasOptions($order = Criteria::ASC) Order by the has_options column
 * @method     ChildFormComponentQuery orderByMultiResponse($order = Criteria::ASC) Order by the multi_response column
 *
 * @method     ChildFormComponentQuery groupById() Group by the id column
 * @method     ChildFormComponentQuery groupByTitle() Group by the title column
 * @method     ChildFormComponentQuery groupByFormComponentName() Group by the form_component_name column
 * @method     ChildFormComponentQuery groupByHasOptions() Group by the has_options column
 * @method     ChildFormComponentQuery groupByMultiResponse() Group by the multi_response column
 *
 * @method     ChildFormComponentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFormComponentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFormComponentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFormComponentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFormComponentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFormComponentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFormComponentQuery leftJoinQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Question relation
 * @method     ChildFormComponentQuery rightJoinQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Question relation
 * @method     ChildFormComponentQuery innerJoinQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the Question relation
 *
 * @method     ChildFormComponentQuery joinWithQuestion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Question relation
 *
 * @method     ChildFormComponentQuery leftJoinWithQuestion() Adds a LEFT JOIN clause and with to the query using the Question relation
 * @method     ChildFormComponentQuery rightJoinWithQuestion() Adds a RIGHT JOIN clause and with to the query using the Question relation
 * @method     ChildFormComponentQuery innerJoinWithQuestion() Adds a INNER JOIN clause and with to the query using the Question relation
 *
 * @method     \QuestionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFormComponent|null findOne(ConnectionInterface $con = null) Return the first ChildFormComponent matching the query
 * @method     ChildFormComponent findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFormComponent matching the query, or a new ChildFormComponent object populated from the query conditions when no match is found
 *
 * @method     ChildFormComponent|null findOneById(int $id) Return the first ChildFormComponent filtered by the id column
 * @method     ChildFormComponent|null findOneByTitle(string $title) Return the first ChildFormComponent filtered by the title column
 * @method     ChildFormComponent|null findOneByFormComponentName(string $form_component_name) Return the first ChildFormComponent filtered by the form_component_name column
 * @method     ChildFormComponent|null findOneByHasOptions(boolean $has_options) Return the first ChildFormComponent filtered by the has_options column
 * @method     ChildFormComponent|null findOneByMultiResponse(boolean $multi_response) Return the first ChildFormComponent filtered by the multi_response column *

 * @method     ChildFormComponent requirePk($key, ConnectionInterface $con = null) Return the ChildFormComponent by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormComponent requireOne(ConnectionInterface $con = null) Return the first ChildFormComponent matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormComponent requireOneById(int $id) Return the first ChildFormComponent filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormComponent requireOneByTitle(string $title) Return the first ChildFormComponent filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormComponent requireOneByFormComponentName(string $form_component_name) Return the first ChildFormComponent filtered by the form_component_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormComponent requireOneByHasOptions(boolean $has_options) Return the first ChildFormComponent filtered by the has_options column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormComponent requireOneByMultiResponse(boolean $multi_response) Return the first ChildFormComponent filtered by the multi_response column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormComponent[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFormComponent objects based on current ModelCriteria
 * @method     ChildFormComponent[]|ObjectCollection findById(int $id) Return ChildFormComponent objects filtered by the id column
 * @method     ChildFormComponent[]|ObjectCollection findByTitle(string $title) Return ChildFormComponent objects filtered by the title column
 * @method     ChildFormComponent[]|ObjectCollection findByFormComponentName(string $form_component_name) Return ChildFormComponent objects filtered by the form_component_name column
 * @method     ChildFormComponent[]|ObjectCollection findByHasOptions(boolean $has_options) Return ChildFormComponent objects filtered by the has_options column
 * @method     ChildFormComponent[]|ObjectCollection findByMultiResponse(boolean $multi_response) Return ChildFormComponent objects filtered by the multi_response column
 * @method     ChildFormComponent[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FormComponentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\FormComponentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'yuforms', $modelName = '\\FormComponent', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFormComponentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFormComponentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFormComponentQuery) {
            return $criteria;
        }
        $query = new ChildFormComponentQuery();
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
     * @return ChildFormComponent|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FormComponentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FormComponentTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFormComponent A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, title, form_component_name, has_options, multi_response FROM form_component WHERE id = :p0';
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
            /** @var ChildFormComponent $obj */
            $obj = new ChildFormComponent();
            $obj->hydrate($row);
            FormComponentTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFormComponent|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFormComponentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FormComponentTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFormComponentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FormComponentTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildFormComponentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(FormComponentTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(FormComponentTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormComponentTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormComponentQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormComponentTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the form_component_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFormComponentName('fooValue');   // WHERE form_component_name = 'fooValue'
     * $query->filterByFormComponentName('%fooValue%', Criteria::LIKE); // WHERE form_component_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $formComponentName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormComponentQuery The current query, for fluid interface
     */
    public function filterByFormComponentName($formComponentName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($formComponentName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormComponentTableMap::COL_FORM_COMPONENT_NAME, $formComponentName, $comparison);
    }

    /**
     * Filter the query on the has_options column
     *
     * Example usage:
     * <code>
     * $query->filterByHasOptions(true); // WHERE has_options = true
     * $query->filterByHasOptions('yes'); // WHERE has_options = true
     * </code>
     *
     * @param     boolean|string $hasOptions The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormComponentQuery The current query, for fluid interface
     */
    public function filterByHasOptions($hasOptions = null, $comparison = null)
    {
        if (is_string($hasOptions)) {
            $hasOptions = in_array(strtolower($hasOptions), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(FormComponentTableMap::COL_HAS_OPTIONS, $hasOptions, $comparison);
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
     * @return $this|ChildFormComponentQuery The current query, for fluid interface
     */
    public function filterByMultiResponse($multiResponse = null, $comparison = null)
    {
        if (is_string($multiResponse)) {
            $multiResponse = in_array(strtolower($multiResponse), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(FormComponentTableMap::COL_MULTI_RESPONSE, $multiResponse, $comparison);
    }

    /**
     * Filter the query by a related \Question object
     *
     * @param \Question|ObjectCollection $question the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFormComponentQuery The current query, for fluid interface
     */
    public function filterByQuestion($question, $comparison = null)
    {
        if ($question instanceof \Question) {
            return $this
                ->addUsingAlias(FormComponentTableMap::COL_ID, $question->getFormComponentId(), $comparison);
        } elseif ($question instanceof ObjectCollection) {
            return $this
                ->useQuestionQuery()
                ->filterByPrimaryKeys($question->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByQuestion() only accepts arguments of type \Question or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Question relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFormComponentQuery The current query, for fluid interface
     */
    public function joinQuestion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Question');

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
            $this->addJoinObject($join, 'Question');
        }

        return $this;
    }

    /**
     * Use the Question relation Question object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \QuestionQuery A secondary query class using the current class as primary query
     */
    public function useQuestionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinQuestion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Question', '\QuestionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFormComponent $formComponent Object to remove from the list of results
     *
     * @return $this|ChildFormComponentQuery The current query, for fluid interface
     */
    public function prune($formComponent = null)
    {
        if ($formComponent) {
            $this->addUsingAlias(FormComponentTableMap::COL_ID, $formComponent->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the form_component table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormComponentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FormComponentTableMap::clearInstancePool();
            FormComponentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FormComponentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FormComponentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FormComponentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FormComponentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FormComponentQuery

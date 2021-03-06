<?php

namespace Base;

use \Member as ChildMember;
use \MemberQuery as ChildMemberQuery;
use \Exception;
use \PDO;
use Map\MemberTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'member' table.
 *
 *
 *
 * @method     ChildMemberQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMemberQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildMemberQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildMemberQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildMemberQuery orderByConfirmedEmail($order = Criteria::ASC) Order by the confirmed_email column
 * @method     ChildMemberQuery orderByPasswordHash($order = Criteria::ASC) Order by the password_hash column
 * @method     ChildMemberQuery orderByActivationCode($order = Criteria::ASC) Order by the activation_code column
 * @method     ChildMemberQuery orderByRecoveryCode($order = Criteria::ASC) Order by the recovery_code column
 * @method     ChildMemberQuery orderByHaveTo2fa($order = Criteria::ASC) Order by the have_to_2fa column
 * @method     ChildMemberQuery orderBySignUpDateTime($order = Criteria::ASC) Order by the sign_up_date_time column
 *
 * @method     ChildMemberQuery groupById() Group by the id column
 * @method     ChildMemberQuery groupByEmail() Group by the email column
 * @method     ChildMemberQuery groupByFirstName() Group by the first_name column
 * @method     ChildMemberQuery groupByLastName() Group by the last_name column
 * @method     ChildMemberQuery groupByConfirmedEmail() Group by the confirmed_email column
 * @method     ChildMemberQuery groupByPasswordHash() Group by the password_hash column
 * @method     ChildMemberQuery groupByActivationCode() Group by the activation_code column
 * @method     ChildMemberQuery groupByRecoveryCode() Group by the recovery_code column
 * @method     ChildMemberQuery groupByHaveTo2fa() Group by the have_to_2fa column
 * @method     ChildMemberQuery groupBySignUpDateTime() Group by the sign_up_date_time column
 *
 * @method     ChildMemberQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMemberQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMemberQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMemberQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMemberQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMemberQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMemberQuery leftJoinForm($relationAlias = null) Adds a LEFT JOIN clause to the query using the Form relation
 * @method     ChildMemberQuery rightJoinForm($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Form relation
 * @method     ChildMemberQuery innerJoinForm($relationAlias = null) Adds a INNER JOIN clause to the query using the Form relation
 *
 * @method     ChildMemberQuery joinWithForm($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Form relation
 *
 * @method     ChildMemberQuery leftJoinWithForm() Adds a LEFT JOIN clause and with to the query using the Form relation
 * @method     ChildMemberQuery rightJoinWithForm() Adds a RIGHT JOIN clause and with to the query using the Form relation
 * @method     ChildMemberQuery innerJoinWithForm() Adds a INNER JOIN clause and with to the query using the Form relation
 *
 * @method     ChildMemberQuery leftJoinSubmit($relationAlias = null) Adds a LEFT JOIN clause to the query using the Submit relation
 * @method     ChildMemberQuery rightJoinSubmit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Submit relation
 * @method     ChildMemberQuery innerJoinSubmit($relationAlias = null) Adds a INNER JOIN clause to the query using the Submit relation
 *
 * @method     ChildMemberQuery joinWithSubmit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Submit relation
 *
 * @method     ChildMemberQuery leftJoinWithSubmit() Adds a LEFT JOIN clause and with to the query using the Submit relation
 * @method     ChildMemberQuery rightJoinWithSubmit() Adds a RIGHT JOIN clause and with to the query using the Submit relation
 * @method     ChildMemberQuery innerJoinWithSubmit() Adds a INNER JOIN clause and with to the query using the Submit relation
 *
 * @method     ChildMemberQuery leftJoinAuthenticationCode($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthenticationCode relation
 * @method     ChildMemberQuery rightJoinAuthenticationCode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthenticationCode relation
 * @method     ChildMemberQuery innerJoinAuthenticationCode($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthenticationCode relation
 *
 * @method     ChildMemberQuery joinWithAuthenticationCode($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AuthenticationCode relation
 *
 * @method     ChildMemberQuery leftJoinWithAuthenticationCode() Adds a LEFT JOIN clause and with to the query using the AuthenticationCode relation
 * @method     ChildMemberQuery rightJoinWithAuthenticationCode() Adds a RIGHT JOIN clause and with to the query using the AuthenticationCode relation
 * @method     ChildMemberQuery innerJoinWithAuthenticationCode() Adds a INNER JOIN clause and with to the query using the AuthenticationCode relation
 *
 * @method     \FormQuery|\SubmitQuery|\AuthenticationCodeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMember|null findOne(ConnectionInterface $con = null) Return the first ChildMember matching the query
 * @method     ChildMember findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMember matching the query, or a new ChildMember object populated from the query conditions when no match is found
 *
 * @method     ChildMember|null findOneById(int $id) Return the first ChildMember filtered by the id column
 * @method     ChildMember|null findOneByEmail(string $email) Return the first ChildMember filtered by the email column
 * @method     ChildMember|null findOneByFirstName(string $first_name) Return the first ChildMember filtered by the first_name column
 * @method     ChildMember|null findOneByLastName(string $last_name) Return the first ChildMember filtered by the last_name column
 * @method     ChildMember|null findOneByConfirmedEmail(boolean $confirmed_email) Return the first ChildMember filtered by the confirmed_email column
 * @method     ChildMember|null findOneByPasswordHash(string $password_hash) Return the first ChildMember filtered by the password_hash column
 * @method     ChildMember|null findOneByActivationCode(string $activation_code) Return the first ChildMember filtered by the activation_code column
 * @method     ChildMember|null findOneByRecoveryCode(string $recovery_code) Return the first ChildMember filtered by the recovery_code column
 * @method     ChildMember|null findOneByHaveTo2fa(boolean $have_to_2fa) Return the first ChildMember filtered by the have_to_2fa column
 * @method     ChildMember|null findOneBySignUpDateTime(string $sign_up_date_time) Return the first ChildMember filtered by the sign_up_date_time column *

 * @method     ChildMember requirePk($key, ConnectionInterface $con = null) Return the ChildMember by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMember requireOne(ConnectionInterface $con = null) Return the first ChildMember matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMember requireOneById(int $id) Return the first ChildMember filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMember requireOneByEmail(string $email) Return the first ChildMember filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMember requireOneByFirstName(string $first_name) Return the first ChildMember filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMember requireOneByLastName(string $last_name) Return the first ChildMember filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMember requireOneByConfirmedEmail(boolean $confirmed_email) Return the first ChildMember filtered by the confirmed_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMember requireOneByPasswordHash(string $password_hash) Return the first ChildMember filtered by the password_hash column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMember requireOneByActivationCode(string $activation_code) Return the first ChildMember filtered by the activation_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMember requireOneByRecoveryCode(string $recovery_code) Return the first ChildMember filtered by the recovery_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMember requireOneByHaveTo2fa(boolean $have_to_2fa) Return the first ChildMember filtered by the have_to_2fa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMember requireOneBySignUpDateTime(string $sign_up_date_time) Return the first ChildMember filtered by the sign_up_date_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMember[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMember objects based on current ModelCriteria
 * @method     ChildMember[]|ObjectCollection findById(int $id) Return ChildMember objects filtered by the id column
 * @method     ChildMember[]|ObjectCollection findByEmail(string $email) Return ChildMember objects filtered by the email column
 * @method     ChildMember[]|ObjectCollection findByFirstName(string $first_name) Return ChildMember objects filtered by the first_name column
 * @method     ChildMember[]|ObjectCollection findByLastName(string $last_name) Return ChildMember objects filtered by the last_name column
 * @method     ChildMember[]|ObjectCollection findByConfirmedEmail(boolean $confirmed_email) Return ChildMember objects filtered by the confirmed_email column
 * @method     ChildMember[]|ObjectCollection findByPasswordHash(string $password_hash) Return ChildMember objects filtered by the password_hash column
 * @method     ChildMember[]|ObjectCollection findByActivationCode(string $activation_code) Return ChildMember objects filtered by the activation_code column
 * @method     ChildMember[]|ObjectCollection findByRecoveryCode(string $recovery_code) Return ChildMember objects filtered by the recovery_code column
 * @method     ChildMember[]|ObjectCollection findByHaveTo2fa(boolean $have_to_2fa) Return ChildMember objects filtered by the have_to_2fa column
 * @method     ChildMember[]|ObjectCollection findBySignUpDateTime(string $sign_up_date_time) Return ChildMember objects filtered by the sign_up_date_time column
 * @method     ChildMember[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MemberQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\MemberQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'yuforms', $modelName = '\\Member', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMemberQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMemberQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMemberQuery) {
            return $criteria;
        }
        $query = new ChildMemberQuery();
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
     * @return ChildMember|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MemberTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MemberTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildMember A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, email, first_name, last_name, confirmed_email, password_hash, activation_code, recovery_code, have_to_2fa, sign_up_date_time FROM member WHERE id = :p0';
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
            /** @var ChildMember $obj */
            $obj = new ChildMember();
            $obj->hydrate($row);
            MemberTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildMember|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMemberQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MemberTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMemberQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MemberTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildMemberQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MemberTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MemberTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MemberTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMemberQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MemberTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%', Criteria::LIKE); // WHERE first_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMemberQuery The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MemberTableMap::COL_FIRST_NAME, $firstName, $comparison);
    }

    /**
     * Filter the query on the last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
     * $query->filterByLastName('%fooValue%', Criteria::LIKE); // WHERE last_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMemberQuery The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MemberTableMap::COL_LAST_NAME, $lastName, $comparison);
    }

    /**
     * Filter the query on the confirmed_email column
     *
     * Example usage:
     * <code>
     * $query->filterByConfirmedEmail(true); // WHERE confirmed_email = true
     * $query->filterByConfirmedEmail('yes'); // WHERE confirmed_email = true
     * </code>
     *
     * @param     boolean|string $confirmedEmail The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMemberQuery The current query, for fluid interface
     */
    public function filterByConfirmedEmail($confirmedEmail = null, $comparison = null)
    {
        if (is_string($confirmedEmail)) {
            $confirmedEmail = in_array(strtolower($confirmedEmail), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(MemberTableMap::COL_CONFIRMED_EMAIL, $confirmedEmail, $comparison);
    }

    /**
     * Filter the query on the password_hash column
     *
     * Example usage:
     * <code>
     * $query->filterByPasswordHash('fooValue');   // WHERE password_hash = 'fooValue'
     * $query->filterByPasswordHash('%fooValue%', Criteria::LIKE); // WHERE password_hash LIKE '%fooValue%'
     * </code>
     *
     * @param     string $passwordHash The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMemberQuery The current query, for fluid interface
     */
    public function filterByPasswordHash($passwordHash = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($passwordHash)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MemberTableMap::COL_PASSWORD_HASH, $passwordHash, $comparison);
    }

    /**
     * Filter the query on the activation_code column
     *
     * Example usage:
     * <code>
     * $query->filterByActivationCode('fooValue');   // WHERE activation_code = 'fooValue'
     * $query->filterByActivationCode('%fooValue%', Criteria::LIKE); // WHERE activation_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $activationCode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMemberQuery The current query, for fluid interface
     */
    public function filterByActivationCode($activationCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($activationCode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MemberTableMap::COL_ACTIVATION_CODE, $activationCode, $comparison);
    }

    /**
     * Filter the query on the recovery_code column
     *
     * Example usage:
     * <code>
     * $query->filterByRecoveryCode('fooValue');   // WHERE recovery_code = 'fooValue'
     * $query->filterByRecoveryCode('%fooValue%', Criteria::LIKE); // WHERE recovery_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $recoveryCode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMemberQuery The current query, for fluid interface
     */
    public function filterByRecoveryCode($recoveryCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($recoveryCode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MemberTableMap::COL_RECOVERY_CODE, $recoveryCode, $comparison);
    }

    /**
     * Filter the query on the have_to_2fa column
     *
     * Example usage:
     * <code>
     * $query->filterByHaveTo2fa(true); // WHERE have_to_2fa = true
     * $query->filterByHaveTo2fa('yes'); // WHERE have_to_2fa = true
     * </code>
     *
     * @param     boolean|string $haveTo2fa The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMemberQuery The current query, for fluid interface
     */
    public function filterByHaveTo2fa($haveTo2fa = null, $comparison = null)
    {
        if (is_string($haveTo2fa)) {
            $haveTo2fa = in_array(strtolower($haveTo2fa), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(MemberTableMap::COL_HAVE_TO_2FA, $haveTo2fa, $comparison);
    }

    /**
     * Filter the query on the sign_up_date_time column
     *
     * Example usage:
     * <code>
     * $query->filterBySignUpDateTime('2011-03-14'); // WHERE sign_up_date_time = '2011-03-14'
     * $query->filterBySignUpDateTime('now'); // WHERE sign_up_date_time = '2011-03-14'
     * $query->filterBySignUpDateTime(array('max' => 'yesterday')); // WHERE sign_up_date_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $signUpDateTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMemberQuery The current query, for fluid interface
     */
    public function filterBySignUpDateTime($signUpDateTime = null, $comparison = null)
    {
        if (is_array($signUpDateTime)) {
            $useMinMax = false;
            if (isset($signUpDateTime['min'])) {
                $this->addUsingAlias(MemberTableMap::COL_SIGN_UP_DATE_TIME, $signUpDateTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($signUpDateTime['max'])) {
                $this->addUsingAlias(MemberTableMap::COL_SIGN_UP_DATE_TIME, $signUpDateTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MemberTableMap::COL_SIGN_UP_DATE_TIME, $signUpDateTime, $comparison);
    }

    /**
     * Filter the query by a related \Form object
     *
     * @param \Form|ObjectCollection $form the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMemberQuery The current query, for fluid interface
     */
    public function filterByForm($form, $comparison = null)
    {
        if ($form instanceof \Form) {
            return $this
                ->addUsingAlias(MemberTableMap::COL_ID, $form->getMemberId(), $comparison);
        } elseif ($form instanceof ObjectCollection) {
            return $this
                ->useFormQuery()
                ->filterByPrimaryKeys($form->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildMemberQuery The current query, for fluid interface
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
     * Use the Form relation Form object
     *
     * @param callable(\FormQuery):\FormQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withFormQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useFormQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \Submit object
     *
     * @param \Submit|ObjectCollection $submit the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMemberQuery The current query, for fluid interface
     */
    public function filterBySubmit($submit, $comparison = null)
    {
        if ($submit instanceof \Submit) {
            return $this
                ->addUsingAlias(MemberTableMap::COL_ID, $submit->getMemberId(), $comparison);
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
     * @return $this|ChildMemberQuery The current query, for fluid interface
     */
    public function joinSubmit($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useSubmitQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSubmit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Submit', '\SubmitQuery');
    }

    /**
     * Use the Submit relation Submit object
     *
     * @param callable(\SubmitQuery):\SubmitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSubmitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSubmitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Filter the query by a related \AuthenticationCode object
     *
     * @param \AuthenticationCode|ObjectCollection $authenticationCode the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMemberQuery The current query, for fluid interface
     */
    public function filterByAuthenticationCode($authenticationCode, $comparison = null)
    {
        if ($authenticationCode instanceof \AuthenticationCode) {
            return $this
                ->addUsingAlias(MemberTableMap::COL_ID, $authenticationCode->getMemberId(), $comparison);
        } elseif ($authenticationCode instanceof ObjectCollection) {
            return $this
                ->useAuthenticationCodeQuery()
                ->filterByPrimaryKeys($authenticationCode->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAuthenticationCode() only accepts arguments of type \AuthenticationCode or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AuthenticationCode relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMemberQuery The current query, for fluid interface
     */
    public function joinAuthenticationCode($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AuthenticationCode');

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
            $this->addJoinObject($join, 'AuthenticationCode');
        }

        return $this;
    }

    /**
     * Use the AuthenticationCode relation AuthenticationCode object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AuthenticationCodeQuery A secondary query class using the current class as primary query
     */
    public function useAuthenticationCodeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAuthenticationCode($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AuthenticationCode', '\AuthenticationCodeQuery');
    }

    /**
     * Use the AuthenticationCode relation AuthenticationCode object
     *
     * @param callable(\AuthenticationCodeQuery):\AuthenticationCodeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAuthenticationCodeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useAuthenticationCodeQuery(
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
     * @param   ChildMember $member Object to remove from the list of results
     *
     * @return $this|ChildMemberQuery The current query, for fluid interface
     */
    public function prune($member = null)
    {
        if ($member) {
            $this->addUsingAlias(MemberTableMap::COL_ID, $member->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the member table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MemberTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MemberTableMap::clearInstancePool();
            MemberTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MemberTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MemberTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MemberTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MemberTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MemberQuery

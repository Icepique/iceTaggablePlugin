<?php


/**
 * Base class that represents a query for the 'tag' table.
 *
 * 
 *
 * @method     iceModelTagQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     iceModelTagQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     iceModelTagQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method     iceModelTagQuery orderByIsTriple($order = Criteria::ASC) Order by the is_triple column
 * @method     iceModelTagQuery orderByTripleNamespace($order = Criteria::ASC) Order by the triple_namespace column
 * @method     iceModelTagQuery orderByTripleKey($order = Criteria::ASC) Order by the triple_key column
 * @method     iceModelTagQuery orderByTripleValue($order = Criteria::ASC) Order by the triple_value column
 *
 * @method     iceModelTagQuery groupById() Group by the id column
 * @method     iceModelTagQuery groupByName() Group by the name column
 * @method     iceModelTagQuery groupBySlug() Group by the slug column
 * @method     iceModelTagQuery groupByIsTriple() Group by the is_triple column
 * @method     iceModelTagQuery groupByTripleNamespace() Group by the triple_namespace column
 * @method     iceModelTagQuery groupByTripleKey() Group by the triple_key column
 * @method     iceModelTagQuery groupByTripleValue() Group by the triple_value column
 *
 * @method     iceModelTagQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     iceModelTagQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     iceModelTagQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     iceModelTagQuery leftJoiniceModelTagging($relationAlias = null) Adds a LEFT JOIN clause to the query using the iceModelTagging relation
 * @method     iceModelTagQuery rightJoiniceModelTagging($relationAlias = null) Adds a RIGHT JOIN clause to the query using the iceModelTagging relation
 * @method     iceModelTagQuery innerJoiniceModelTagging($relationAlias = null) Adds a INNER JOIN clause to the query using the iceModelTagging relation
 *
 * @method     iceModelTag findOne(PropelPDO $con = null) Return the first iceModelTag matching the query
 * @method     iceModelTag findOneOrCreate(PropelPDO $con = null) Return the first iceModelTag matching the query, or a new iceModelTag object populated from the query conditions when no match is found
 *
 * @method     iceModelTag findOneById(int $id) Return the first iceModelTag filtered by the id column
 * @method     iceModelTag findOneByName(string $name) Return the first iceModelTag filtered by the name column
 * @method     iceModelTag findOneBySlug(string $slug) Return the first iceModelTag filtered by the slug column
 * @method     iceModelTag findOneByIsTriple(boolean $is_triple) Return the first iceModelTag filtered by the is_triple column
 * @method     iceModelTag findOneByTripleNamespace(string $triple_namespace) Return the first iceModelTag filtered by the triple_namespace column
 * @method     iceModelTag findOneByTripleKey(string $triple_key) Return the first iceModelTag filtered by the triple_key column
 * @method     iceModelTag findOneByTripleValue(string $triple_value) Return the first iceModelTag filtered by the triple_value column
 *
 * @method     array findById(int $id) Return iceModelTag objects filtered by the id column
 * @method     array findByName(string $name) Return iceModelTag objects filtered by the name column
 * @method     array findBySlug(string $slug) Return iceModelTag objects filtered by the slug column
 * @method     array findByIsTriple(boolean $is_triple) Return iceModelTag objects filtered by the is_triple column
 * @method     array findByTripleNamespace(string $triple_namespace) Return iceModelTag objects filtered by the triple_namespace column
 * @method     array findByTripleKey(string $triple_key) Return iceModelTag objects filtered by the triple_key column
 * @method     array findByTripleValue(string $triple_value) Return iceModelTag objects filtered by the triple_value column
 *
 * @package    propel.generator.plugins.iceTaggablePlugin.lib.model.om
 */
abstract class BaseiceModelTagQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BaseiceModelTagQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'propel', $modelName = 'iceModelTag', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new iceModelTagQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return    iceModelTagQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof iceModelTagQuery) {
            return $criteria;
        }
        $query = new iceModelTagQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }
        return $query;
    }

    /**
     * Find object by primary key
     * Use instance pooling to avoid a database query if the object exists
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return    iceModelTag|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ((null !== ($obj = iceModelTagPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
            // the object is alredy in the instance pool
            return $obj;
        } else {
            // the object has not been requested yet, or the formatter is not an object formatter
            $criteria = $this->isKeepQuery() ? clone $this : $this;
            $stmt = $criteria
                ->filterByPrimaryKey($key)
                ->getSelectStatement($con);
            return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
        }
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        return $this
            ->filterByPrimaryKeys($keys)
            ->find($con);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return    iceModelTagQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        return $this->addUsingAlias(iceModelTagPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return    iceModelTagQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        return $this->addUsingAlias(iceModelTagPeer::ID, $keys, Criteria::IN);
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
     * @return    iceModelTagQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }
        return $this->addUsingAlias(iceModelTagPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    iceModelTagQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }
        return $this->addUsingAlias(iceModelTagPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the slug column
     *
     * Example usage:
     * <code>
     * $query->filterBySlug('fooValue');   // WHERE slug = 'fooValue'
     * $query->filterBySlug('%fooValue%'); // WHERE slug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $slug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    iceModelTagQuery The current query, for fluid interface
     */
    public function filterBySlug($slug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($slug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $slug)) {
                $slug = str_replace('*', '%', $slug);
                $comparison = Criteria::LIKE;
            }
        }
        return $this->addUsingAlias(iceModelTagPeer::SLUG, $slug, $comparison);
    }

    /**
     * Filter the query on the is_triple column
     *
     * Example usage:
     * <code>
     * $query->filterByIsTriple(true); // WHERE is_triple = true
     * $query->filterByIsTriple('yes'); // WHERE is_triple = true
     * </code>
     *
     * @param     boolean|string $isTriple The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    iceModelTagQuery The current query, for fluid interface
     */
    public function filterByIsTriple($isTriple = null, $comparison = null)
    {
        if (is_string($isTriple)) {
            $is_triple = in_array(strtolower($isTriple), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }
        return $this->addUsingAlias(iceModelTagPeer::IS_TRIPLE, $isTriple, $comparison);
    }

    /**
     * Filter the query on the triple_namespace column
     *
     * Example usage:
     * <code>
     * $query->filterByTripleNamespace('fooValue');   // WHERE triple_namespace = 'fooValue'
     * $query->filterByTripleNamespace('%fooValue%'); // WHERE triple_namespace LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tripleNamespace The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    iceModelTagQuery The current query, for fluid interface
     */
    public function filterByTripleNamespace($tripleNamespace = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tripleNamespace)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tripleNamespace)) {
                $tripleNamespace = str_replace('*', '%', $tripleNamespace);
                $comparison = Criteria::LIKE;
            }
        }
        return $this->addUsingAlias(iceModelTagPeer::TRIPLE_NAMESPACE, $tripleNamespace, $comparison);
    }

    /**
     * Filter the query on the triple_key column
     *
     * Example usage:
     * <code>
     * $query->filterByTripleKey('fooValue');   // WHERE triple_key = 'fooValue'
     * $query->filterByTripleKey('%fooValue%'); // WHERE triple_key LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tripleKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    iceModelTagQuery The current query, for fluid interface
     */
    public function filterByTripleKey($tripleKey = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tripleKey)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tripleKey)) {
                $tripleKey = str_replace('*', '%', $tripleKey);
                $comparison = Criteria::LIKE;
            }
        }
        return $this->addUsingAlias(iceModelTagPeer::TRIPLE_KEY, $tripleKey, $comparison);
    }

    /**
     * Filter the query on the triple_value column
     *
     * Example usage:
     * <code>
     * $query->filterByTripleValue('fooValue');   // WHERE triple_value = 'fooValue'
     * $query->filterByTripleValue('%fooValue%'); // WHERE triple_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tripleValue The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    iceModelTagQuery The current query, for fluid interface
     */
    public function filterByTripleValue($tripleValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tripleValue)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tripleValue)) {
                $tripleValue = str_replace('*', '%', $tripleValue);
                $comparison = Criteria::LIKE;
            }
        }
        return $this->addUsingAlias(iceModelTagPeer::TRIPLE_VALUE, $tripleValue, $comparison);
    }

    /**
     * Filter the query by a related iceModelTagging object
     *
     * @param     iceModelTagging $iceModelTagging  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    iceModelTagQuery The current query, for fluid interface
     */
    public function filterByiceModelTagging($iceModelTagging, $comparison = null)
    {
        if ($iceModelTagging instanceof iceModelTagging) {
            return $this
                ->addUsingAlias(iceModelTagPeer::ID, $iceModelTagging->getTagId(), $comparison);
        } elseif ($iceModelTagging instanceof PropelCollection) {
            return $this
                ->useiceModelTaggingQuery()
                ->filterByPrimaryKeys($iceModelTagging->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByiceModelTagging() only accepts arguments of type iceModelTagging or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the iceModelTagging relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    iceModelTagQuery The current query, for fluid interface
     */
    public function joiniceModelTagging($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('iceModelTagging');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'iceModelTagging');
        }

        return $this;
    }

    /**
     * Use the iceModelTagging relation iceModelTagging object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    iceModelTaggingQuery A secondary query class using the current class as primary query
     */
    public function useiceModelTaggingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joiniceModelTagging($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'iceModelTagging', 'iceModelTaggingQuery');
    }

    /**
     * Exclude object from result
     *
     * @param     iceModelTag $iceModelTag Object to remove from the list of results
     *
     * @return    iceModelTagQuery The current query, for fluid interface
     */
    public function prune($iceModelTag = null)
    {
        if ($iceModelTag) {
            $this->addUsingAlias(iceModelTagPeer::ID, $iceModelTag->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
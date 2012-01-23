<?php


/**
 * Base class that represents a query for the 'tagging' table.
 *
 * 
 *
 * @method     iceModelTaggingQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     iceModelTaggingQuery orderByTagId($order = Criteria::ASC) Order by the tag_id column
 * @method     iceModelTaggingQuery orderByTaggableModel($order = Criteria::ASC) Order by the taggable_model column
 * @method     iceModelTaggingQuery orderByTaggableId($order = Criteria::ASC) Order by the taggable_id column
 *
 * @method     iceModelTaggingQuery groupById() Group by the id column
 * @method     iceModelTaggingQuery groupByTagId() Group by the tag_id column
 * @method     iceModelTaggingQuery groupByTaggableModel() Group by the taggable_model column
 * @method     iceModelTaggingQuery groupByTaggableId() Group by the taggable_id column
 *
 * @method     iceModelTaggingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     iceModelTaggingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     iceModelTaggingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     iceModelTaggingQuery leftJoiniceModelTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the iceModelTag relation
 * @method     iceModelTaggingQuery rightJoiniceModelTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the iceModelTag relation
 * @method     iceModelTaggingQuery innerJoiniceModelTag($relationAlias = null) Adds a INNER JOIN clause to the query using the iceModelTag relation
 *
 * @method     iceModelTagging findOne(PropelPDO $con = null) Return the first iceModelTagging matching the query
 * @method     iceModelTagging findOneOrCreate(PropelPDO $con = null) Return the first iceModelTagging matching the query, or a new iceModelTagging object populated from the query conditions when no match is found
 *
 * @method     iceModelTagging findOneById(int $id) Return the first iceModelTagging filtered by the id column
 * @method     iceModelTagging findOneByTagId(int $tag_id) Return the first iceModelTagging filtered by the tag_id column
 * @method     iceModelTagging findOneByTaggableModel(string $taggable_model) Return the first iceModelTagging filtered by the taggable_model column
 * @method     iceModelTagging findOneByTaggableId(int $taggable_id) Return the first iceModelTagging filtered by the taggable_id column
 *
 * @method     array findById(int $id) Return iceModelTagging objects filtered by the id column
 * @method     array findByTagId(int $tag_id) Return iceModelTagging objects filtered by the tag_id column
 * @method     array findByTaggableModel(string $taggable_model) Return iceModelTagging objects filtered by the taggable_model column
 * @method     array findByTaggableId(int $taggable_id) Return iceModelTagging objects filtered by the taggable_id column
 *
 * @package    propel.generator.plugins.iceTaggablePlugin.lib.model.om
 */
abstract class BaseiceModelTaggingQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BaseiceModelTaggingQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'propel', $modelName = 'iceModelTagging', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new iceModelTaggingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return    iceModelTaggingQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof iceModelTaggingQuery) {
            return $criteria;
        }
        $query = new iceModelTaggingQuery();
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
     * @return    iceModelTagging|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ((null !== ($obj = iceModelTaggingPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
     * @return    iceModelTaggingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        return $this->addUsingAlias(iceModelTaggingPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return    iceModelTaggingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        return $this->addUsingAlias(iceModelTaggingPeer::ID, $keys, Criteria::IN);
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
     * @return    iceModelTaggingQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }
        return $this->addUsingAlias(iceModelTaggingPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the tag_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTagId(1234); // WHERE tag_id = 1234
     * $query->filterByTagId(array(12, 34)); // WHERE tag_id IN (12, 34)
     * $query->filterByTagId(array('min' => 12)); // WHERE tag_id > 12
     * </code>
     *
     * @see       filterByiceModelTag()
     *
     * @param     mixed $tagId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    iceModelTaggingQuery The current query, for fluid interface
     */
    public function filterByTagId($tagId = null, $comparison = null)
    {
        if (is_array($tagId)) {
            $useMinMax = false;
            if (isset($tagId['min'])) {
                $this->addUsingAlias(iceModelTaggingPeer::TAG_ID, $tagId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tagId['max'])) {
                $this->addUsingAlias(iceModelTaggingPeer::TAG_ID, $tagId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }
        return $this->addUsingAlias(iceModelTaggingPeer::TAG_ID, $tagId, $comparison);
    }

    /**
     * Filter the query on the taggable_model column
     *
     * Example usage:
     * <code>
     * $query->filterByTaggableModel('fooValue');   // WHERE taggable_model = 'fooValue'
     * $query->filterByTaggableModel('%fooValue%'); // WHERE taggable_model LIKE '%fooValue%'
     * </code>
     *
     * @param     string $taggableModel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    iceModelTaggingQuery The current query, for fluid interface
     */
    public function filterByTaggableModel($taggableModel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($taggableModel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $taggableModel)) {
                $taggableModel = str_replace('*', '%', $taggableModel);
                $comparison = Criteria::LIKE;
            }
        }
        return $this->addUsingAlias(iceModelTaggingPeer::TAGGABLE_MODEL, $taggableModel, $comparison);
    }

    /**
     * Filter the query on the taggable_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTaggableId(1234); // WHERE taggable_id = 1234
     * $query->filterByTaggableId(array(12, 34)); // WHERE taggable_id IN (12, 34)
     * $query->filterByTaggableId(array('min' => 12)); // WHERE taggable_id > 12
     * </code>
     *
     * @param     mixed $taggableId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    iceModelTaggingQuery The current query, for fluid interface
     */
    public function filterByTaggableId($taggableId = null, $comparison = null)
    {
        if (is_array($taggableId)) {
            $useMinMax = false;
            if (isset($taggableId['min'])) {
                $this->addUsingAlias(iceModelTaggingPeer::TAGGABLE_ID, $taggableId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taggableId['max'])) {
                $this->addUsingAlias(iceModelTaggingPeer::TAGGABLE_ID, $taggableId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }
        return $this->addUsingAlias(iceModelTaggingPeer::TAGGABLE_ID, $taggableId, $comparison);
    }

    /**
     * Filter the query by a related iceModelTag object
     *
     * @param     iceModelTag|PropelCollection $iceModelTag The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    iceModelTaggingQuery The current query, for fluid interface
     */
    public function filterByiceModelTag($iceModelTag, $comparison = null)
    {
        if ($iceModelTag instanceof iceModelTag) {
            return $this
                ->addUsingAlias(iceModelTaggingPeer::TAG_ID, $iceModelTag->getId(), $comparison);
        } elseif ($iceModelTag instanceof PropelCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
            return $this
                ->addUsingAlias(iceModelTaggingPeer::TAG_ID, $iceModelTag->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByiceModelTag() only accepts arguments of type iceModelTag or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the iceModelTag relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    iceModelTaggingQuery The current query, for fluid interface
     */
    public function joiniceModelTag($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('iceModelTag');

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
            $this->addJoinObject($join, 'iceModelTag');
        }

        return $this;
    }

    /**
     * Use the iceModelTag relation iceModelTag object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    iceModelTagQuery A secondary query class using the current class as primary query
     */
    public function useiceModelTagQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joiniceModelTag($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'iceModelTag', 'iceModelTagQuery');
    }

    /**
     * Exclude object from result
     *
     * @param     iceModelTagging $iceModelTagging Object to remove from the list of results
     *
     * @return    iceModelTaggingQuery The current query, for fluid interface
     */
    public function prune($iceModelTagging = null)
    {
        if ($iceModelTagging) {
            $this->addUsingAlias(iceModelTaggingPeer::ID, $iceModelTagging->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
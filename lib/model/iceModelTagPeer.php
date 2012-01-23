<?php

require 'plugins/iceTaggablePlugin/lib/model/om/BaseiceModelTagPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'tag' table.
 *
 * @package    propel.generator.plugins.iceTaggablePlugin.lib.model
 */
class iceModelTagPeer extends BaseiceModelTagPeer
{
  /**
   * Returns all tags, eventually with a limit option.
   * The first optionnal parameter permits to add some restrictions on the
   * objects the selected tags are related to.
   * The second optionnal parameter permits to restrict the tag selection with
   * different criterias
   *
   * @param   Criteria  $c
   * @param   array     $options
   *
   * @return  array
   */
  public static function getAll(Criteria $c = null, $options = array())
  {
    if ($c == null)
    {
      $c = new Criteria();
    }

    if (isset($options['limit']))
    {
      $c->setLimit($options['limit']);
    }

    if (isset($options['like']))
    {
      $c->add(iceModelTagPeer::NAME, $options['like'], Criteria::LIKE);
    }

    if (isset($options['triple']))
    {
      $c->add(iceModelTagPeer::IS_TRIPLE, $options['triple']);
    }

    if (isset($options['namespace']))
    {
      $c->add(iceModelTagPeer::TRIPLE_NAMESPACE, $options['namespace']);
    }

    if (isset($options['key']))
    {
      $c->add(iceModelTagPeer::TRIPLE_KEY, $options['key']);
    }

    if (isset($options['value']))
    {
      $c->add(iceModelTagPeer::TRIPLE_VALUE, $options['value']);
    }

    return iceModelTagPeer::doSelect($c);
  }

  /**
   * Returns all tags, sorted by name, with their number of occurencies.
   * The first optionnal parameter permits to add some restrictions on the
   * objects the selected tags are related to.
   * The second optionnal parameter permits to restrict the tag selection with
   * different criterias
   *
   * @param      Criteria    $c
   * @param      array       $options
   * @return     array
   */
  public static function getAllWithCount(Criteria $c = null, $options = array())
  {
    $tags = array();

    if (null === $c)
    {
      $c = new Criteria();
    }

    if (isset($options['limit']))
    {
      $c->setLimit($options['limit']);
    }

    if (isset($options['model']))
    {
      $c->add(iceModelTaggingPeer::TAGGABLE_MODEL, $options['model']);
    }

    if (isset($options['like']))
    {
      $c->add(iceModelTagPeer::NAME, $options['like'], Criteria::LIKE);
    }

    if (isset($options['triple']))
    {
      $c->add(iceModelTagPeer::IS_TRIPLE, $options['triple']);
    }

    if (isset($options['namespace']))
    {
      $c->add(iceModelTagPeer::TRIPLE_NAMESPACE, $options['namespace']);
    }

    if (isset($options['key']))
    {
      $c->add(iceModelTagPeer::TRIPLE_KEY, $options['key']);
    }

    if (isset($options['value']))
    {
      $c->add(iceModelTagPeer::TRIPLE_VALUE, $options['value']);
    }

    $c->addSelectColumn(iceModelTagPeer::NAME);
    $c->addSelectColumn('COUNT('.iceModelTagPeer::NAME.') as counter');
    $c->addJoin(iceModelTagPeer::ID, iceModelTaggingPeer::TAG_ID);
    $c->addGroupByColumn(iceModelTaggingPeer::TAG_ID);
    $c->addDescendingOrderByColumn('counter');
    $c->addAscendingOrderByColumn(iceModelTagPeer::NAME);

    if (Propel::VERSION >= '1.3')
    {
      $rs = iceModelTagPeer::doSelectStmt($c);

      while ($row = $rs->fetch(PDO::FETCH_NUM))
      {
        $tags[$row[0]] = $row[1];
      }
    }
    else
    {
      $rs = iceModelTagPeer::doSelectRS($c);

      while ($rs->next())
      {
        $tags[$rs->getString(1)] = $rs->getInt(2);
      }
    }

    if (!isset($options['sort_by_popularity']) || (true !== $options['sort_by_popularity']))
    {
      ksort($tags);
    }

    return $tags;
  }

  /**
   * Returns the names of the models that have instances tagged with one or
   * several tags. The optionnal parameter might be a string, an array, or a
   * comma separated string
   *
   * @param      mixed       $tags
   * @return     array
   */
  public static function getModelsTaggedWith($tags = array())
  {
    if (is_string($tags))
    {
      if (false !== strpos($tags, ','))
      {
        $tags = explode(',', $tags);
      }
      else
      {
        $tags = array($tags);
      }
    }

    $c = new Criteria();
    $c->addJoin(iceModelTagPeer::ID, iceModelTaggingPeer::TAG_ID);
    $c->add(iceModelTagPeer::NAME, $tags, Criteria::IN);
    $c->addGroupByColumn(iceModelTaggingPeer::TAGGABLE_ID);
    $having = $c->getNewCriterion(iceModelTagPeer::COUNT, count($tags), Criteria::GREATER_EQUAL);
    $c->addHaving($having);
    $c->clearSelectColumns();
    $c->addSelectColumn(iceModelTaggingPeer::TAGGABLE_MODEL);
    $c->addSelectColumn(iceModelTaggingPeer::TAGGABLE_ID);

    $params = array();
    $sql = BasePeer::createSelectSql($c, $params);
    $con = Propel::getConnection();
    $stmt = $con->prepareStatement($sql);
    $position = 1;

    foreach ($tags as $tag)
    {
      $stmt->setString($position, $tag);
      $position++;
    }

    $stmt->setString($position, count($tags));
    $models = array();

    if (Propel::VERSION >= '1.3')
    {
      $rs = $stmt->query();

      while ($rs->fecth(PDO::FETCH_NUM))
      {
        $models[] = $rs->getString(1);
      }
    }
    else
    {
      $rs = $stmt->executeQuery(ResultSet::FETCHMODE_NUM);

      while ($rs->next())
      {
        $models[] = $rs->getString(1);
      }
    }

    return $models;
  }

  /**
   * Returns the most popular tags with their associated weight. See
   * IceTaggableToolkit::normalize for more details.
   *
   * The first optionnal parameter permits to add some restrictions on the
   * objects the selected tags are related to.
   * The second optionnal parameter permits to restrict the tag selection with
   * different criterias
   *
   * @param      Criteria    $c
   * @param      array       $options
   * @return     array
   */
  public static function getPopulars($c = null, $options = array())
  {
    if (null === $c)
    {
      $c = new Criteria();
    }

    if (!$c->getLimit())
    {
      $c->setLimit(sfConfig::get('app_sfPropelActAsTaggableBehaviorPlugin_limit', 100));
    }

    $all_tags = iceModelTagPeer::getAllWithCount($c, $options);
    return IceTaggableToolkit::normalize($all_tags);
  }

  /**
   * Returns the tags that are related to one or more other tags, with their
   * associated weight (see IceTaggableToolkit::normalize for more
   * details).
   * The "related tags" of one tag are the ones which have at least one
   * taggable object in common.
   *
   * The first optionnal parameter permits to add some restrictions on the
   * objects the selected tags are related to.
   * The second optionnal parameter permits to restrict the tag selection with
   * different criterias
   *
   * @param      mixed       $tags
   * @param      array       $options
   * @return     array
   */
  public static function getRelatedTags($tags = array(), $options = array())
  {
    $tags = IceTaggableToolkit::explodeTagString($tags);

    if (is_string($tags))
    {
      $tags = array($tags);
    }

    $tagging_options = $options;

    if (isset($tagging_options['limit']))
    {
      unset($tagging_options['limit']);
    }

    $taggings = self::getTaggings($tags, $tagging_options);
    $result = array();

    foreach ($taggings as $key => $tagging)
    {
      $c = new Criteria();
      $c->add(iceModelTagPeer::NAME, $tags, Criteria::NOT_IN);
      $c->add(iceModelTaggingPeer::TAGGABLE_ID, $tagging, Criteria::IN);
      $c->add(iceModelTaggingPeer::TAGGABLE_MODEL, $key);
      $c->addJoin(iceModelTaggingPeer::TAG_ID, iceModelTagPeer::ID);
      $tag_objects = iceModelTagPeer::doSelect($c);

      foreach ($tag_objects as $tag)
      {
        if (!isset($result[$tag->getName()]))
        {
          $result[$tag->getName()] = 0;
        }

        $result[$tag->getName()]++;
      }
    }

    if (isset($options['limit']))
    {
      arsort($result);
      $result = array_slice($result, 0, $options['limit'], true);
    }

    ksort($result);
    return IceTaggableToolkit::normalize($result);
  }

  /**
   * Retrieves the objects tagged with one or several tags.
   *
   * The second optionnal parameter permits to restrict the tag selection with
   * different criterias
   *
   * @param      mixed       $tags
   * @param      array       $options
   * @return     array
   */
  public static function getTaggedWith($tags = array(), $options = array())
  {
    $taggings = self::getTaggings($tags, $options);
    $result = array();

    foreach ($taggings as $key => $tagging)
    {
      $c = new Criteria();
      $peer = get_class(call_user_func(array(new $key, 'getPeer')));
      $objects = call_user_func(array($peer, 'retrieveByPKs'), $tagging);

      foreach ($objects as $object)
      {
        $result[] = $object;
      }
    }

    return $result;
  }

  /**
   * Retrieve a Criteria instance for querying tagged model objects.
   *
   * Example:
   *
   * $c = iceModelTagPeer::getTaggedWithCriteria('Article', array('tag1', 'tag2'));
   * $c->addDescendingOrderByColumn(ArticlePeer::POSTED_AT);
   * $c->setLimit(10);
   * $this->articles = ArticlePeer::doSelectJoinAuthor($c);
   *
   * @param  string    $model  Taggable model name
   * @param  mixed     $tags   array of tags (can be a string where tags are
   * comma separated)
   * @param  Criteria  $c      Existing Criteria to hydrate
   * @return Criteria
   */
  public static function getTaggedWithCriteria($model, $tags = array(), Criteria $c = null, $options = array())
  {
    $tags = IceTaggableToolkit::explodeTagString($tags);

    if (is_string($tags))
    {
      $tags = array($tags);
    }

    if (!$c instanceof Criteria)
    {
      $c = new Criteria();
    }

    if (!class_exists($model) || !is_callable(array(new $model, 'getPeer')))
    {
      throw new PropelException(sprintf('The class "%s" does not exist, or it is not a model class.',
                                        $model));
    }

    $options['model'] = $model;
    $taggings = self::getTaggings($tags, $options);
    $tagging = isset($taggings[$model]) ? $taggings[$model] : array();
    $peer = get_class(call_user_func(array(new $model, 'getPeer')));
    $c->add(constant($peer.'::ID'), $tagging, Criteria::IN);

    return $c;
  }

  /**
   * Returns the taggings associated to one tag or a set of tags.
   *
   * The second optionnal parameter permits to restrict the results with
   * different criterias
   *
   * @param      mixed       $tags      Array of tag strings or string
   * @param      array       $options   Array of options parameters
   * @return     array
   */
  public static function getTaggings($tags = array(), $options = array())
  {
    $tags = IceTaggableToolkit::explodeTagString($tags);

    if (is_string($tags))
    {
      $tags = array($tags);
    }

    $c = new Criteria();
    $c->addJoin(iceModelTagPeer::ID, iceModelTaggingPeer::TAG_ID);

    if (count($tags) > 0)
    {
      $c->add(iceModelTagPeer::NAME, $tags, Criteria::IN);
      $having = $c->getNewCriterion('COUNT('.iceModelTaggingPeer::TAGGABLE_MODEL.') ', count($tags), Criteria::GREATER_EQUAL);
      $c->addHaving($having);
    }

    $c->addGroupByColumn(iceModelTaggingPeer::TAGGABLE_ID);
    $c->clearSelectColumns();
    $c->addSelectColumn(iceModelTaggingPeer::TAGGABLE_MODEL);
    $c->addSelectColumn(iceModelTaggingPeer::TAGGABLE_ID);

    // Taggable model class option
    if (isset($options['model']))
    {
      if (!class_exists($options['model']) || !is_callable(array(new $options['model'], 'getPeer')))
      {
        throw new PropelException(sprintf('The class "%s" does not exist, or it is not a model class.',
                                          $options['model']));
      }

      $c->add(iceModelTaggingPeer::TAGGABLE_MODEL, $options['model']);
    }
    else
    {
      $c->addGroupByColumn(iceModelTaggingPeer::TAGGABLE_MODEL);
    }

    if (isset($options['triple']))
    {
      $c->add(iceModelTagPeer::IS_TRIPLE, $options['triple']);
    }

    if (isset($options['namespace']))
    {
      $c->add(iceModelTagPeer::TRIPLE_NAMESPACE, $options['namespace']);
    }

    if (isset($options['key']))
    {
      $c->add(iceModelTagPeer::TRIPLE_KEY, $options['key']);
    }

    if (isset($options['value']))
    {
      $c->add(iceModelTagPeer::TRIPLE_VALUE, $options['value']);
    }

    $param = array();
    $sql = BasePeer::createSelectSql($c, $param);
    $con = Propel::getConnection();

    if (Propel::VERSION < '1.3')
    {
      $stmt = $con->prepareStatement($sql);
      $position = 1;

      foreach ($tags as $tag)
      {
        $stmt->setString($position, $tag);
        $position++;
      }

      if (isset($options['model']))
      {
        $stmt->setString($position, $options['model']);
        $position++;
      }

      if (isset($options['triple']))
      {
        $stmt->setBoolean($position, $options['triple']);
        $position++;
      }

      if (isset($options['namespace']))
      {
        $stmt->setString($position, $options['namespace']);
        $position++;
      }

      if (isset($options['key']))
      {
        $stmt->setString($position, $options['key']);
        $position++;
      }

      if (isset($options['value']))
      {
        $stmt->setString($position, $options['value']);
        $position++;
      }
    }
    else
    {
      $stmt = $con->prepare($sql);
      $position = 1;

      foreach ($tags as $tag)
      {
        $stmt->bindValue(':p'.$position, $tag, PDO::PARAM_STR);
        $position++;
      }

      if (isset($options['model']))
      {
        $stmt->bindValue(':p'.$position, $options['model'], PDO::PARAM_STR);
        $position++;
      }

      if (isset($options['triple']))
      {
        $stmt->bindValue(':p'.$position, $options['triple']);
        $position++;
      }

      if (isset($options['namespace']))
      {
        $stmt->bindValue(':p'.$position, $options['namespace'], PDO::PARAM_STR);
        $position++;
      }

      if (isset($options['key']))
      {
        $stmt->bindValue(':p'.$position, $options['key'], PDO::PARAM_STR);
        $position++;
      }

      if (isset($options['value']))
      {
        $stmt->bindValue(':p'.$position, $options['value'], PDO::PARAM_STR);
        $position++;
      }
    }

    if (!isset($options['nb_common_tags'])
        || ($options['nb_common_tags'] > count($tags)))
    {
      $options['nb_common_tags'] = count($tags);
    }

    if ($options['nb_common_tags'] > 0)
    {
      if (Propel::VERSION >= '1.3')
      {
        $stmt->bindValue(':p'.$position, $options['nb_common_tags'], PDO::PARAM_STR);
      }
      else
      {
        $stmt->setString($position, $options['nb_common_tags']);
      }
    }

    $taggings = array();

    if (Propel::VERSION >= '1.3')
    {
      $rs = $stmt->execute();

      while ($row = $stmt->fetch(PDO::FETCH_NUM))
      {
        $model = $row[0];

        if (!isset($taggings[$model]))
        {
          $taggings[$model] = array();
        }

        $taggings[$model][] = $row[1];
      }
    }
    else
    {
      $rs = $stmt->executeQuery(ResultSet::FETCHMODE_NUM);

      while ($rs->next())
      {
        $model = $rs->getString(1);

        if (!isset($taggings[$model]))
        {
          $taggings[$model] = array();
        }

        $taggings[$model][] = $rs->getInt(2);
      }
    }

    return $taggings;
  }

  /**
   * Retrives a tag by his name.
   *
   * @param      String      $tagname
   * @return     Tag
   */
  public static function retrieveByTagname($tagname)
  {
    $c = new Criteria();
    $c->add(iceModelTagPeer::NAME, $tagname);
    return iceModelTagPeer::doSelectOne($c);
  }

  /**
   * Retrieves a tag by his name. If it does not exist, creates it (but does not
   * save it)
   *
   * @param      String      $tagname
   * @return     Tag
   */
  public static function retrieveOrCreateByTagname($tagname)
  {
    // retrieve or create the tag
    $tag = iceModelTagPeer::retrieveByTagName($tagname);

    if (!$tag)
    {
      $tag = new iceModelTag();
      $tag->setName($tagname);
      $triple = IceTaggableToolkit::extractTriple($tagname);
      list($tagname, $triple_namespace, $triple_key, $triple_value) = $triple;
      $tag->setTripleNamespace($triple_namespace);
      $tag->setTripleKey($triple_key);
      $tag->setTripleValue($triple_value);
      $tag->setIsTriple(!is_null($triple_namespace));
    }

    return $tag;
  }

  /**
   * Removes the tags that are excluded in the related items
   *
   * @param  array  $tag_ids
   * @param  array  $disabled_tags
   *
   * @return array
   */
  public static function removeTagsForRelatedItems($tag_ids = array(), $disabled_tags = array('vintage'))
  {
    $disabled_tags_ids = array();

    foreach ($disabled_tags as $disabled_tag)
    {
      $result = iceModelTagPeer::retrieveByTagname($disabled_tag);
      $disabled_tags_ids[] = $result->getId();
    }

    if (count($disabled_tags_ids) > 0)
    {
      if (count($tag_ids) > 0 )
      {
        foreach ($tag_ids as $tag_id_key => $tag_id)
        {
          if (in_array($tag_id, $disabled_tags_ids))
          {
            unset($tag_ids[$tag_id_key]);
          }
        }
      }
    }

    return $tag_ids;
  }
}

sfPropelBehavior::add(
  'iceModelTag',
  array(
    'PropelActAsSluggableBehavior' => array(
      'columns' => array(
        'from' => iceModelTagPeer::NAME,
        'to'   => iceModelTagPeer::SLUG
      ),
      'separator' => '-',
      'permanent' => false,
      'chars' => 255
    )
  )
);

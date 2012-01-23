<?php

class IceTaggableBehavior
{
  /**
   * parameterHolder access methods
   */
  private static function getTagsHolder(BaseObject $object)
  {
    if ((!isset($object->_tags)) || ($object->_tags == null))
    {
      $object->_tags = new sfNamespacedParameterHolder();
    }

    return $object->_tags;
  }

  private static function add_tag(BaseObject $object, $tag)
  {
    $tag = IceTaggableToolkit::cleanTagName($tag);
    $slug = Utf8::slugify($tag, '-', true);

    if (strlen($tag) > 0)
    {
      self::getTagsHolder($object)->set($slug, $tag, 'tags');
    }
  }

  private static function clear_tags(BaseObject $object)
  {
    return self::getTagsHolder($object)->removeNamespace('tags');
  }

  private static function get_tags(BaseObject $object)
  {
    return self::getTagsHolder($object)->getAll('tags');
  }

  private static function set_tags(BaseObject $object, $tags)
  {
    self::clear_tags($object);
    self::getTagsHolder($object)->add($tags, 'tags');
  }

  private static function add_saved_tag(BaseObject $object, $tag)
  {
    $slug = Utf8::slugify($tag, '-', true);

    self::getTagsHolder($object)->set($slug, $tag, 'saved_tags');
  }

  private static function clear_saved_tags(BaseObject $object)
  {
    return self::getTagsHolder($object)->removeNamespace('saved_tags');
  }

  private static function get_saved_tags(BaseObject $object)
  {
    return self::getTagsHolder($object)->getAll('saved_tags');
  }

  private static function set_saved_tags(BaseObject $object, $tags = array())
  {
    self::clear_saved_tags($object);
    self::getTagsHolder($object)->add($tags, 'saved_tags');
  }

  private static function add_removed_tag(BaseObject $object, $tag)
  {
    $slug = Utf8::slugify($tag, '-', true);

    self::getTagsHolder($object)->set($tag, $tag, 'removed_tags');
  }

  private static function clear_removed_tags(BaseObject $object)
  {
    return self::getTagsHolder($object)->removeNamespace('removed_tags');
  }

  private static function get_removed_tags(BaseObject $object)
  {
    return self::getTagsHolder($object)->getAll('removed_tags');
  }

  private static function set_removed_tags(BaseObject $object, $tags)
  {
    self::clear_removed_tags($object);
    self::getTagsHolder($object)->add($tags, 'removed_tags');
  }


  /**
   * Adds a tag to the object. The "tagname" param can be a string or an array
   * of strings. These 3 code sequences produce an equivalent result :
   *
   * 1- $object->addTag('tag1,tag2,tag3');
   * 2- $object->addTag('tag1');
   *    $object->addTag('tag2');
   *    $object->addTag('tag3');
   * 3- $object->addTag(array('tag1','tag2','tag3'));
   *
   * @param      BaseObject  $object
   * @param      mixed       $tagname
   */
  public function addTag(BaseObject $object, $tagname)
  {
    $tagname = IceTaggableToolkit::explodeTagString($tagname);

    if (is_array($tagname))
    {
      foreach ($tagname as $tag)
      {
        $this->addTag($object, $tag);
      }
    }
    else
    {
      $removed_tags = self::get_removed_tags($object);

      if (isset($removed_tags[$tagname]))
      {
        unset($removed_tags[$tagname]);
        self::set_removed_tags($object, $removed_tags);
        self::add_saved_tag($object, $tagname);
      }
      else
      {
        $saved_tags = $this->getSavedTags($object);

        if (sfConfig::get('app_IceTaggableBehaviorPlugin_triple_distinct', false))
        {
          // the binome namespace:key must be unique
          $triple = IceTaggableToolkit::extractTriple($tagname);

          if (!is_null($triple[1]) && !is_null($triple[2]))
          {
            $pattern = '/^'.$triple[1].':'.$triple[2].'=(.*)$/';
            $tags = $object->getTags(array('triple' => true, 'return' => 'tag'));
            $removed = array();

            foreach ($tags as $tag)
            {
              if (preg_match($pattern, $tag))
              {
                $removed[] = $tag;
              }
            }

            $object->removeTag($removed);
          }
        }

        if (!isset($saved_tags[$tagname]))
        {
          self::add_tag($object, $tagname);
        }
      }
    }
  }

  /**
   * Retrieves from the database tags that have been atached to the object.
   * Once loaded, this saved tags list is cached and updated in memory.
   *
   * @param      BaseObject  $object
   */
  private function getSavedTags(BaseObject $object)
  {
    if (!isset($object->_tags) || !$object->_tags->hasNamespace('saved_tags'))
    {
      if (true === $object->isNew())
      {
        self::set_saved_tags($object, array());
        return array();
      }
      else
      {
        $c = new Criteria();
        $c->add(iceModelTaggingPeer::TAGGABLE_ID, $object->getPrimaryKey());
        $c->add(iceModelTaggingPeer::TAGGABLE_MODEL, get_class($object));
        $c->addJoin(iceModelTaggingPeer::TAG_ID, iceModelTagPeer::ID);
        $saved_tags = iceModelTagPeer::doSelect($c);
        $tags = array();

        foreach ($saved_tags as $tag)
        {
          $tags[$tag->getSlug()] = $tag->getName();
        }

        self::set_saved_tags($object, $tags);
        return $tags;
      }
    }
    else
    {
      return self::get_saved_tags($object);
    }
  }

  /**
   * Returns the list of the tags attached to the object, whatever they have
   * already been saved or not.
   *
   * @param      BaseObject  $object
   */
  public function getTags(BaseObject $object, $options = array())
  {
    $tags = array_merge(self::get_tags($object), $this->getSavedTags($object));

    if (isset($options['is_triple']) && (true === $options['is_triple']))
    {
      $tags = array_map(array('IceTaggableToolkit', 'extractTriple'), $tags);
      $pattern = array('tag', 'namespace', 'key', 'value');

      foreach ($pattern as $key => $value)
      {
        if (isset($options[$value]))
        {
          $tags_array = array();

          foreach ($tags as $tag)
          {
            if ($tag[$key] == $options[$value])
            {
              $tags_array[] = $tag;
            }
          }

          $tags = $tags_array;
        }
      }

      $return = (isset($options['return']) && in_array($options['return'], $pattern)) ? $options['return'] : 'all';

      if ('all' != $return)
      {
        $keys = array_flip($pattern);
        $tags_array = array();

        foreach ($tags as $tag)
        {
          if (null != $tag[$keys[$return]])
          {
            $tags_array[] = $tag[$keys[$return]];
          }
        }

        $tags = array_unique($tags_array);
      }
    }

    if (!isset($return) || ('all' != $return))
    {
      ksort($tags);

      if (isset($options['serialized']) && (true === $options['serialized']))
      {
        $tags = implode(', ', $tags);
      }
    }

    return $tags;
  }

  /**
   * Returns true if the object has a tag. If a tag ar an array of tags is
   * passed in second parameter, checks if these tags are attached to the object
   *
   * These 3 calls are equivalent :
   * 1- $object->hasTag('tag1')
   *    && $object->hasTag('tag2')
   *    && $object->hasTag('tag3');
   * 2- $object->hasTag('tag1,tag2,tag3');
   * 3- $object->hasTag(array('tag1', 'tag2', 'tag3'));
   *
   * @param  BaseObject  $object
   * @param  mixed       $tag
   */
  public function hasTag(BaseObject $object, $tag = null)
  {
    $tag = IceTaggableToolkit::explodeTagString($tag);

    if (is_array($tag))
    {
      $result = true;

      foreach ($tag as $tagname)
      {
        $result = $result && $this->hasTag($object, $tagname);
      }

      return $result;
    }
    else
    {
      $tags = self::get_tags($object);

      if ($tag === null)
      {
        return (count($tags) > 0) || (count($this->getSavedTags($object)) > 0);
      }
      elseif (is_string($tag))
      {
        $tag = IceTaggableToolkit::cleanTagName($tag);
        $slug = Utf8::slugify($tag, '-', true);

        if (isset($tags[$slug]))
        {
          return true;
        }
        else
        {
          $saved_tags = $this->getSavedTags($object);
          $removed_tags = self::get_removed_tags($object);

          return isset($saved_tags[$slug]) && !isset($removed_tags[$slug]);
        }
      }
      else
      {
        throw new LogicException(sprintf(
          'IceTaggableBehavior::hasTag() does not support this type of argument : %s.', get_class($tag)
        ));
      }
    }
  }

  /**
   * Tags saving logic, runned after the object himself has been saved
   *
   * @param  BaseObject  $object
   */
  public function postSave(BaseObject $object)
  {
    if (is_null($object->getPrimaryKey()))
    {
      return;
    }

    $tags = self::get_tags($object);
    $removed_tags = self::get_removed_tags($object);

    // save new tags
    foreach ($tags as $tagname)
    {
      $tag = iceModelTagPeer::retrieveOrCreateByTagName($tagname);
      $tag->save();
      $tagging = new iceModelTagging();
      $tagging->setTagId($tag->getId());
      $tagging->setTaggableId($object->getPrimaryKey());
      $tagging->setTaggableModel(get_class($object));
      $tagging->save();
    }

    // remove removed tags, if any present
    if (count($removed_tags) > 0)
    {
      $removed_tag_ids = array();
      $c = new Criteria();
      $c->add(iceModelTagPeer::NAME, $removed_tags, Criteria::IN);

      $rs = iceModelTagPeer::doSelectStmt($c);

      while ($row = $rs->fetch(PDO::FETCH_ASSOC))
      {
        $removed_tag_ids[] = intval($row['ID']);
      }

      $c = new Criteria();
      $c->add(iceModelTaggingPeer::TAG_ID, $removed_tag_ids, Criteria::IN);
      $c->add(iceModelTaggingPeer::TAGGABLE_ID, $object->getPrimaryKey());
      $c->add(iceModelTaggingPeer::TAGGABLE_MODEL, get_class($object));

      iceModelTaggingPeer::doDelete($c);
    }

    $tags = array_merge(self::get_tags($object), $this->getSavedTags($object));

    self::set_saved_tags($object, $tags);
    self::clear_tags($object);
    self::clear_removed_tags($object);
  }

  /**
   * Taggings removing logic, runned before the object himself has been deleted
   *
   * @param  BaseObject  $object
   */
  public function preDelete(BaseObject $object)
  {
    $object->removeAllTags();
    $object->save();
  }

  /**
   * Preload tags for a set of objects. It might be usefull in case you want to
   * display a long list of taggable objects with their associated tags: it
   * avoids to load tags per object, and gets all tags in a few requests.
   *
   * @param  array  $objects
   */
  public static function preloadTags(&$objects)
  {
    $searched = array();

    foreach ($objects as $object)
    {
      $class = get_class($object);

      if (!isset($searched[$class]))
      {
        $searched[$class] = array();
      }

      $searched[$class][$object->getPrimaryKey()] = $object;
    }

    if (count($searched) > 0)
    {
      $con = Propel::getConnection();

      foreach ($searched as $model => $instances)
      {
        array_map(array('self', 'set_saved_tags'), $instances, array_fill(0, count($instances), array()));
        $keys = array_keys($instances);
        $query = 'SELECT %s as id, GROUP_CONCAT(%s) as tags, GROUP_CONCAT(%s) as slugs
                    FROM %s, %s
                   WHERE %s IN (%s)
                     AND %s=?
                     AND %s=%s
                   GROUP BY %s';

        $query = sprintf(
          $query,
          iceModelTaggingPeer::TAGGABLE_ID,
          iceModelTagPeer::NAME, iceModelTagPeer::SLUG,
          iceModelTaggingPeer::TABLE_NAME,
          iceModelTagPeer::TABLE_NAME,
          iceModelTaggingPeer::TAGGABLE_ID,
          implode($keys, ','),
          iceModelTaggingPeer::TAGGABLE_MODEL,
          iceModelTaggingPeer::TAG_ID,
          iceModelTagPeer::ID,
          iceModelTaggingPeer::TAGGABLE_ID
        );

        $stmt = $con->prepare($query);
        $stmt->bindValue(1, $model);
        $stmt->execute();

        while ($row = $stmt->fetch())
        {
          $object = $instances[$row['id']];
          $object_tags = explode(',', $row['tags']);
          $object_slugs = explode(',', $row['slugs']);
          $tags = array();

          foreach ($object_tags as $i => $tag)
          {
            $tags[$object_slugs[$i]] = $tag;
          }

          self::set_saved_tags($object, $tags);
        }
      }
    }
  }

  /**
   * Removes all the tags associated with the object.
   *
   * @param  BaseObject  $object
   */
  public function removeAllTags(BaseObject $object)
  {
    $saved_tags = self::getSavedTags($object);

    self::set_saved_tags($object, array());
    self::set_tags($object, array());
    self::set_removed_tags($object, array_merge(self::get_removed_tags($object), $saved_tags));
  }

  /**
   * Removes a tag or a set of tags from the object. As usual, the second
   * parameter might be an array of tags or a comma-separated string.
   *
   * @param  BaseObject  $object
   * @param  mixed       $tagname
   */
  public function removeTag(BaseObject $object, $tagname)
  {
    $tagname = IceTaggableToolkit::explodeTagString($tagname);

    if (is_array($tagname))
    {
      foreach ($tagname as $tag)
      {
        $this->removeTag($object, $tag);
      }
    }
    else
    {
      $tagname = IceTaggableToolkit::cleanTagName($tagname);
      $tags = self::get_tags($object);
      $saved_tags = $this->getSavedTags($object);

      if (isset($tags[$tagname]))
      {
        unset($tags[$tagname]);
        self::set_tags($object, $tags);
      }

      if (isset($saved_tags[$tagname]))
      {
        unset($saved_tags[$tagname]);

        self::set_saved_tags($object, $saved_tags);
        self::add_removed_tag($object, $tagname);
      }
    }
  }

  /**
   * Replaces a tag with an other one. If the third optionnal parameter is not
   * passed, the second tag will simply be removed
   *
   * @param  BaseObject  $object
   * @param  String      $tagname
   * @param  String      $replacement
   */
  public function replaceTag(BaseObject $object, $tagname, $replacement = null)
  {
    if (($replacement != $tagname) && ($tagname != null))
    {
      $this->removeTag($object, $tagname);

      if ($replacement != null)
      {
        $this->addTag($object, $replacement);
      }
    }
  }

  /**
   * Sets the tags of an object. As usual, the second parameter might be an
   * array of tags or a comma-separated string.
   *
   * @param  BaseObject  $object
   * @param  mixed       $tagname
   */
  public function setTags(BaseObject $object, $tagname)
  {
    $this->removeAllTags($object);
    $this->addTag($object, $tagname);
  }
}

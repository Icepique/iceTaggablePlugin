<?php

require 'plugins/iceTaggablePlugin/lib/model/om/BaseiceModelTag.php';


/**
 * Skeleton subclass for representing a row from the 'tag' table.
 *
 * @package    propel.generator.plugins.iceTaggablePlugin.lib.model
 */
class iceModelTag extends BaseiceModelTag
{
  public function getModelsTaggedWith()
  {
    return iceModelTagPeer::getModelsTaggedWith($this->getName());
  }

  public function getRelated($options = array())
  {
    return iceModelTagPeer::getRelatedTags($this->getName());
  }

  public function getTaggedWith($options = array())
  {
    return iceModelTagPeer::getTaggedWith($this->getName());
  }
}

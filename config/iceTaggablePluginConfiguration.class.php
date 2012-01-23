<?php

class iceTaggablePluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {
	sfPropelBehavior::registerHooks('IceTaggableBehavior', array (
	  ':save:post' => array ('IceTaggableBehavior', 'postSave'),
	  ':delete:pre' => array ('IceTaggableBehavior', 'preDelete'),
	));

	sfPropelBehavior::registerMethods('IceTaggableBehavior', array (
	  array('IceTaggableBehavior', 'addTag'),
	  array('IceTaggableBehavior', 'getTags'),
	  array('IceTaggableBehavior', 'hasTag'),
	  array('IceTaggableBehavior', 'removeAllTags'),
	  array('IceTaggableBehavior', 'removeTag'),
	  array('IceTaggableBehavior', 'replaceTag'),
	  array('IceTaggableBehavior', 'setTags'),
	));

    return parent::initialize();
  }
}

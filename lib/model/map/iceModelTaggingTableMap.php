<?php



/**
 * This class defines the structure of the 'tagging' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.plugins.iceTaggablePlugin.lib.model.map
 */
class iceModelTaggingTableMap extends TableMap
{

  /**
   * The (dot-path) name of this class
   */
  const CLASS_NAME = 'plugins.iceTaggablePlugin.lib.model.map.iceModelTaggingTableMap';

  /**
   * Initialize the table attributes, columns and validators
   * Relations are not initialized by this method since they are lazy loaded
   *
   * @return     void
   * @throws     PropelException
   */
  public function initialize()
  {
    // attributes
    $this->setName('tagging');
    $this->setPhpName('iceModelTagging');
    $this->setClassname('iceModelTagging');
    $this->setPackage('plugins.iceTaggablePlugin.lib.model');
    $this->setUseIdGenerator(true);
    // columns
    $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
    $this->addForeignKey('TAG_ID', 'TagId', 'INTEGER', 'tag', 'ID', true, null, null);
    $this->addColumn('TAGGABLE_MODEL', 'TaggableModel', 'VARCHAR', false, 50, null);
    $this->addColumn('TAGGABLE_ID', 'TaggableId', 'INTEGER', false, null, null);
    // validators
  }

  /**
   * Build the RelationMap objects for this table relationships
   */
  public function buildRelations()
  {
    $this->addRelation('iceModelTag', 'iceModelTag', RelationMap::MANY_TO_ONE, array('tag_id' => 'id', ), 'CASCADE', null);
  }

  /**
   *
   * Gets the list of behaviors registered for this table
   *
   * @return array Associative array (name => parameters) of behaviors
   */
  public function getBehaviors()
  {
    return array(
      'symfony' => array('form' => 'true', 'filter' => 'true', ),
      'symfony_behaviors' => array(),
      'alternative_coding_standards' => array('brackets_newline' => 'true', 'remove_closing_comments' => 'true', 'use_whitespace' => 'true', 'tab_size' => '2', 'strip_comments' => 'false', ),
    );
  }

}

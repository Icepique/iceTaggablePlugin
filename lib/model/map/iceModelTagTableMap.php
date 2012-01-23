<?php



/**
 * This class defines the structure of the 'tag' table.
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
class iceModelTagTableMap extends TableMap
{

  /**
   * The (dot-path) name of this class
   */
  const CLASS_NAME = 'plugins.iceTaggablePlugin.lib.model.map.iceModelTagTableMap';

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
    $this->setName('tag');
    $this->setPhpName('iceModelTag');
    $this->setClassname('iceModelTag');
    $this->setPackage('plugins.iceTaggablePlugin.lib.model');
    $this->setUseIdGenerator(true);
    // columns
    $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
    $this->addColumn('NAME', 'Name', 'VARCHAR', false, 128, null);
    $this->getColumn('NAME', false)->setPrimaryString(true);
    $this->addColumn('SLUG', 'Slug', 'VARCHAR', false, 255, null);
    $this->addColumn('IS_TRIPLE', 'IsTriple', 'BOOLEAN', false, 1, false);
    $this->addColumn('TRIPLE_NAMESPACE', 'TripleNamespace', 'VARCHAR', false, 128, null);
    $this->addColumn('TRIPLE_KEY', 'TripleKey', 'VARCHAR', false, 128, null);
    $this->addColumn('TRIPLE_VALUE', 'TripleValue', 'VARCHAR', false, 128, null);
    // validators
  }

  /**
   * Build the RelationMap objects for this table relationships
   */
  public function buildRelations()
  {
    $this->addRelation('iceModelTagging', 'iceModelTagging', RelationMap::ONE_TO_MANY, array('id' => 'tag_id', ), 'CASCADE', null, 'iceModelTaggings');
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

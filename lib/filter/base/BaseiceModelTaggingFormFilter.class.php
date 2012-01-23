<?php

/**
 * iceModelTagging filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseiceModelTaggingFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'tag_id'         => new sfWidgetFormPropelChoice(array('model' => 'iceModelTag', 'add_empty' => true)),
      'taggable_model' => new sfWidgetFormFilterInput(),
      'taggable_id'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'tag_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'iceModelTag', 'column' => 'id')),
      'taggable_model' => new sfValidatorPass(array('required' => false)),
      'taggable_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ice_model_tagging_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'iceModelTagging';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'tag_id'         => 'ForeignKey',
      'taggable_model' => 'Text',
      'taggable_id'    => 'Number',
    );
  }
}

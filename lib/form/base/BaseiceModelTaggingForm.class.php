<?php

/**
 * iceModelTagging form base class.
 *
 * @method iceModelTagging getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseiceModelTaggingForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'tag_id'         => new sfWidgetFormPropelChoice(array('model' => 'iceModelTag', 'add_empty' => false)),
      'taggable_model' => new sfWidgetFormInputText(),
      'taggable_id'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'tag_id'         => new sfValidatorPropelChoice(array('model' => 'iceModelTag', 'column' => 'id')),
      'taggable_model' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'taggable_id'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ice_model_tagging[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'iceModelTagging';
  }


}

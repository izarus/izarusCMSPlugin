<?php

/**
 * PluginCmsPage form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class PluginCmsPageForm extends BaseCmsPageForm
{
  public function setup() {
    parent::setup();

    $this->widgetSchema['published_at'] = new sfWidgetFormDateTime();

    unset(
      $this['created_at']
      , $this['updated_at']
      , $this['slug']
    );
  }

  public function doSave($conn = null)
  {
    $pre_published_status = $this->getObject()->getPublished();
    $ppa = $this->getValue('published_at');

    $this->updateObject();

    if ($this->getObject()->getPublished()) {
      $this->getObject()->publish( (empty($ppa['day']))? date('Y-m-d H:i:s'): $ppa['year'].'-'.$ppa['month'].'-'.$ppa['day'].' '.$ppa['hour'].':'.$ppa['minute'], false);
    } else {
      $this->getObject()->unpublish(false);
    }
    $this->saveObject($con);
  }
}

<?php

class Publishable extends Doctrine_Template {


  public function setTableDefinition()
  {
    $this->hasColumn('published', 'boolean', null, array('default'=>0,'notnull'=>true));
    $this->hasColumn('published_at', 'datetime');
  }

  public function publish($at = null, $with_save = true)
  {
    if (!$at) $at = date('Y-m-d H:i:s');

    $invoker = $this->getInvoker();

    $publishedName = $invoker->getTable()->getFieldName('published');
    $publishedAtName = $invoker->getTable()->getFieldName('published_at');

    $invoker->$publishedName = 1;
    $invoker->$publishedAtName = $at;

    if($with_save){
      $invoker->save();
    }
  }

  public function unpublish($with_save = true)
  {
    $invoker = $this->getInvoker();

    $publishedName = $invoker->getTable()->getFieldName('published');
    $publishedAtName = $invoker->getTable()->getFieldName('published_at');

    $invoker->$publishedName = 0;
    $invoker->$publishedAtName = NULL;

    if($with_save){
      $invoker->save();
    }
  }

  public function isPublished()
  {
    return ($this->getInvoker()->getPublished())?true:false;
  }

}
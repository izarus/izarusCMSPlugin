<?php

class CmsContent
{
  private $pages;

  public function __construct($identifiers){
    if (is_string($identifiers)) {
      $this->pages[$identifiers] = CmsPageTable::findByIdentifier($identifiers);
    } elseif (is_array($identifiers)) {
      $this->pages = CmsPageTable::findByIdentifiers($identifiers);
    } else {
      $this->pages = NULL;
    }
  }

  private function checkIdentifier($identifier) {

    if (!is_string($identifier)) {
      throw new Exception("Not string identifier.", 500);
    }

    if (!isset($this->pages[$identifier])) {
      $tmp = CmsPageTable::findByIdentifier($identifier);
      if ($tmp) {
        $this->pages[$identifier] = $tmp;
        return true;
      } else {
        trigger_error('Page not loaded', E_USER_WARNING);
        return false;
      }
    }
    return true;
  }

  public function getTitle($identifier) {
    if (!$this->checkIdentifier($identifier)) return NULL;

    return $this->pages[$identifier]->getTitle();
  }

  public function getExcerpt($identifier, $create = false, $chars = 100)
  {
    if (!$this->checkIdentifier($identifier)) return NULL;

    if (!$this->pages[$identifier]->getExcerpt() && $create) {
      return substr(strip_tags($this->pages[$identifier]->getContent()),0,$chars);
    }

    return $this->pages[$identifier]->getExcerpt();
  }

  public function getContent($identifier)
  {
    if (!$this->checkIdentifier($identifier)) return NULL;

    return $this->pages[$identifier]->getContent();
  }

  public function getImage($identifier)
  {
    if (!$this->checkIdentifier($identifier)) return NULL;

    return $this->pages[$identifier]->getImage();
  }
}
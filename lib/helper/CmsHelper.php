<?php

function cms_get_title($identifier, $pages_array = array())
{
  global $pages;

  if (empty($pages_array) && !$pages) {
    return NULL;
  }

  if (isset($pages_array['identifier'])) {
    return $pages_array['identifier']->getTitle();
  } elseif (isset($pages['identifier'])) {
    return $pages['identifier']->getTitle();
  } else {
    return NULL;
  }
}
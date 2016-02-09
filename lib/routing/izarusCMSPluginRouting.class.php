<?php

/**
 *
 * @package
 * @subpackage
 * @author
 * @version
 */
class izarusCMSPluginRouting
{
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {

  }

  /**
   * Adds an sfDoctrineRouteCollection collection to manage cmspages.
   *
   * @param sfEvent $event
   * @static
   */
  static public function addRouteForcmspages(sfEvent $event)
  {
    $event->getSubject()->prependRoute('cmspages', new sfDoctrineRouteCollection(array(
      'name'                => 'cmspages',
      'model'               => 'CmsPage',
      'module'              => 'cmspages',
      'prefix_path'         => 'cmspages',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }


}


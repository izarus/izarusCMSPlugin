<?php

/**
 * izarusCMSPlugin configuration.
 *
 * @package    izarusCMSPlugin
 * @subpackage config
 * @author     David Vega
 * @version
 */
class izarusCMSPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    if ( sfConfig::get('app_izarus_cms_plugin_routes_register', true) )
    {
      $this->dispatcher->connect('routing.load_configuration', array('izarusCMSPluginRouting', 'listenToRoutingLoadConfigurationEvent'));
    }

    foreach (array('cmspages') as $module)
    {
      if (in_array($module, sfConfig::get('sf_enabled_modules', array())))
      {
        $this->dispatcher->connect('routing.load_configuration', array('izarusCMSPluginRouting', 'addRouteFor'.$module));
      }
    }
  }
}
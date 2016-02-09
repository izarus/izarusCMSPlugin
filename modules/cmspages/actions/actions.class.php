<?php

require_once dirname(__FILE__).'/../lib/cmspagesGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/cmspagesGeneratorHelper.class.php';

/**
 * Cmspages actions.
 *
 * @package    izarusCMSPlugin
 * @subpackage Cmspages
 * @author     David Vega
 * @version
 */
class cmspagesActions extends autocmspagesActions
{
  public function executePublish(sfWebRequest $request)
  {
    $page = CmsPageTable::getInstance()->find($request->getParameter('id'));
    $this->forward404Unless($page);
    try {
      $page->publish();
      $this->getUser()->setFlash('success','Page published.');
    } catch (Exception $e) {
      $this->getUser()->setFlash('error','Error publishing page.');
    }
    $this->redirect('@cmspages');
  }

  public function executeUnpublish(sfWebRequest $request)
  {
    $page = CmsPageTable::getInstance()->find($request->getParameter('id'));
    $this->forward404Unless($page);
    try {
      $page->unpublish();
      $this->getUser()->setFlash('success','Page unpublished.');
    } catch (Exception $e) {
      $this->getUser()->setFlash('error','Error unpublishing page.');
    }
    $this->redirect('@cmspages');
  }

}

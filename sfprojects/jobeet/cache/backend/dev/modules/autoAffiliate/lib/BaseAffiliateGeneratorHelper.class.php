<?php

/**
 * affiliate module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage affiliate
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseAffiliateGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'jobeet_affiliate' : 'jobeet_affiliate_'.$action;
  }
}

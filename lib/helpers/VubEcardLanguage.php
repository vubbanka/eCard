<?php
/**
 * Copyright 2016, For Best Clients, s.r.o.
 * http://www.forbestclients.com
 */
namespace VubEcard\helpers;

/**
 * Class that provides supported options for language
 *
 * @extends \VubEcard\helpers\VubEcardHelper
 *
 * @author For Best Clients, s.r.o. <info@forbestclients.com>
 * @author <http://www.forbestclients.com>
 */
class VubEcardLanguage extends \VubEcard\helpers\VubEcardHelper
{
  /**
   * Set of default values
   *
   * @var Array
   */
  private static $defaultValues = ['sk', 'en'];

  /**
   * Choose default value from $defaultValues
   * 
   * @return string Default value
   */
  public static function getDefaultValue() {
    return self::$defaultValues[0];
  }

}

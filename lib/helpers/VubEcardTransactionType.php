<?php
/**
 * Copyright 2016, For Best Clients, s.r.o.
 * http://www.forbestclients.com
 */
namespace VubEcard\helpers;

/**
 * Class that stores Authorization types
 *
 * @extends \VubEcard\helpers\VubEcardHelper
 *
 * @author For Best Clients, s.r.o. <info@forbestclients.com>
 * @author <http://www.forbestclients.com>
 */
class VubEcardTransactionType extends \VubEcard\helpers\VubEcardHelper
{
  private static $defaultValues = ['Auth', 'PreAuth'];

  /**
   * Choose default value from $defaultValues
   *
   * @return string Default value
   */
  public static function getDefaultValue() {
    return self::$defaultValues[0];
  }

}

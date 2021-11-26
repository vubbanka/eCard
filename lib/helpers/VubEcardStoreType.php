<?php
/**
 * Copyright 2016, For Best Clients, s.r.o.
 * http://www.forbestclients.com
 */
namespace VubEcard\helpers;

/**
 * Class that stores Store Type
 *
 * @extends \VubEcard\helpers\VubEcardHelper
 *
 * @author For Best Clients, s.r.o. <info@forbestclients.com>
 * @author <http://www.forbestclients.com>
 */
class VubEcardStoreType extends \VubEcard\helpers\VubEcardHelper
{
  private static $defaultValues = ['pay_hosting', '3d_pay', '3d', '3d_pay_hosting'];

  /**
   * Choose default value from $defaultValues
   *
   * @return string Default value
   */
  public static function getDefaultValue() {
    return '3d_pay_hosting';
  }
}

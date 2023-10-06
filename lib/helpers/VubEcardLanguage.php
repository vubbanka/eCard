<?php
/**
 * Copyright 2016, For Best Clients, s.r.o.
 * http://www.forbestclients.com
 */
namespace VubEcard\helpers;

use PhpParser\Node\Expr\Array_;

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
   * List of allowed languages
   *
   * @var string[]
   */
  public static $allowedLanguages = ['sk', 'en', 'cz', 'ru', 'pl', 'hu', 'de'];

  /**
   * Get default value for gateway language
   * 
   * @return string Default value
   */
  public static function getDefaultValue() {
    return 'en';
  }

}

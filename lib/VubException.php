<?php
/**
 * Copyright 2016, For Best Clients, s.r.o.
 * http://www.forbestclients.com
 */
namespace VubEcard;

use VubEcard\VubLog;

/**
 * VubException class is a basic extension of PHP Exception. VubExceptions logs
 * it's content.
 *
 * @author For Best Clients, s.r.o. <info@forbestclients.com>
 * @author <http://www.forbestclients.com>
 */
class VubException extends \Exception
{

  /**
   * Overridden constructor. Added functionality for storing error message
   * @param string  $message  Exception content
   * @param integer $code     Http status code
   * @param string  $previous
   */
  public function __construct($message, $code = 0, Exception $previous = null) {

      VubLog::writeError($message);

      parent::__construct($message, $code, $previous);
  }
}

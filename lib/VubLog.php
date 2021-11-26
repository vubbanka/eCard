<?php
/**
 * Copyright 2016, For Best Clients, s.r.o.
 * http://www.forbestclients.com
 */
namespace VubEcard;

/**
 * VubLog stores errors/notices/warnings in files.
 *
 * @author For Best Clients, s.r.o. <info@forbestclients.com>
 * @author <http://www.forbestclients.com>
 */
class VubLog
{

  /**
   * Defines log type Error
   */
  const LOG_TYPE_ERROR    = 0;

  /**
   * Defines log type Warning
   */
  const LOG_TYPE_WARNING  = 1;

  /**
   * Defines log type Notice
   */
  const LOG_TYPE_NOTICE   = 2;

  /**
   * Defines log type file name Error
   */
  const FILE_ERROR    = 'vub-error.log';

  /**
   * Defines log type file name Warning
   */
  const FILE_WARNING  = 'vub-warning.log';

  /**
   * Defines log type file name Notice
   */
  const FILE_NOTICE   = 'vub-notice.log';

  /**
   * Writes message into file according to type
   *
   * @param  int    $type    Type of error from provided error types
   * @param  string $message Content of message to be logged
   * @return bool            Returns result of file_put_contents operation
   */
  public static function write($type, $message)
  {
    $message = self::alterMessage($type, $message);

    if (!file_exists(self::getFile($type))) {

      return file_put_contents(self::getFile($type), $message);
    } else {

      return file_put_contents(self::getFile($type), $message, FILE_APPEND | LOCK_EX);
    }
  }

  /**
   * Staticaly returns name for provided error type
   *
   * @param  int $type Error type
   * @return string    Error name
   */
  private static function getTypeName($type)
  {
    switch ($type) {

      case self::LOG_TYPE_ERROR:

        return 'ERROR';
        break;

      case self::LOG_TYPE_WARNING:

        return 'WARNING';
        break;

      case self::LOG_TYPE_NOTICE:

        return 'NOTICE';
        break;

      default:

        return 'N/A';
        break;
    }
  }

  /**
   * Adds furthure information to logging message
   *
   * @param  int $type       Log type
   * @param  string $message Log description/content
   * @return string          Altered $message content
   */
  private static function alterMessage($type, $message) {
    return self::getMessagePrefix($type) . $message . self::getMessageSuffix();
  }

  /**
   * Getter for rich message content
   *
   * @param  int $type Log type
   * @return string    Log message prefix containing time and date
   */
  private static function getMessagePrefix($type)
  {
    return @date('Y-m-d H:i:s') . ' - ' . self::getTypeName($type) . ': ' . PHP_EOL;
  }

  /**
   * Getter for log message suffix
   *
   * @return string Message suffix
   */
  private static function getMessageSuffix()
  {
    return PHP_EOL . '---------------------' . PHP_EOL;
  }

  /**
   * Logs message as a error type
   *
   * @param  string $message Log message content
   * @return bool            Result of method write()
   */
  public static function writeError($message)
  {
    return self::write(self::LOG_TYPE_ERROR, $message);
  }

  /**
   * Logs message as a warning type
   *
   * @param  string $message Log message content
   * @return bool            Result of method write()
   */
  public static function writeWarning($message)
  {
    return self::write(self::LOG_TYPE_WARNING, $message);
  }

  /**
   * Logs message as a notice type
   *
   * @param  string $message Log message content
   * @return bool            Result of method write()
   */
  public static function writeNotice($message)
  {
    return self::write(self::LOG_TYPE_NOTICE, $message);
  }

  /**
   * Creates path for specific log file according to type
   *
   * @param  integer $type Log type
   * @return string        File path
   */
  private static function getFile($type = 1)
  {

    $path = __DIR__ . '/../logs/';

    switch ($type) {

      case self::LOG_TYPE_ERROR:

        $path .= self::FILE_ERROR;
        break;

      case self::LOG_TYPE_WARNING:

        $path .= self::FILE_WARNING;
        break;

      case self::LOG_TYPE_NOTICE:

        $path .= self::FILE_NOTICE;
        break;

      default:

        throw new VubException('Undefined error type', 500);
        break;
    }

    return $path;
  }
}

<?php
/**
 * Copyright 2016, For Best Clients, s.r.o.
 * http://www.forbestclients.com
 */
namespace VubEcard\helpers;

/**
 * Base helper class, that defines abstract methods and properties for helpers
 *
* @author For Best Clients, s.r.o. <info@forbestclients.com>
* @author <http://www.forbestclients.com>
*/
abstract class VubEcardHelper
{
    /**
     * Stores data
     *
     * @var Array
     */
    private static $data = [];

    /**
     * Basic method which provide default data for VubEcard extension
     *
     * @abstract Method that has to be implemented. Abstraction itselves has been removed due to PHP restrictions
     * @return mixed According to implementation
     */
    public static function getDefaultValue(){}

    /**
     * Checks if searched value is in data
     *
     * @param  mixed  $value Value to be searched for
     * @return boolean
     */
    public static function isAllowed($value)
    {
      $class = get_called_class();
      return in_array($value, $class::$data);
    }

    /**
     * Magic method that checks for property and returns it
     *
     * @param  string $name Property name
     * @return mixed        Property value
     */
    public function __get($name)
    {
        $class = get_called_class();

        if (array_key_exists($name, $class::$data)) {
            return $class::$data[$name];
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);

        return null;
    }

    /**
     * Checks if searched property is set
     *
     * @param  string  $name Property name
     * @return boolean
     */
    public function __isset($name)
    {
        $class = get_called_class();
        return isset($class::$data[$name]);
    }

    /**
     * Unset provided property
     *
     * @param  string  $name Property name
     * @return void
     */
    public function __unset($name)
    {
        $class = get_called_class();
        unset($class::$data[$name]);
    }
}

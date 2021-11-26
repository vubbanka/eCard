<?php
/**
 * Copyright 2016, For Best Clients, s.r.o.
 * http://www.forbestclients.com
 */
namespace VubEcard\helpers;

use VubEcard\VubException;

/**
 * Helps to build HTML tags and elements. Provide basic methods for creating
 * HTML tags, necessary for reaching VUB eCard payment gate
 *
 * @author For Best Clients, s.r.o. <info@forbestclients.com>
 * @author http://www.forbestclients.com
 */
class HtmlHelper
{
    /**
     * Calls self::input method. Builds hidden HTML input
     * @param  Array $htmlAttributes Array containing HTML attribute and value. [attribute=>value]
     * @return HTML                  HTML of created element
     */
    public static function inputHidden($htmlAttributes = [])
    {
        return self::input(array_merge($htmlAttributes, ['type' => 'hidden']));
    }

    /**
     * Builds HTML input
     * @param  Array $htmlAttributes Array containing HTML attribute and value. [attribute=>value]
     * @return HTML                  HTML of created element
     */
    public static function input($htmlAttributes = [])
    {
        return '<input ' . self::concatHtmlAttributes($htmlAttributes) . ' />';
    }

    /**
     * Builds HTML for opening form tag. Shorcut for calling tagOpen with
     * corresponding tag name
     * @param  Array $htmlAttributes Array containing HTML attribute and value. [attribute=>value]
     * @return HTML                  HTML of created element
     */
    public static function formOpen($htmlAttributes)
    {
        return self::tagOpen('form', $htmlAttributes);
    }

    /**
     * Builds HTML for closing form tag. Shorcut for calling tagOpen with
     * corresponding tag name
     * @return HTML                  HTML of created element
     */
    public static function formClose()
    {
        return self::tagClose('form');
    }

    /**
     * Build HTML opening tag according to provided inputs.
     * @param  string $tagName        Tag name to be builded
     * @param  Array $htmlAttributes  Array containing HTML attribute and value. [attribute=>value]
     * @return HTML                   HTML of created element
     */
    public static function tagOpen($tagName, $htmlAttributes = [])
    {
        return '<' . $tagName . ' ' . self::concatHtmlAttributes($htmlAttributes) . '>';
    }

    /**
     * Build HTML closing tag according to provided HTML tag name.
     * @param  string $tagName        Tag name to be builded
     * @return HTML                   HTML of created element
     */
    public static function tagClose($tagName)
    {
        return '</' . $tagName . '>';
    }

    /**
     * Concats provided array into readeable html attributes string.
     *
     * @example From array of ['style'=>'color:white', 'title'=>'test'] creates resulting string
     * style="color:white" title="test"
     *
     * @param  Array $htmlAttributes  Array containing HTML attribute and value. [attribute=>value]
     * @return string                 Concated string of html attributes
     */
    public static function concatHtmlAttributes($htmlAttributes = [])
    {
      if (!is_array($htmlAttributes)) {
        throw new VubException('HtmlAttributes have to be associative array [atttributeName => attributeValue]', 500);
      }

      $htmlAttributesString = [];
      foreach ($htmlAttributes as $attributeName => $attributeValue) {

        $htmlAttributesString[] = $attributeName . '="' . $attributeValue . '"';
      }

      return implode(' ', $htmlAttributesString);
    }

}

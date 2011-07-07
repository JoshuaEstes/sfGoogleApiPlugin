<?php

/**
 *
 */


class sfWidgetGooglePlacesApiTypes extends sfWidget
{

  /**
   * Renders the widget as HTML.
   *
   * All subclasses must implement this method.
   *
   * @param  string $name       The name of the HTML widget
   * @param  mixed  $value      The value of the widget
   * @param  array  $attributes An array of HTML attributes
   * @param  array  $errors     An array of errors
   *
   * @return string A HTML representation of the widget
   */
  public function  render($name, $value = null, $attributes = array(), $errors = array())
  {
    return $this->renderContentTag('select', implode("\n",$this->getOptionsForSelect($value)),array_merge(array('name' => $name), $attributes));
  }

  protected function getOptionsForSelect($value = null)
  {
    $optionArray = array();
    foreach (sfGooglePlacesApi::getLocationTypesArray() as $k => $v)
    {
      $optionArray[] = '<option value="'.$k.'"'.($value == $k ? ' selected="selected"' : '').'>'.$v.'</option>';
    }
    return $optionArray;
  }
}
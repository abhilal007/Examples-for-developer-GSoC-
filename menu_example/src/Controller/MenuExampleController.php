<<?php


namespace Drupal\menu_example\Controller;

use Drupal\Core\Controller\ControllerBase;

class MenuExampleControlller extends ControllerBase {

  function _menu_example_basic_instructions($content = NULL) {
  $base_content = t(
  'This is the base page of the Menu Example. There are a number of examples
  here, from the most basic (like this one) to extravagant mappings of loaded
  placeholder arguments. Enjoy!');
  return '<div>' . $base_content . '</div><br /><div>' . $content . '</div>';
}

}

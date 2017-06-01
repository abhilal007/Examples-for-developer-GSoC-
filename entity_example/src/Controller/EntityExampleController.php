<?php

namespace Drupal\entity_example\Controller;

use Drupal\examples\Utility\DescriptionTemplateTrait;
/**
 * Controller routines for entity example routes.
 */
class BlockExampleController {
  use DescriptionTemplateTrait;

  /**
   * {@inheritdoc}
   */
  protected function getModuleName() {
    return 'entity_example';
  }

}

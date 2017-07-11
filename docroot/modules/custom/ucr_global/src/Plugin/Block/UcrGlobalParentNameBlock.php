<?php

namespace Drupal\ucr_global\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'UCR Global: parent name' block.
 *
 * @Block(
 *   id = "ucr_global_parent_name",
 *   admin_label = @Translation("Display the parent name of the site.")
 * )
 */
class UcrGlobalParentNameBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::config('ucrglobal.settings');
    $parent_name = $config->get('parent_name');

    return array(
      '#type' => 'markup',
      '#markup' => $parent_name,
    );
  }

}

<?php

namespace Drupal\ucr_global\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'UCR Global: search' block.
 *
 * @Block(
 *   id = "ucr_global_search",
 *   admin_label = @Translation("Display the Google Search form.")
 * )
 */
class UcrGlobalSearchBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::config('ucrglobal.settings');
    $search_html = $config->get('search_html');

    return array(
      '#type' => 'markup',
      '#markup' => $search_html,
    );
  }

}

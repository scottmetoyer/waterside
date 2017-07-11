<?php

namespace Drupal\ucr_global\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements a form to collect security check configuration.
 */
class UcrGlobalSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'ucr_global_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['ucrglobal.settings'];
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $module_path = drupal_get_path('module', 'ucr_global');

    $config = \Drupal::config('ucrglobal.settings');

    $form['ucr_global_description'] = array(
      '#markup' => t('This module defines global blocks for UC Riverside sites.'),
    );

    $form['parent_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Parent name'),
      '#description' => $this->t('The parent name that should be displayed in the top-left corner of the site.'),
      '#required' => TRUE,
      '#default_value' => $config->get('parent_name'),
    ];

    $form['search_html'] = [
      '#type' => 'textarea',
      '#cols' => 6,
      '#title' => $this->t('Search form HTML'),
      '#description' => $this->t('The Google Search HTML and JavaScript snippet that creates the search form.'),
      '#required' => TRUE,
      '#default_value' => $config->get('search_html'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // @TODO
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $list = [];
    $this->buildAttributeList($list, $form_state->getValues());
    $config = $this->config('ucrglobal.settings');

    foreach ($list as $key => $value) {
      $config->set($key, $value);
    }

    $config->save();

    parent::submitForm($form, $form_state);
  }

  /**
   * Build the configuration form value list.
   */
  protected function buildAttributeList(
    array &$list = [],
    array $rawAttributes = [],
    $currentName = '')
  {
    foreach ($rawAttributes as $key => $rawAttribute) {
      $name = $currentName ? $currentName . '.' . $key:$key;
      if (in_array($name,['op','form_id','form_token','form_build_id','submit'])){
        continue;
      }
      if (is_array($rawAttribute)) {
        $this->buildAttributeList($list, $rawAttribute, $name);
      } else {
        $list[$name] = $rawAttribute;
      }
    }
  }
}

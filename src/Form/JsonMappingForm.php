<?php
namespace Drupal\custom_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class JsonMappingForm extends ConfigFormBase {

  protected function getEditableConfigNames() {
    return ['custom_module.settings'];
  }

  public function getFormId() {
    return 'json_mapping_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $default_mapping = \Drupal::state()->get('json_to_drupal_mapping', '{
      "city": "city",
      "loc": "loc",
      "pop": "pop",
      "state": "state"
    }');

    $form['mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Mapping'),
      '#description' => $this->t('Provide JSON mapping between JSON fields and Drupal entity fields.'),
      '#default_value' => $default_mapping,
      '#rows' => 10,
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save Mapping'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::state()->set('json_to_drupal_mapping', $form_state->getValue('mapping'));
    \Drupal::messenger()->addStatus($this->t('Mapping has been saved.'));
  }
}

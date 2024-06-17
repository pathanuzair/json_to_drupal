<?php

namespace Drupal\custom_module\Entity;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the City entity.
 * 
 * @ContentEntityType(
 *   id = "city",
 *   label = @Translation("City"),
 *   base_table = "city",
 *   entity_keys = {
 *     "id" = "id",
 *     "city" = "city",
 *     "state" = "state",
 *     "pop" = "pop",
 *     "loc" = "loc",
 *   },
 *   fieldable = TRUE,
 *   admin_permission = "administer city entity",
 *   handlers = {
 *     "list_builder" = "Drupal\Core\Entity\EntityListBuilder",
 *     "form" = {
 *       "default" = "Drupal\Core\Entity\EntityForm",
 *       "add" = "Drupal\Core\Entity\EntityForm",
 *       "edit" = "Drupal\Core\Entity\EntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *     },
 *   },
 * )
 */
class City extends ContentEntityBase {

  /**
   * Defines the base fields.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['id'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Label'))
      ->setRequired(TRUE);

    $fields['city'] = BaseFieldDefinition::create('string')
      ->setLabel(t('City'))
      ->setDescription(t('The name of the city.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setRequired(TRUE);

    $fields['state'] = BaseFieldDefinition::create('string')
      ->setLabel(t('State'))
      ->setDescription(t('The state of the city.'))
      ->setSettings([
        'max_length' => 2,
        'text_processing' => 0,
      ])
      ->setRequired(TRUE);

    $fields['pop'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Population'))
      ->setDescription(t('The population of the city.'))
      ->setRequired(TRUE);

    $fields['loc'] = BaseFieldDefinition::create('map')
      ->setLabel(t('Location'))
      ->setDescription(t('The location coordinates of the city.'))
      ->setRequired(TRUE);

    return $fields;
  }
}
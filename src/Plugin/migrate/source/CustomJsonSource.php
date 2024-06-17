<?php
namespace Drupal\mongo_to_drupal\Plugin\migrate\source;

use Drupal\migrate_plus\Plugin\migrate\source\Url;
use Drupal\migrate\Row;
use Drupal\migrate\MigrateException;

/**
 * Source plugin for retrieving data from a JSON file with dynamic mapping.
 *
 * @MigrateSource(
 *   id = "json_dynamic"
 * )
 */
class JsonDynamic extends Url {

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $mapping = \Drupal::state()->get('json_to_drupal_mapping');

    $mapping_array = json_decode($mapping, TRUE);
    foreach ($mapping_array as $json_field => $drupal_field) {
      if ($row->hasSourceProperty($json_field)) {
        $row->setDestinationProperty($drupal_field, $row->getSourceProperty($json_field));
      } else {
        throw new MigrateException(sprintf('Source property %s does not exist in the row.', $json_field));
      }
    }

    return parent::prepareRow($row);
  }
}

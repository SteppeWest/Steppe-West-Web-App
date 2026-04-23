<?php
/**
 * @frontend/helpers/SwBanner.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Load this factory with...
 * use frontend\helpers\SwMeta;
 * SwMeta::f($this, $options);
 * SwMeta::e($this);
 */

/**
 * Data Dictionary
 *
 * All accepted data is a flat dictionary of non-empty string keys
 * and non-empty string values.
 *
 * Data originating from params is treated as safe defaults.
 * Caller-supplied data is filtered before use.
 *
 * Only the keys listed below are consumed by this factory.
 * Unknown keys may be accepted into the merged options array,
 * but are ignored unless explicitly used by the registration logic.
 *
 * 'title'        => 'Page Title',             // from params
 * 'author'       => 'Page Author',            // from params
 * 'contentType'  => 'content-type',           // from params
 * 'description'  => 'Page description.',
 * 'keywords'     => 'Page keywords',
 * 'canonicalUrl' => 'http://steppewest.com/...',
 * 'updatedTime'  => 'timestamp',
 *
 * Override with extreme caution.
 *
 * 'locale'       => 'locale',                 // from params
 * 'viewport'     => 'viewport',               // from params
 */

/**
	Yii::$app->params['swMeta'] => [
		'locale'      => 'en_AU',
		'viewport'    => 'width=device-width, initial-scale=1, shrink-to-fit=no',
		'title'       => 'Steppe West',
		'author'      => 'Pedro Plowman for Steppe West',
		'contentType' => 'article',
	],
 */

namespace frontend\helpers;

use common\helpers\SwMetaFactory;

final class SwMeta extends SwMetaFactory
{
	// frontend meta factory logic
}

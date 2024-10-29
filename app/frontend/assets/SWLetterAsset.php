<?php
/**
 * SWLetterAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \common\assets\SWLetterAsset
 *
 * Load this asset with...
 * common\assets\SWLetterAsset::register($this);
 *
 * use common\assets\SWLetterAsset;
 * SWLetterAsset::register($this);
 *
 * or specify as a dependency with...
 *     'common\assets\SWLetterAsset',
 */

namespace common\assets;

use common\assets\SWAssetBundle;

class SWLetterAsset extends SWAssetBundle
{
	public $sourcePath = '@static/SWLetterAsset';

	public $css = [
		'css/steppe-west-letter.min.css',
	];

	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];
}

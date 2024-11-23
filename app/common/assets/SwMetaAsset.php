<?php
/**
 * SwMetaAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \common\assets\SwMetaAsset
 *
 * Load this asset with...
 * common\assets\SwMetaAsset::register($this);
 *
 * use common\assets\SwMetaAsset;
 * SwMetaAsset::register($this);
 *
 * or specify as a dependency with...
 *     'common\assets\SwMetaAsset',
 */

namespace common\assets;

use yii\web\AssetBundle;

class SwMetaAsset extends AssetBundle
{
	public $sourcePath = '@static/sw-meta';

	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];

	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap5\BootstrapAsset',
		'common\assets\P2BootstrapIconsAsset',
	];
}

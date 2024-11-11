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
 * @class \frontend\modules\assets\SwMetaAsset
 *
 * Load this asset with...
 * frontend\assets\SwMetaAsset::register($this);
 *
 * use frontend\assets\SwMetaAsset;
 * SwMetaAsset::register($this);
 *
 * or specify as a dependency with...
 *     'frontend\assets\SwMetaAsset',
 */

namespace frontend\assets;

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

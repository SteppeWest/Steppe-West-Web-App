<?php
/**
 * @common/assets/SwMetaAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \frontend\assets\SwMetaAsset
 *
 * Load this asset with...
 *
 * common\assets\SwMetaAsset::register($this);
 *
 * use common\assets\SwMetaAsset;
 * SwMetaAsset::register($this);
 *
 * or specify as a dependency with...
 *    'common\assets\SwMetaAsset',
 */

namespace common\assets;

use yii\web\AssetBundle;

class SwMetaAsset extends AssetBundle
{
	// @var string
	public $sourcePath = '@static/common/meta';

	// @var array
	public $depends = [
		'common\assets\SwCommonAsset',
	];
}

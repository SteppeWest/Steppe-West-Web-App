<?php
/**
 * @frontend/assets/SwMetaAsset.php
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
 * frontend\assets\SwMetaAsset::register($this);
 *
 * use frontend\assets\SwMetaAsset;
 * SwMetaAsset::register($this);
 *
 * or specify as a dependency with...
 *    'frontend\assets\SwMetaAsset',
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use frontend\assets\SwCommonAsset;

class SwMetaAsset extends AssetBundle
{
	// @var string
	public $sourcePath = '@static/frontend/meta';

	// @var array
	public $depends = [
		SwCommonAsset::class,
	];
}

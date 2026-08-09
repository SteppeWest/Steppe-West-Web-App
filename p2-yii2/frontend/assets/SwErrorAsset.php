<?php
/**
 * @frontend/assets/SwErrorAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \frontend\assets\SwErrorAsset
 *
 * Load this asset with...
 *
 * frontend\assets\SwErrorAsset::register($this);
 *
 * use frontend\assets\SwErrorAsset;
 * SwErrorAsset::register($this);
 *
 * or specify as a dependency with...
 *    SwErrorAsset::class,
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use frontend\assets\SwFrontendAsset;

class SwErrorAsset extends AssetBundle
{
	// @var string
	public $sourcePath = '@frontend/assets/lib/sw-error';

	// @var array
	public $css = [
		'css/error.min.css',
	];

	public $depends = [
		SwFrontendAsset::class,
	];
}

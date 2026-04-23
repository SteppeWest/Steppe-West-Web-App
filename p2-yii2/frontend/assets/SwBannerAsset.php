<?php
/**
 * @frontend/assets/SwBannerAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \frontend\assets\SwBannerAsset
 *
 * Load this asset with...
 *
 * frontend\assets\SwBannerAsset::register($this);
 *
 * use frontend\assets\SwBannerAsset;
 * SwBannerAsset::register($this);
 *
 * or specify as a dependency with...
 *    'frontend\assets\SwBannerAsset',
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use p2m\assets\P2CoreAsset;

class SwBannerAsset extends AssetBundle
{
	// @var string
	public $sourcePath = '@static/frontend/flags-banner';

	// @var array
	public $css = [
		'css/flags-banner.min.css',
	];

	public $depends = [
		P2CoreAsset::class,
	];
}

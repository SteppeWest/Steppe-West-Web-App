<?php
/**
 * @common/assets/SwBannerAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \common\assets\SwBannerAsset
 *
 * Load this asset with...
 *
 * common\assets\SwBannerAsset::register($this);
 *
 * use common\assets\SwBannerAsset;
 * SwBannerAsset::register($this);
 *
 * or specify as a dependency with...
 *    'common\assets\SwBannerAsset',
 */

namespace common\assets;

use yii\web\AssetBundle;
use p2m\assets\P2CoreAsset;

class SwBannerAsset extends AssetBundle
{
	// @var string
	public $sourcePath = '@common/assets/lib/flags-banner';

	// @var array
	public $css = [
		'css/flags-banner.min.css',
	];

	public $depends = [
		P2CoreAsset::class,
	];
}

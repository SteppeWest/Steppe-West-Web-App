<?php
/**
 * @frontend/assets/SwFlagsBannerAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \frontend\assets\SwFlagsBannerAsset
 *
 * Load this asset with...
 *
 * common\assets\SwFlagsBannerAsset::register($this);
 *
 * use common\assets\SwFlagsBannerAsset;
 * SwFlagsBannerAsset::register($this);
 *
 * or specify as a dependency with...
 *    'common\assets\SwFlagsBannerAsset',
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class SwFlagsBannerAsset extends AssetBundle
{
	// @var string
	public $sourcePath = '@static/frontend/flags-banner';

	// @var array
	public $css = [
		'css/flags-banner.min.css',
	];

	public $depends = [
		'p2m\assets\P2CoreAsset',
	];
}

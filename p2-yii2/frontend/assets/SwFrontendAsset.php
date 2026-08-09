<?php
/**
 * @frontend/assets/SwFrontendAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \frontend\assets\SwFrontendAsset
 *
 * Load this asset with...
 *
 * frontend\assets\SwFrontendAsset::register($this);
 *
 * use frontend\assets\SwFrontendAsset;
 * SwFrontendAsset::register($this);
 *
 * or specify as a dependency with...
 *    SwFrontendAsset::class,
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use common\assets\SwCommonAsset;

class SwFrontendAsset extends AssetBundle
{
	// @var string
	public $sourcePath = '@frontend/assets/lib/sw-frontend';

	// @var array
	public $css = [
		'css/sw-frontend.css',
	];

	public $depends = [
		SwCommonAsset::class,
	];
}

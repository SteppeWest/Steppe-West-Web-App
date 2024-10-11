<?php
/**
 * SWBootstrapIconsAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \common\assets\SWBootstrapIconsAsset
 *
 * Load this asset with...
 * common\assets\SWBootstrapIconsAsset::register($this);
 *
 * use common\assets\SWBootstrapIconsAsset;
 * SWBootstrapIconsAsset::register($this);
 *
 * or specify as a dependency with...
 *     'common\assets\SWBootstrapIconsAsset',
 */

namespace common\assets;

use yii\web\AssetBundle;

class SWBootstrapIconsAsset extends AssetBundle
{
	public $sourcePath = null;
	public $baseUrl = '//cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/';

	public $css = [
		'bootstrap-icons.css',
	];

	public $cssOptions = [
		'integrity' => 'sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd',
		'crossorigin' => 'anonymous',
	];
}

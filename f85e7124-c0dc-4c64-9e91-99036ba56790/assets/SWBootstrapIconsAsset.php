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
 * @class \app\assets\SWBootstrapIconsAsset
 *
 * Load this asset with...
 * app\assets\SWBootstrapIconsAsset::register($this);
 *
 * use app\assets\SWBootstrapIconsAsset;
 * SWBootstrapIconsAsset::register($this);
 *
 * or specify as a dependency with...
 *     'app\assets\SWBootstrapIconsAsset',
 */

namespace app\assets;

use yii\web\AssetBundle;

class SWBootstrapIconsAsset extends AssetBundle
{
	public $sourcePath = null;
	public $baseUrl = 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/';

	public $css = [
		'bootstrap-icons.css',
	];

	public $cssOptions = [
		'integrity' => 'sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd',
		'crossorigin' => 'anonymous',
	];
}

<?php
/**
 * SWAppAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \common\assets\SWAppAsset
 *
 * Load this asset with...
 * common\assets\SWAppAsset::register($this);
 *
 * use common\assets\SWAppAsset;
 * SWAppAsset::register($this);
 *
 * or specify as a dependency with...
 *     'common\assets\SWAppAsset',
 */

namespace common\assets;

use common\assets\SWAssetBundle;

class SWAppAsset extends SWAssetBundle
{
	public $css = [
		'css/steppe-west.min.css',
	];

	public $cssOptions = [
		'integrity' => 'sha384-nkZr4cTFCniMXs0pYxb6qp68BwC4+ijdl6pk9GxIyF+iGKX1nI/pV+b7UHiJEXt5',
		'crossorigin' => 'anonymous',
	];

/*
	public $js = [
		'js/steppe-west.min.js',
	];

	public $jsOptions = [
		'crossorigin' => 'anonymous',
	];
 */
}

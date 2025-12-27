<?php
/**
 * SwErrorAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \backend\assets\SwErrorAsset
 *
 * Load this asset with...
 * backend\assets\SwErrorAsset::register($this);
 *
 * use backend\assets\SwErrorAsset;
 * SwErrorAsset::register($this);
 *
 * or specify as a dependency with...
 *     'backend\assets\SwErrorAsset',
 */

namespace backend\assets;

use yii\web\AssetBundle;

class SwErrorAsset extends AssetBundle
{
	// @var string
	public $sourcePath = '@static/backend/auth';

	// @var array
	public $css = [
		'css/auth.min.css',
	];

	// @var array
	public $depends = [
		'p2m\assets\P2CoreAsset',
	];
}

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
 * common\assets\SwErrorAsset::register($this);
 *
 * use common\assets\SwErrorAsset;
 * SwErrorAsset::register($this);
 *
 * or specify as a dependency with...
 *    'common\assets\SwErrorAsset',
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use p2m\assets\P2CoreAsset;

class SwErrorAsset extends AssetBundle
{
	// @var string
	public $sourcePath = '@static/frontend/error';

	// @var array
	public $css = [
		'css/error.min.css',
	];

	public $depends = [
		P2CoreAsset::class,
	];
}

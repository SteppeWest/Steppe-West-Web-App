<?php
/**
 * @frontend/assets/SwBootstrapAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \frontend\assets\SwBootstrapAsset
 *
 * Load this asset with...
 *
 * frontend\assets\SwBootstrapAsset::register($this);
 *
 * use frontend\assets\SwBootstrapAsset;
 * SwBootstrapAsset::register($this);
 *
 * or specify as a dependency with...
 *    SwBootstrapAsset::class,
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use common\assets\SwCommonAsset;

class SwBootstrapAsset extends AssetBundle
{
	// @var string
	public $sourcePath = '@frontend/assets/lib/sw-bootstrap';

	// @var array
	public $css = [
		'css/sw-bootstrap.css',
	];

	public $depends = [
		SwCommonAsset::class,
	];
}

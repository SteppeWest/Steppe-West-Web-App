<?php
/**
 * P2FontAwesomeAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \common\assets\P2FontAwesomeAsset
 *
 * Load this asset with...
 * common\assets\P2FontAwesomeAsset::register($this);
 *
 * use common\assets\P2FontAwesomeAsset;
 * P2FontAwesomeAsset::register($this);
 *
 * or specify as a dependency with...
 *     'common\assets\P2FontAwesomeAsset',
 */

namespace common\assets;

use yii\web\AssetBundle;

class P2FontAwesomeAsset extends AssetBundle
{
	public $sourcePath = null;
	public $baseUrl = '//kit.fontawesome.com/';
	public $js = [
		'820f855cc1.js',
	];
	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];
}

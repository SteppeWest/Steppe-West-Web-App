<?php
/**
 * LinksAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \frontend\modules\assets\LinksAsset
 *
 * Load this asset with...
 * frontend\modules\assets\LinksAsset::register($this);
 *
 * use frontend\modules\assets\LinksAsset;
 * LinksAsset::register($this);
 *
 * or specify as a dependency with...
 *     'frontend\modules\assets\LinksAsset',
 */

namespace frontend\modules\assets;

class LinksAsset extends \yii\web\AssetBundle
{
	public $sourcePath = '@static/sw-links';

	public $css = [
		'css/sw-links.min.css',
	];

	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];

	public $depends = [
		'frontend\assets\SwMetaAsset',
	];
}

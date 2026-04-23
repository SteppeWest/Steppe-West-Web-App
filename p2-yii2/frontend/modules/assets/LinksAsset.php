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

use yii\web\AssetBundle;
use p2m\assets\P2CoreAsset;

class LinksAsset extends AssetBundle
{
	public $sourcePath = '@static/sw-links';

	public $css = [
		'css/sw-links.min.css',
	];

	public $depends = [
		P2CoreAsset::class,
	];
}

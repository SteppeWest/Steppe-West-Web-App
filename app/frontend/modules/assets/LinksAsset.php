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
 * frontend\modules\assets\LetterAsset::register($this);
 *
 * use frontend\modules\assets\LetterAsset;
 * LetterAsset::register($this);
 *
 * or specify as a dependency with...
 *     'themes\letter\assets\LetterAsset',
 */

namespace frontend\modules\assets;

use yii\web\AssetBundle;

class LinksAsset extends AssetBundle
{
	public $sourcePath = '@static/sw-links';

	public $css = [
		'css/sw-links.min.css',
	];

	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];
}

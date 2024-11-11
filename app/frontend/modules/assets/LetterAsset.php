<?php
/**
 * LetterAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \frontend\modules\assets\LetterAsset
 *
 * Load this asset with...
 * frontend\modules\assets\LetterAsset::register($this);
 *
 * use frontend\modules\assets\LetterAsset;
 * LetterAsset::register($this);
 *
 * or specify as a dependency with...
 *     'frontend\modules\assets\LetterAsset',
 */

namespace frontend\modules\assets;

class LetterAsset extends \yii\web\AssetBundle
{
	public $sourcePath = '@static/sw-letter';

	public $css = [
		'css/sw-letter.min.css',
	];

	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];

	public $depends = [
		'frontend\assets\SwMetaAsset',
	];
}

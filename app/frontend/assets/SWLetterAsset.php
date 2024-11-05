<?php
/**
 * SWLetterAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \common\assets\SWLetterAsset
 *
 * Load this asset with...
 * common\assets\SWLetterAsset::register($this);
 *
 * use common\assets\SWLetterAsset;
 * SWLetterAsset::register($this);
 *
 * or specify as a dependency with...
 *     'common\assets\SWLetterAsset',
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class SWLetterAsset extends AssetBundle
{
	public $sourcePath = '@static/language-page';

	public $css = [
		'css/language-page.min.css',
	];

	public $cssOptions = [
		'crossorigin' => 'anonymous',
	];
}

/*
/Users/pedro/Sites/yii_steppewest/app/static/language-page/
/Users/pedro/Sites/yii_steppewest/app/static/language-page/css/
/Users/pedro/Sites/yii_steppewest/app/static/language-page/css/steppe-west-letter.css
/Users/pedro/Sites/yii_steppewest/app/static/language-page/css/steppe-west-letter.min.css
/Users/pedro/Sites/yii_steppewest/app/static/language-page/img/
/Users/pedro/Sites/yii_steppewest/app/static/language-page/img/Golden-Eagle-1900x0750.jpg
*/

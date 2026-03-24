<?php
/**
 * SwDataTablesAsset.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * @class \backend\assets\SwDataTablesAsset
 *
 * Load this asset with...

backend\assets\SwDataTablesAsset::register($this);

 * or...

use backend\assets\SwDataTablesAsset;
SwDataTablesAsset::register($this);

 * or specify as a dependency with...

		'backend\assets\SwDataTablesAsset',

 */

namespace backend\assets;

use yii\web\AssetBundle;

class SwDataTablesAsset extends AssetBundle
{
	// @var string
	public $sourcePath = '@static/backend/datatables';

	// @var array
	public $js = [
		'js/datatables-init.js',
	];

	public $depends = [
		'p2m\assets\datatables\P2DataTablesBootstrap5Asset',
		'p2m\assets\datatables\P2DataTablesResponsiveAsset',
	];
}

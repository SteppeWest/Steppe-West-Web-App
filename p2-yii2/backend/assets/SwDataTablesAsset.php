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
use P2DataTablesBootstrap5Asset;
use P2DataTablesResponsiveAsset;

class SwDataTablesAsset extends AssetBundle
{
	// @var string
	public $sourcePath = '@static/backend/datatables';

	// @var array
	public $js = [
		'js/datatables-init.js',
	];

	public $depends = [
		P2DataTablesBootstrap5Asset::class,
		P2DataTablesResponsiveAsset::class,
	];
}

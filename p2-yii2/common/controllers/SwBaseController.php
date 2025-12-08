<?php
/**
 * SwBaseController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Base controller for Steppe West (frontend + backend).
 *
 * Ensures meta assets are always registered and metaAssetUrl
 * is available via $this->view->params['metaAssetUrl'].
 */

namespace common\controllers;

use yii\web\Controller;
use common\assets\SwMetaAsset;

class SwBaseController extends Controller
{
	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}

		// Register the meta asset once per request
		$metaAsset = SwMetaAsset::register($this->view);
		$this->view->params['metaAssetUrl'] = $metaAsset->baseUrl;

		return true;
	}
}

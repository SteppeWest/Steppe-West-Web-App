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

use Yii;
use yii\web\Controller;
use common\assets\SwCommonAsset;

class SwBaseController extends Controller
{
	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}

		// Register the meta asset once per request
		$metaAsset = SwCommonAsset::register($this->view);
		$this->view->params['metaAssetUrl'] = $metaAsset->baseUrl;

		$cookieLang = Yii::$app->request->cookies->getValue('userLanguage');
		if ($cookieLang) {
			Yii::$app->language = $cookieLang;
		}

		return true;
	}
}

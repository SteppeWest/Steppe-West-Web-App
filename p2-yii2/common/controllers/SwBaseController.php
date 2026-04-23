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

		$cookieLang = Yii::$app->request->cookies->getValue('userLanguage');
		if ($cookieLang) {
			Yii::$app->language = $cookieLang;
		}

		return true;
	}
}

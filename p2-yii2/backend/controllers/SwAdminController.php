<?php
/**
 * @backend/controllers/SwAdminController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace backend\controllers;

use Da\User\Controller\AdminController as BaseAdminController;
use Da\User\Search\UserSearch;
use Yii;

class SwAdminController extends BaseAdminController
{
	public function actionIndex()
	{
		/** @var UserSearch $searchModel */
		$searchModel = Yii::createObject(UserSearch::class);

		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		// Let DataTables paginate; Yii should not.
		$dataProvider->pagination = false;

		return $this->render('index', [
			'searchModel'   => $searchModel,
			'dataProvider'  => $dataProvider,
			'module'        => $this->module,
		]);
	}
}

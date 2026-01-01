<?php

namespace backend\controllers;

use Yii;
use common\controllers\SwBaseController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use common\models\LoginForm;
use backend\assets\SBAdminAsset;

/**
 * Site controller
 */
class SiteController extends SwBaseController
{
	/**
	 * {@inheritdoc}
	 */
	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}

		return true;
	}

	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'actions' => ['login', 'error', 'set-language'],
						'allow' => true,
					],
					[
						'actions' => ['logout', 'index', 'set-language'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::class,
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => \yii\web\ErrorAction::class,
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

	/**
	 * Login action.
	 *
	 * @return string|Response
	 */
	public function actionLogin()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		}

		$model->password = '';

		// Use the minimal auth layout
		$this->layout = 'auth';

		return $this->render('login', [
			'model' => $model,
		]);
	}

	/**
	 * Logout action.
	 *
	 * @return Response
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}

	/**
	 * Error action.
	 */
	public function actionError()
	{
		// Same minimal layout for error pages
		$this->layout = 'error';

		return $this->render('error', [
			'exception' => Yii::$app->errorHandler->exception,
		]);
	}

	public function actionSetLanguage($lang)
	{
		$allowed = ['en', 'ru', 'kk', 'ky', 'tg', 'uz'];

		if (in_array($lang, $allowed, true)) {
			Yii::$app->language = $lang;

			Yii::$app->response->cookies->add(new \yii\web\Cookie([
				'name' => 'userLanguage',
				'value' => $lang,
				'expire' => time() + 86400 * 365, // 1 year
				'httpOnly' => true,
				'sameSite' => \yii\web\Cookie::SAME_SITE_LAX,
			]));
		}

		return $this->goBack(Yii::$app->request->referrer ?: ['/site/index']);
	}









}

<?php
/**
 * frontend/controllers/SiteController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Use this class with...
 *
 * use frontend\controllers\SiteController;
 */

namespace frontend\controllers;

//use frontend\models\ResendVerificationEmailForm;
//use frontend\models\VerifyEmailForm;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
//use common\models\LoginForm;
//use frontend\models\PasswordResetRequestForm;
//use frontend\models\ResetPasswordForm;
//use frontend\models\SignupForm;
//use frontend\models\ContactForm;
use common\assets\SwMetaAsset;
use frontend\assets\SwErrorAsset;

use frontend\services\SwLanguageService;
use frontend\services\SwPageService;

/**
 * Site controller
 */
class SiteController extends Controller
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::class,
				'only' => ['login', 'logout', 'signup'],
				'rules' => [
					[
						'allow' => true,
						'actions' => ['login', 'signup'],
						'roles' => ['?'],
					],
					[
						'allow' => true,
						'actions' => ['logout'],
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
				'layout' => 'error',
			],
			'captcha' => [
				'class' => \yii\captcha\CaptchaAction::class,
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	/**
	 *
	 */
	public function beforeAction($action)
	{
		if ($action->id === 'error') {
			$this->layout = 'error';
			SwErrorAsset::register($this->view);
		}
		else {
			$this->layout = 'main';
		}
	}

	/**
	 * Displays homepage.
	 *
	 * @return mixed
	 */

	public function actionIndex()
	{
		return $this->render('index');
	}

	/**
	 * Displays homepage.
	 *
	 * @return mixed
	public function actionIndex()
	{
		return $this->render('index');
	}
	 */

	/**
	 * Displays about page.
	 *
	 * @return mixed
	 */
	public function actionAbout()
	{
		return $this->render('about');
	}

	protected function prepareErrorPage(): void
	{
		$this->layout = 'error';

		$metaAsset = SwMetaAsset::register($this->view);
		$bannerAsset = SwFlagsBannerAsset::register($this->view);
		SwErrorAsset::register($this->view);

		$this->view->params['metaAssetUrl'] = $metaAsset->baseUrl;
		$this->view->params['bannerAssetUrl'] = $bannerAsset->baseUrl;
	}

	public function actionError()
	{
		$this->prepareErrorPage();

		$exception = Yii::$app->errorHandler->exception;

		if ($exception === null) {
			$exception = new NotFoundHttpException('Page not found.');
		}

		return $this->render('error', [
			'exception' => $exception,
		]);
	}
}

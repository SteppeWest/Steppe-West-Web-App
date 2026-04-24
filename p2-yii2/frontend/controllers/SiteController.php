<?php
/**
 * frontend/controllers/SiteController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Use this class with...
 *
 * use frontend\controllers\SiteController;
 */

namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
//use common\models\LoginForm;
//use frontend\models\PasswordResetRequestForm;
//use frontend\models\ResetPasswordForm;
//use frontend\models\SignupForm;
//use frontend\models\ContactForm;
//use frontend\models\ResendVerificationEmailForm;
//use frontend\models\VerifyEmailForm;

use common\controllers\SwBaseController;

use frontend\services\SwLanguageService;
use frontend\services\SwPageService;

/**
 * Site controller
 */
class SiteController extends SwBaseController
{
	public $layout = 'main';

	/**
	 * {@inheritdoc}
	 */
	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}

		if ($action->id === 'error') {
			$this->layout = 'error';
		}
		else {
			$this->layout = 'main';
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
				'class' => ErrorAction::class,
				'layout' => 'error', // uses @frontend/views/layouts/error.php
			],
			'captcha' => [
				'class' => \yii\captcha\CaptchaAction::class,
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return mixed
	public function actionIndex(?string $slug = null, ?string $lc = null)
	{
		$languageService = new SwLanguageService();
		$pageService = new SwPageService();

		[$slug, $lc] = $this->normaliseSegments($slug, $lc);

		$legacyRedirect = $languageService->resolveLegacyRedirect($slug, $lc);
		if ($legacyRedirect !== null) {
			return $this->redirect($legacyRedirect, 301);
		}

		$routeContext = $pageService->resolveRouteContext($slug, $lc);
		if ($routeContext === null) {
			throw new NotFoundHttpException('Page not found.');
		}

		return $this->render('index', [
			'page' => $routeContext->page,
			'translation' => $routeContext->translation,
			'language' => $routeContext->language,
			'faqs' => $routeContext->faqs,
		]);
	}
	 */

	/**
	 * Displays homepage.
	 *
	 * @return mixed
	 */
	public function actionIndex()
	{
		$this->layout = 'main';
		return $this->render('index');
	}

	/**
	 * Displays contact page.
	 *
	 * @return mixed
	public function actionContact()
	{
		$model = new ContactForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
				Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
			} else {
				Yii::$app->session->setFlash('error', 'There was an error sending your message.');
			}

			return $this->refresh();
		}

		return $this->render('contact', [
			'model' => $model,
		]);
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
}

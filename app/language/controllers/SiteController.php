<?php
/**
 * SiteController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace language\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use language\models\ContactForm;

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
			'verbs' => [
		'class' => VerbFilter::class,
		'actions' => [
			'logout' => ['post'],
		],
			],
		];
	}

	public function beforeAction($action)
	{
		if (isset($_GET['language']) && in_array($_GET['language'], Yii::$app->params['swLanguages'])) {
			Yii::$app->language = $_GET['language'];
		}

		return parent::beforeAction($action);
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
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionError()
	{
		return $this->render('error');
	}

	/**
	 * Displays contact page.
	 *
	 * @return mixed
	 */
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

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
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
//use common\models\LoginForm;
//use frontend\models\PasswordResetRequestForm;
//use frontend\models\ResetPasswordForm;
//use frontend\models\SignupForm;
//use frontend\models\ContactForm;

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
		return $this->render('index');
	}

	/**
	 * Logs in a user.
	 *
	 * @return mixed
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

		return $this->render('login', [
			'model' => $model,
		]);
	}
	 */

	/**
	 * Logs out the current user.
	 *
	 * @return mixed
	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}
	 */

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

	/**
	 * Signs user up.
	 *
	 * @return mixed
	public function actionSignup()
	{
		$model = new SignupForm();
		if ($model->load(Yii::$app->request->post()) && $model->signup()) {
			Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
			return $this->goHome();
		}

		return $this->render('signup', [
			'model' => $model,
		]);
	}
	 */

	/**
	 * Requests password reset.
	 *
	 * @return mixed
	public function actionRequestPasswordReset()
	{
		$model = new PasswordResetRequestForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail()) {
				Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

				return $this->goHome();
			}

			Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
		}

		return $this->render('requestPasswordResetToken', [
			'model' => $model,
		]);
	}
	 */

	/**
	 * Resets password.
	 *
	 * @param string $token
	 * @return mixed
	 * @throws BadRequestHttpException
	public function actionResetPassword($token)
	{
		try {
			$model = new ResetPasswordForm($token);
		} catch (InvalidArgumentException $e) {
			throw new BadRequestHttpException($e->getMessage());
		}

		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
			Yii::$app->session->setFlash('success', 'New password saved.');

			return $this->goHome();
		}

		return $this->render('resetPassword', [
			'model' => $model,
		]);
	}
	 */

	/**
	 * Verify email address
	 *
	 * @param string $token
	 * @throws BadRequestHttpException
	 * @return yii\web\Response
	public function actionVerifyEmail($token)
	{
		try {
			$model = new VerifyEmailForm($token);
		} catch (InvalidArgumentException $e) {
			throw new BadRequestHttpException($e->getMessage());
		}
		if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
			Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
			return $this->goHome();
		}

		Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
		return $this->goHome();
	}
	 */

	/**
	 * Resend verification email
	 *
	 * @return mixed
	public function actionResendVerificationEmail()
	{
		$model = new ResendVerificationEmailForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail()) {
				Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
				return $this->goHome();
			}
			Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
		}

		return $this->render('resendVerificationEmail', [
			'model' => $model
		]);
	}
	 */
}
?>
<?php
/**
 * @backend/controllers/SiteController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ErrorAction;
use yii\web\Response;
use common\controllers\SwBaseController;
use common\models\LoginForm;
use backend\assets\SBAdminAsset;

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
			$this->layout = 'alternate';
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
				'class' => ErrorAction::class,
				'layout' => 'alternate', // uses @backend/views/layouts/error.php
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
		$this->layout = 'main';
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
		$this->layout = 'alternate';

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

			Yii::$app->session->set('userLanguage', $lang);

			Yii::$app->response->cookies->add(new \yii\web\Cookie([
				'name' => 'userLanguage',
				'value' => $lang,
				'expire' => time() + 86400 * 365, // 1 year
				'httpOnly' => true,
				'sameSite' => \yii\web\Cookie::SAME_SITE_LAX,
			]));
		}

		//return $this->goBack(Yii::$app->request->referrer ?: ['/site/index']);
		return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
	}
}

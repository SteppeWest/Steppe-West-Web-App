<?php
/**
 * LetterModule.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace frontend\modules;

use yii\helpers\Html;
use Symfony\Component\Yaml\Yaml;
use common\widgets\SwSubstitution;

/**
 * SwLetter module definition class
 */
class LetterModule extends \frontend\modules\LanguageModule
{
	/**
	 * {@inheritdoc}
	public $controllerNamespace = 'frontend\modules\controllers';
	 */

	/**
	 * {@inheritdoc}
	 */
	public function init()
	{
		parent::init();

		// custom initialization code goes here
	}
}

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

	/**
	 * Generates the origin attribution HTML if `origin` and `origin_link` are set.
	 *
	 * @param string|null $origin The name of the origin platform (e.g., "Substack")
	 * @param string|null $originLink The link to the original publication
	 * @return string|null The generated HTML string or null if no origin information
	 */
	public function generateOriginAttribution($origin, $originLink)
	{
		if ($origin && $originLink) {
			// Use regex to split the origin text into three parts: before, inside, and after {}
			if (preg_match('/^(.*?)\{(.*?)\}(.*)$/', $origin, $matches)) {
				$before = $matches[1];
				$platformName = $matches[2];
				$after = $matches[3];

				// Create the formatted link with icon for the platform name
				$formattedPlatform = Html::a(
					Html::tag('i', '', ['class' => 'bi bi-substack']) . ' ' . Html::encode($platformName),
					$originLink,
					[
						'class' => 'link-info link-opacity-75-hover text-decoration-none',
						'title' => Html::encode($platformName),
						'target' => '_blank'
					]
				);

				// Reassemble the sentence with the formatted platform link
				$attribution = $before . $formattedPlatform . $after;

				// Wrap in the required container divs
				return Html::tag('div',
					Html::tag('div', $attribution, ['class' => 'col-lg-8 text-center']),
					['class' => 'justify-content-center row']
				);
			}
		}
		return null;
	}
}

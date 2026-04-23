<?php
/**
 * frontend/models/SwFaqTranslation.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Use this class with...
 *
 * use frontend\models\SwFaqTranslation;
 */

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%faq_translation}}".
 *
 * @property int $id
 * @property int $faq_item_id
 * @property int $language_id
 * @property string $question
 * @property string $answer
 *
 * @property FaqItem $faqItem
 * @property Language $language
 */
class SwFaqTranslation extends \common\models\FaqTranslation
{
}

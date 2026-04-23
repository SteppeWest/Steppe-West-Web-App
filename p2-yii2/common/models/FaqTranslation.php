<?php

namespace common\models;

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
class FaqTranslation extends \common\models\generated\FaqTranslation
{
}

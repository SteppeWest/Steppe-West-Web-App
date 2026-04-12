<?php
/**
 * frontend/models/SwFaqItem.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Use this class with...
 *
 * use frontend\models\SwFaqItem;
 */

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%faq_item}}".
 *
 * @property int $id
 * @property int $page_id
 * @property string|null $code
 * @property int $is_active
 * @property int $sort_order
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property FaqTranslation[] $faqTranslations
 * @property Language[] $languages
 * @property Page $page
 */
class SwFaqItem extends \common\models\FaqItem
{
}

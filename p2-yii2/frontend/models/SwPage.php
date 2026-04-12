<?php
/**
 * frontend/models/SwPage.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Use this class with...
 *
 * use frontend\models\SwPage;
 */

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property int $id
 * @property string $code
 * @property string $view_key
 * @property int $is_active
 * @property int $is_home
 * @property int|null $sort_order
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property FaqItem[] $faqItems
 * @property Language[] $languages
 * @property PageRoute[] $pageRoutes
 * @property PageTranslation[] $pageTranslations
 */
class SwPage extends \common\models\Page
{
}

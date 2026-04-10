<?php

namespace common\models;

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
class Page extends \common\models\generated\Page
{
	public function getPrimaryRoute()
	{
		return $this->getPageRoutes()->andWhere(['is_primary' => 1]);
	}
}

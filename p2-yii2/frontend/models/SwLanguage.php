<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%language}}".
 *
 * @property int $id
 * @property string $code
 * @property string|null $legacy_code
 * @property int|null $menu_position
 * @property int $is_active
 * @property string $name_en
 * @property string $native_name
 * @property string|null $flag_icon
 * @property string $ui_label
 * @property string $locale
 * @property string $html_lang
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property ContactTranslation[] $contactTranslations
 * @property Contact[] $contacts
 * @property FaqItem[] $faqItems
 * @property FaqTranslation[] $faqTranslations
 * @property PageTranslation[] $pageTranslations
 * @property Page[] $pages
 */
class SwLanguage extends \common\models\Language
{
}

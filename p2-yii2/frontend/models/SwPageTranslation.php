<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%page_translation}}".
 *
 * @property int $id
 * @property int $page_id
 * @property int $language_id
 * @property string $title
 * @property string|null $subtitle
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string|null $origin_label
 * @property string|null $origin_url
 * @property string|null $body_content
 * @property string $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Language $language
 * @property Page $page
 */
class SwPageTranslation extends \common\models\PageTranslation
{
}

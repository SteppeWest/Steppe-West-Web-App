<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%contact}}".
 *
 * @property int $id
 * @property int|null $profile_user_id
 * @property string|null $country_code
 * @property string|null $email
 * @property string|null $whatsapp_number
 * @property int $is_staff
 * @property int $is_public
 * @property int $is_active
 * @property int $sort_order
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property ContactTranslation[] $contactTranslations
 * @property Language[] $languages
 */
class Contact extends \common\models\generated\Contact
{
}

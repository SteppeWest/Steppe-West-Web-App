<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%contact_translation}}".
 *
 * @property int $id
 * @property int $contact_id
 * @property int $language_id
 * @property string $first_name
 * @property string|null $family_name
 * @property string|null $display_name
 * @property string|null $role_title
 * @property string|null $country_label
 * @property string|null $bio_short
 *
 * @property Contact $contact
 * @property Language $language
 */
class ContactTranslation extends \common\models\generated\ContactTranslation
{
}

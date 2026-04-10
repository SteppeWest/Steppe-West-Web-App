<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%page_route}}".
 *
 * @property int $id
 * @property int $page_id
 * @property string $slug
 * @property int $is_primary
 * @property int $is_active
 *
 * @property Page $page
 */
class PageRoute extends \common\models\generated\PageRoute
{
}

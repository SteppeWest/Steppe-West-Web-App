<?php
/**
 * frontend/models/SwPageRoute.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Use this class with...
 *
 * use frontend\models\SwPageRoute;
 */

namespace frontend\models;

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
class SwPageRoute extends \common\models\PageRoute
{
}

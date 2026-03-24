<?php
/**
 * @backend/search/SwRuleSearch.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace backend\search;

use yii\base\Model;
use yii\data\ArrayDataProvider;
use common\search\RbacItemSearch;

final class SwRuleSearch extends Model
{
	public function search($params = []): ArrayDataProvider
	{
		// Whatever method name you used; adjust accordingly.
		return (new RbacItemSearch())->searchRules($params);
	}
}

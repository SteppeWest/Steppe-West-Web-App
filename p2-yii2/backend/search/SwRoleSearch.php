<?php

namespace backend\search;

use yii\base\Model;
use yii\data\ArrayDataProvider;
use common\search\RbacItemSearch;

final class SwRoleSearch extends Model
{
	public function search($params = []): ArrayDataProvider
	{
		// Whatever method name you used; adjust accordingly.
		return (new RbacItemSearch())->searchRoles($params);
	}
}

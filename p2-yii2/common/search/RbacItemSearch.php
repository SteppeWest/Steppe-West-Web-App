<?php

namespace common\search;

use Yii;
use yii\data\ArrayDataProvider;
use common\models\view\RbacItemView;

final class RbacItemSearch
{
	public function searchRoles(array $params = []): ArrayDataProvider
	{
		$items = [];

		foreach (Yii::$app->authManager->getRoles() as $role) {
			$items[] = new RbacItemView(
				name: $role->name,
				description: $role->description,
				rule_name: $role->ruleName,
				type: 'role',
			);
		}

		return new ArrayDataProvider([
			'allModels' => $items,
			'sort' => [
				'attributes' => ['name', 'description', 'rule_name'],
			],
			'pagination' => [
				'pageSize' => 20,
			],
		]);
	}

	// These will be near-identical later:
	public function searchPermissions(array $params = []): ArrayDataProvider
	{
		$items = [];

		foreach (Yii::$app->authManager->getPermissions() as $perm) {
			$items[] = new RbacItemView(
				name: $perm->name,
				description: $perm->description,
				rule_name: $perm->ruleName,
				type: 'permission',
			);
		}

		return new ArrayDataProvider([
			'allModels' => $items,
			'sort' => [
				'attributes' => ['name', 'description', 'rule_name'],
			],
		]);
	}

	public function searchRules(array $params = []): ArrayDataProvider
	{
		$items = [];

		foreach (Yii::$app->authManager->getRules() as $rule) {
			$items[] = new RbacItemView(
				name: $rule->name,
				description: null,
				rule_name: null,
				type: 'rule',
			);
		}

		return new ArrayDataProvider([
			'allModels' => $items,
			'sort' => [
				'attributes' => ['name'],
			],
		]);
	}
}

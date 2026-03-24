<?php
/**
 * @common/models/view/RbacItemView.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\models\view;

final class RbacItemView
{
	public function __construct(
		public string $name,
		public ?string $description,
		public ?string $rule_name,
		public string $type, // 'role' | 'permission' | 'rule'
	) {}
}

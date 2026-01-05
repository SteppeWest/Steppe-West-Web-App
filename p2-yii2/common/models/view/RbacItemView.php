<?php
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

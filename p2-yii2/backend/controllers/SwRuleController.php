<?php
/**
 * @backend/controllers/SwRuleController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace backend\controllers;

use Da\User\Controller\RuleController as UsuarioRuleController;
use backend\search\SwRuleSearch;

final class SwRuleController extends UsuarioRuleController
{
	protected function getSearchModelClass()
	{
		return SwRuleSearch::class;
	}
}

<?php
/**
 * @backend/controllers/SwRoleController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace backend\controllers;

use Da\User\Controller\RoleController as UsuarioRoleController;
use backend\search\SwRoleSearch;

final class SwRoleController extends UsuarioRoleController
{
	protected function getSearchModelClass()
	{
		return SwRoleSearch::class;
	}
}

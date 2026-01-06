<?php
/**
 * @backend/controllers/SwPermissionController.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace backend\controllers;

use Da\User\Controller\PermissionController as UsuarioPermissionController;
use backend\search\SwPermissionSearch;

final class SwPermissionController extends UsuarioPermissionController
{
	protected function getSearchModelClass()
	{
		return SwPermissionSearch::class;
	}
}

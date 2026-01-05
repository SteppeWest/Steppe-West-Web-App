<?php

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

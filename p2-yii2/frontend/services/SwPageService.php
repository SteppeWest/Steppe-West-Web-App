<?php
/**
 * frontend/services/SwPageService.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Use this class with...
 *
 * use frontend\services\SwPageService;
 */

namespace frontend\services;

use Yii;
use frontend\models\SwPage;
use frontend\models\SwPageTranslation;

class SwPageService
{
	function findHomePage(): ?SwPage
	{
		return;
	}

	function findActivePageBySlug(string $slug): ?SwPage
	{
		return;
	}

	function findPageTranslation(int $pageId, int $languageId): ?SwPageTranslation
	{
		return;
	}

	function findFaqsForPage(int $pageId, int $languageId): array
	{
		return;
	}
}

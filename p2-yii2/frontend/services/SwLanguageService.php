<?php
/**
 * frontend/services/SwLanguageService.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Use this class with...
 *
 * use frontend\services\SwLanguageService;
 */

namespace frontend\services;

use Yii;
use frontend\models\SwLanguage;

class SwLanguageService
{
	function resolveRequestedLanguage(?string $segment): array
	{
		return;
	}

	function isLegacyCode(string $segment): bool
	{
		return;
	}

	function mapLegacyCode(string $legacyCode): ?string
	{
		return;
	}

	function getDefaultLanguageCode(): string
	{
		return;
	}

	function findActiveLanguageByCode(string $code): ?SwLanguage
	{
		return;
	}
}

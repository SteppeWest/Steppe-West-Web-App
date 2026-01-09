<?php
/**
 * @common/helpers/SwUserGravatarHelper.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\helpers;

use yii\helpers\Html;
use Yii;

final class SwUserGravatarHelper
{
	public static function gravatarUrl(string $email, int $size = 200, string $default = 'mp'): string
	{
		$hash = md5(strtolower(trim($email)));
		return "https://www.gravatar.com/avatar/{$hash}?s={$size}&d={$default}";
	}

	public static function userEmail($user): ?string
	{
		return $user->profile->gravatar_email
			?? $user->email
			?? null;
	}

	public static function img($user, array $options = [], int $size = 200 ): string
	{
		$email = self::userEmail($user);

		if ($email === null) {
			return '';
		}

		$defaults = [
			'class' => 'img-fluid rounded-circle',
			'alt' => Yii::t('sw.a11y',
				'Profile photo of {username}',
				['username' => $user->username]
			),
		];

		return Html::img(
			self::gravatarUrl($email, $size),
			array_merge($defaults, $options)
		);
	}

	public static function imgByEmail(string $email, array $options = [], int $size = 64): string
	{
		$defaults = [
			'alt' => Yii::t('sw.a11y', 'User avatar'),
		];
		return \yii\helpers\Html::img(self::gravatarUrl($email, $size), array_merge($defaults, $options));
	}
}

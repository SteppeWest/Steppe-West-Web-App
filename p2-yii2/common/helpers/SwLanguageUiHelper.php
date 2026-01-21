<?php
namespace common\helpers;

use Yii;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use p2m\helpers\FI;
use p2m\helpers\BI;

final class SwLanguageUiHelper
{

	private static array $languages = [
		'en' => [
			'label' => 'English',
			'flag'  => 'gb',
		],
		'ru' => [
			'label' => 'Русский',
			'flag'  => 'ru',
		],
		'kk' => [
			'label' => 'Қазақша',
			'flag'  => 'kz',
		],
		'ky' => [
			'label' => 'Кыргызча',
			'flag'  => 'kg',
		],
		'tg' => [
			'label' => 'Тоҷикӣ',
			'flag'  => 'tj',
		],
		'tk' => [
			'label' => 'Türkmençe',
			'flag'  => 'tm',
		],
		'uz' => [
			'label' => 'Oʻzbekcha',
			'flag'  => 'uz',
		],
		'az' => [
			'label' => 'Azərbaycanca',
			'flag'  => 'az',
		],
		'mn' => [
			'label' => 'Монгол',
			'flag'  => 'mn',
		],
		'tr' => [
			'label' => 'Türkçe',
			'flag'  => 'tr',
		],
	];

	private static function resolveLanguages(?array $codes = null): array
	{
		$codes ??= Yii::$app->params['swUiLanguages'] ?? [];

		$out = [];
		foreach ($codes as $code) {
			if (isset(self::$languages[$code])) {
				$out[$code] = self::$languages[$code];
			}
		}

		return $out;
	}

	/**
	 * Full-width flag button group (eg. login page)
	 */
	public static function buttonGroup(array $options = []): string
	{
		$languages = self::resolveLanguages($options['languages'] ?? null);
		$currentLang = $options['currentLang'] ?? Yii::$app->language;

		if (!$languages) {
			return '';
		}

		$groupClass = $options['groupClass'] ?? 'btn-group w-100 mb-3';
		$ariaLabel  = $options['ariaLabel']  ?? Yii::t('sw.a11y', 'Select language');

		$links = [];
		foreach ($languages as $code => $meta) {
			$isActive = ($code === $currentLang);
			$label    = (string)($meta['label'] ?? $code);
			$flag     = (string)($meta['flag'] ?? '');

			$links[] = Html::a(
				FI::i($flag) . '<span class="visually-hidden">' . Html::encode($label) . '</span>',
				$options['url'] ?? ['/site/set-language', 'lang' => $code],
				[
					'class' => ($options['btnBaseClass'] ?? 'btn') . ' ' .
						($isActive ? ($options['btnActiveClass'] ?? 'btn-primary') : ($options['btnInactiveClass'] ?? 'btn-outline-secondary')) .
						' ' . ($options['btnPaddingClass'] ?? 'px-3 py-2 py-md-1'),
					'encode' => false,
					'aria-label' => $label,
					'title' => $label,
					'data-sw-lang' => '1',
				]
			);
		}

		return Html::tag('div', implode("\n", $links), [
			'class' => $groupClass,
			'role' => 'group',
			'aria-label' => $ariaLabel,
		]);
	}

	/**
	 * Dropdown item that toggles a collapse list (eg. user menu)
	 * Returns <li>...</li> so you can drop it straight into your dropdown <ul>.
	 */
	public static function dropdownCollapse(array $options = []): string
	{
		$languages = self::resolveLanguages($options['languages'] ?? null);
		$currentLang = $options['currentLang'] ?? Yii::$app->language;

		if (!$languages) {
			return '';
		}

		$id        = $options['id']        ?? 'langMenu';
		$ariaLabel = $options['ariaLabel'] ?? Yii::t('sw.a11y', 'Select language');

		$toggle = Html::a(
			BI::i('translate') . ' ' . Yii::t('sw', 'Language'),
			"#{$id}",
			[
				'class' => 'dropdown-item',
				'encode' => false,
				'data-bs-toggle' => 'collapse',
				'role' => 'button',
				'aria-label' => $ariaLabel,
				'aria-expanded' => 'false',
				'aria-controls' => $id,
			]
		);

		$items = [];
		foreach ($languages as $code => $meta) {
			$label = (string)($meta['label'] ?? $code);
			$flag  = (string)($meta['flag'] ?? '');

			$items[] = Html::a(
				'<span>' . FI::i($flag) . ' ' . Html::encode($label) . '</span>' .
				($code === $currentLang ? BI::i('check') : ''),
				$options['url'] ?? ['/site/set-language', 'lang' => $code],
				[
					'class' => 'dropdown-item ps-4 d-flex justify-content-between align-items-center',
					'encode' => false,
					'aria-label' => $label,
					'title' => $label,
					'data-sw-lang' => '1',
				]
			);
		}

		$list = Html::tag('ul', implode("\n", $items), ['class' => 'list-unstyled mb-0']);
		$collapse = Html::tag('div', $list, ['class' => 'collapse', 'id' => $id]);

		return Html::tag('li', $toggle . $collapse);
	}
}

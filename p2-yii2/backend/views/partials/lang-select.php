<?php
/**
 * @backend/views/partials/lang-select.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Renders a language selector as a full-width Bootstrap button group.
 *
 * Usage:

	<?= $this->render('/partials/lang-button-group', [
		'size' => null, // or 'sm' | 'lg'
		'fullWidth' => true,
		'activeClass' => 'btn-primary',
		'inactiveClass' => 'btn-outline-secondary',
		'containerClass' => 'mb-3',
	]) ?>

 */

use yii\helpers\Html;
use p2m\helpers\FI;

/** @var yii\web\View $this */

$languages   = Yii::$app->params['swUiLanguages'] ?? [];
$currentLang = Yii::$app->language;

// Options (with sensible defaults)
$size          = $size ?? null; // 'sm' | 'lg' | null
$fullWidth     = $fullWidth ?? true;
$activeClass   = $activeClass ?? 'btn-primary';
$inactiveClass = $inactiveClass ?? 'btn-outline-secondary';
$containerClass = $containerClass ?? '';
$ariaLabel     = $ariaLabel ?? Yii::t('sw.a11y', 'Select language');

if (!$languages) {
	return;
}

$groupClasses = ['btn-group'];
if ($fullWidth) {
	$groupClasses[] = 'w-100';
}
if ($size === 'sm') {
	$groupClasses[] = 'btn-group-sm';
} elseif ($size === 'lg') {
	$groupClasses[] = 'btn-group-lg';
}

if ($containerClass) {
	$groupClasses[] = $containerClass;
}
?>
<div class="<?= implode(' ', $groupClasses) ?>" role="group" aria-label="<?= Html::encode($ariaLabel) ?>">
	<?php foreach ($languages as $code => $meta): ?>
		<?php
			$isActive = ($code === $currentLang);
			$label    = $meta['label'] ?? $code;          // native language name
			$flag     = $meta['flag'] ?? null;            // flag-icons key
			$btnClass = $isActive ? $activeClass : $inactiveClass;
		?>

		<?= Html::a(
			($flag ? FI::i($flag) : '') .
			' <span class="visually-hidden">' . Html::encode($label) . '</span>',
			['/site/set-language', 'lang' => $code],
			[
				'class' => 'btn ' . $btnClass . ' px-3 py-2 py-md-1',
				'encode' => false,
				'aria-label' => $label,
				'title' => $label,
				'data-sw-lang' => '1',
			]
		) ?>
	<?php endforeach; ?>
</div>

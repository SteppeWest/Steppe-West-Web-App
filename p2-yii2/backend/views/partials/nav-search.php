<?php
/**
 * @backend/views/partials/nav-top.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

use yii\bootstrap5\Html;
use yii\helpers\Url;
use p2m\helpers\BI;
use p2m\helpers\FI;

/* @var $this yii\web\View */

$metaAssetUrl      = $this->params['metaAssetUrl'];
$languages         = Yii::$app->params['swUiLanguages'];
$currentLang       = Yii::$app->language;
$searchPlaceholder = Yii::t('admin', 'Search') . '...';
$searchAriaLabel   = Yii::t('admin', 'Search');
?>
		<!-- Navbar Search (placeholder for future search widget) -->
		<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"
			action="#" role="search">
			<div class="input-group">
				<input class="form-control"
					type="search"
					placeholder="<?= $searchPlaceholder ?>"
					aria-label="<?= $searchAriaLabel ?>"
					aria-describedby="btnNavbarSearch"
					disabled>
				<button class="btn btn-primary" id="btnNavbarSearch" type="button" disabled>
					<?= BI::i('search') ?>
				</button>
			</div>
		</form>

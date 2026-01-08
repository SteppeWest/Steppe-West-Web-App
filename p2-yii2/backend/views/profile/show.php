<?php
/**
 * @backend/views/profile/show.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2025 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 *
 * Adapted from 2amigos/yii2-usuario
 */

use yii\helpers\Html;
use p2m\helpers\BI;

/**
 * @var \yii\web\View          $this
 * @var \Da\User\Model\Profile $profile
 */

$this->title = Yii::t('admin.settings', 'User Profile');
$this->params['breadcrumbs'][] = $this->title;
$userTitle = empty($profile->name) ? Html::encode($profile->user->username) : Html::encode($profile->name);
$email = $profile->public_email;
?>

<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="mt-4"><?= $this->title ?></h1>
</div>

<?= $this->render('/partials/breadcrumbs') ?>

<div class="card">
	<div class="card-header">
		<?= $this->render('/partials/user-menu') ?>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-3">
				<?= $this->render('/partials/user-gravatar') ?>
			</div>
			<div class="col-md-9" id="sw-user-profile">
				<h4><?= $userTitle ?></h4>
				<section aria-label="<?= Yii::t('admin.a11y', 'User Details') ?>">
					<dl class="sw-profile-dl">
						<div class="sw-profile-row">
							<?= BI::i('geo-alt-fill') ?>
							<dt><?= Yii::t('admin.profile', 'Location') ?></dt>
							<dd>
								<?php if ($profile->location): ?>
									<?= Html::encode($profile->location) ?>
								<?php endif; ?>
							</dd>
						</div>

						<div class="sw-profile-row">
							<?= BI::i('globe') ?>
							<dt><?= Yii::t('admin.profile', 'Website') ?></dt>
							<dd>
								<?php if ($profile->website): ?>
									<?= Html::a(
										Html::encode($profile->website),
										$profile->website,
										['target' => '_blank', 'rel' => 'noopener noreferrer']
									) ?>
								<?php endif; ?>
							</dd>
						</div>

						<div class="sw-profile-row">
							<?= BI::i('envelope') ?>
							<dt><?= Yii::t('admin.profile', 'Public Email') ?></dt>
							<dd>
								<?php if ($profile->public_email): ?>
									<?= Html::a(
										Html::encode($profile->public_email),
										"mailto:" . $profile->public_email
									) ?>
								<?php endif; ?>
							</dd>
						</div>
						<div class="sw-profile-row">
							<?= BI::i('stopwatch') ?>
							<dt><?= Yii::t('admin.profile', 'Joined') ?></dt>
							<dd><?= Yii::$app->formatter->asDate($profile->user->created_at) ?></dd>
						</div>
					</dl>
				</section>

				<section aria-labelledby="profile-bio-heading">
					<h5 id="profile-bio-heading"><?= Yii::t('admin.profile', 'Bio') ?></h5>
					<?php if (!empty($profile->bio)): ?>
						<?php foreach (preg_split("/\R{2,}/", trim($profile->bio)) as $para): ?>
							<p class="mb-2"><?= nl2br(Html::encode($para)) ?></p>
						<?php endforeach; ?>
					<?php endif; ?>
				</section>
			</div>
		</div>
	</div>
</div>

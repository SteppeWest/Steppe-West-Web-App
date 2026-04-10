<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PageTranslation]].
 *
 * @see PageTranslation
 */
class PageTranslationQuery extends \common\models\generated\PageTranslationQuery
{
	public function published(): static
	{
		return $this->andWhere(['status' => 'published']);
	}

	public function forLanguage(int $languageId): static
	{
		return $this->andWhere(['language_id' => $languageId]);
	}
}

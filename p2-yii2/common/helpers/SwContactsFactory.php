<?php
/**
 * SwContactsFactory.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Load this factory with...
 * use common\helpers\SwContactsFactory;
 */

namespace common\helpers;

use Yii;
use common\components\SwContactObject;

abstract class SwContactsFactory extends SwFactory
{
	// app wide contacts factory logic

	protected static function fromModels(
		\common\models\Contact $contact,
		\common\models\ContactTranslation $translation
	): SwContactObject
	{
		return new SwContactObject(
			firstName:    $translation->first_name,
			familyName:   $translation->family_name,
			displayName:  $translation->display_name,
			roleTitle:    $translation->role_title,
			countryLabel: $translation->country_label,
			email:        $contact->email,
			phone:        $contact->phone,
			telegram:     $contact->telegram,
			hasWhatsapp:  (bool) $contact->has_whatsapp,
			hasSignal:    (bool) $contact->has_signal,
			hasViber:     (bool) $contact->has_viber,
			bioShort:     $translation->bio_short
		);
	}

	protected static function activeContacts(int $languageId): array
	{
		return Contact::find()
			->alias('c')
			->joinWith(['contactTranslations t'])
			->where([
				'c.is_active' => 1,
				't.language_id' => $languageId,
			])
			->orderBy(['c.sort_order' => SORT_ASC])
			->all();
	}

	public static function all(int $languageId): array
	{
		$models = static::activeContacts($languageId);
		$objects = [];

		foreach ($models as $contact) {
			$translation = $contact->contactTranslations[0] ?? null;

			if ($translation === null) {
				continue;
			}

			$objects[] = static::fromModels($contact, $translation);
		}

		return $objects;
	}

	public static function oneByEmail(string $email, int $languageId): ?SwContactObject
	{
		$contact = Contact::find()
			->where(['email' => $email, 'is_active' => 1])
			->one();

		if (!$contact) {
			return null;
		}

		$translation = ContactTranslation::find()
			->where([
				'contact_id' => $contact->id,
				'language_id' => $languageId,
			])
			->one();

		if (!$translation) {
			return null;
		}

		return static::fromModels($contact, $translation);
	}
}

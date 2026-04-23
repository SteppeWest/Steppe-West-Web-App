<?php
/**
 * SwContactObject.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2026 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\components;

class SwContactObject
{
	protected string  $firstName    = '';
	protected string  $familyName   = '';
	protected ?string $displayName  = null;
	protected ?string $roleTitle    = null;
	protected ?string $countryLabel = null;
	protected ?string $email        = null;
	protected ?string $phone        = null;
	protected ?string $telegram     = null;
	protected bool    $whatsApp     = false;
	protected bool    $signal       = false;
	protected bool    $viber        = false;
	protected ?string $bio          = null;

	public function __construct(
		string $firstName,
		string $familyName,
		?string $displayName = null,
		?string $roleTitle = null,
		?string $countryLabel = null,
		?string $email = null,
		?string $phone = null,
		?string $telegram = null,
		bool $hasWhatsapp = false,
		bool $hasSignal = false,
		bool $hasViber = false,
		?string $bioShort = null
	) {
		$this->firstName    = $firstName;
		$this->familyName   = $familyName;
		$this->displayName  = $displayName;
		$this->roleTitle    = $roleTitle;
		$this->countryLabel = $countryLabel;
		$this->email        = $email;
		$this->phone        = $phone;
		$this->telegram     = $telegram;
		$this->hasWhatsapp  = $hasWhatsapp;
		$this->hasSignal    = $hasSignal;
		$this->hasViber     = $hasViber;
		$this->bioShort     = $bioShort;
	}

	public function name(): string
	{
		return $this->displayName
			?? trim($this->firstName . ' ' . $this->familyName);
	}

	public function emailLink(): ?string
	{
		return $this->email
			? Html::a($this->email, 'mailto:' . $this->email)
			: null;
	}

	public function whatsappLink(): ?string
	{
		if (!$this->hasWhatsapp || !$this->phone) {
			return null;
		}

		$number = preg_replace('/\D+/', '', $this->phone);

		return "https://wa.me/{$number}";
	}



}

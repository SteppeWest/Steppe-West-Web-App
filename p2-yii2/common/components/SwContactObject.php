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
	public string  $firstName     = '';
	public string  $lastName      = '';
	public ?string $preferredName = null;
	public ?string $email         = null;
	public ?string $phone         = null;
	public bool    $whatsApp      = false;
	public bool    $telegram      = false;
	public bool    $signal        = false;
	public bool    $viber         = false;

}

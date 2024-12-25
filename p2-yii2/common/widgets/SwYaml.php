<?php
/**
 * SwYaml.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Provides substitution functionality for use across the application.
 *
 * @class \common\widgets\SwYaml
 * @package common\widgets
 *
 * use common\widgets\SwYaml;
 */

namespace common\widgets;

use Symfony\Component\Yaml\Yaml;
use common\widgets\SwSubstitution;

class SwYaml {
	public static function parseYamlItem(string $yamlContent): array
	{
		$rawContent = self::readYaml($yamlContent);

		\Yii::debug($rawContent, __METHOD__);

		// Ensure the parsed content is an array
		/*
		if (!is_array($rawContent)) {
			return [];
		}
		*/

		$parsedContent = [];

		// Process each top-level entry
		foreach ($rawContent as $section) {
			$processedSection = [];

			// Process each entry within the "item"
			foreach ($section as $entry) {
				if (is_array($entry)) {
					// Handle string-keyed content (assumes one item only)
					foreach ($entry as $key => $value) {
						if (is_string($key)) {
							$processedSection[$key] = $value;
						}
					}
				} else {
					// Handle "text" content
					$processedSection[] = SwSubstitution::applySubstitutions($entry);
				}
			}

			$parsedContent[] = $processedSection;
		}

		return $parsedContent;
	}

	public static function parseFooterYaml(string $yamlContent): array
	{
		$rawContent = self::readYaml($yamlContent); // Centralised YAML parsing

		return array_map(function ($value) {
			return is_string($value) ? SwSubstitution::applySubstitutions($value) : $value;
		}, $rawContent);
	}

	protected static function readYaml(string $yamlContent): array
	{
		try {
			return Yaml::parse($yamlContent) ?? []; // Parse and ensure array
		}
		catch (\Exception $e) {
			// Handle invalid YAML
			// Log the error if necessary
			return [];
		}
	}
}

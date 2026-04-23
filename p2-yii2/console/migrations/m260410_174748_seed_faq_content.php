<?php

use yii\db\Migration;
use yii\db\Query;

class m260410_174748_seed_faq_content extends Migration
{
	public function safeUp()
	{
		$faqItems = require __DIR__ . '/../data/seed-faqs.php';

		$requiredPages = ['intro', 'invite'];
		$requiredLanguages = ['en', 'ru', 'kk', 'ky', 'tg', 'tk', 'uz', 'az', 'mn', 'tr'];

		foreach ($requiredPages as $pageCode) {
			if (!isset($faqItems[$pageCode]) || !is_array($faqItems[$pageCode])) {
				throw new \RuntimeException("Missing FAQ page data for '{$pageCode}'.");
			}

			$itemNumbers = array_keys($faqItems[$pageCode]);
			sort($itemNumbers, SORT_NUMERIC);

			if (empty($itemNumbers)) {
				throw new \RuntimeException("No FAQ items found for page '{$pageCode}'.");
			}

			foreach ($itemNumbers as $itemNumber) {
				if (!isset($faqItems[$pageCode][$itemNumber]) || !is_array($faqItems[$pageCode][$itemNumber])) {
					throw new \RuntimeException("Missing FAQ item data for page '{$pageCode}' item '{$itemNumber}'.");
				}

				foreach ($requiredLanguages as $languageCode) {
					if (
						!isset($faqItems[$pageCode][$itemNumber][$languageCode]) ||
						!is_array($faqItems[$pageCode][$itemNumber][$languageCode])
					) {
						throw new \RuntimeException(
							"Missing FAQ language data for page '{$pageCode}' item '{$itemNumber}' language '{$languageCode}'."
						);
					}
				}
			}
		}

		$languageIds = (new Query())
			->select(['id', 'code'])
			->from('{{%language}}')
			->indexBy('code')
			->column();

		foreach ($requiredLanguages as $languageCode) {
			if (!isset($languageIds[$languageCode])) {
				throw new \RuntimeException("Language code '{$languageCode}' not found in {{%language}}.");
			}
		}

		$pageIds = (new Query())
			->select(['id', 'code'])
			->from('{{%page}}')
			->where(['code' => $requiredPages])
			->indexBy('code')
			->column();

		foreach ($requiredPages as $pageCode) {
			if (!isset($pageIds[$pageCode])) {
				throw new \RuntimeException("Page code '{$pageCode}' not found in {{%page}}.");
			}
		}

		$now = time();

		$faqItemRows = [];

		foreach ($requiredPages as $pageCode) {
			$itemNumbers = array_keys($faqItems[$pageCode]);
			sort($itemNumbers, SORT_NUMERIC);

			foreach ($itemNumbers as $itemNumber) {
				$faqCode = sprintf('%s_%02d', $pageCode, $itemNumber);

				$faqItemRows[] = [
					$pageIds[$pageCode],
					$faqCode,
					1,
					(int) $itemNumber,
					$now,
					$now,
				];
			}
		}

		$this->batchInsert('{{%faq_item}}', [
			'page_id',
			'code',
			'is_active',
			'sort_order',
			'created_at',
			'updated_at',
		], $faqItemRows);

		$faqIds = (new Query())
			->select(['id', 'code'])
			->from('{{%faq_item}}')
			->where(['code' => array_column($faqItemRows, 1)])
			->indexBy('code')
			->column();

		$faqTranslationRows = [];

		foreach ($requiredPages as $pageCode) {
			$itemNumbers = array_keys($faqItems[$pageCode]);
			sort($itemNumbers, SORT_NUMERIC);

			foreach ($itemNumbers as $itemNumber) {
				$faqCode = sprintf('%s_%02d', $pageCode, $itemNumber);

				if (!isset($faqIds[$faqCode])) {
					throw new \RuntimeException("FAQ code '{$faqCode}' not found in {{%faq_item}}.");
				}

				foreach ($requiredLanguages as $languageCode) {
					$item = $faqItems[$pageCode][$itemNumber][$languageCode];

					if (!isset($item['question'], $item['answer'])) {
						throw new \RuntimeException(
							"Missing question or answer for FAQ '{$faqCode}' language '{$languageCode}'."
						);
					}

					$faqTranslationRows[] = [
						$faqIds[$faqCode],
						$languageIds[$languageCode],
						$item['question'],
						$item['answer'],
					];
				}
			}
		}

		$this->batchInsert('{{%faq_translation}}', [
			'faq_item_id',
			'language_id',
			'question',
			'answer',
		], $faqTranslationRows);
	}

	public function safeDown()
	{
		$faqCodes = [];

		for ($i = 1; $i <= 12; $i++) {
			$faqCodes[] = sprintf('intro_%02d', $i);
		}

		for ($i = 1; $i <= 21; $i++) {
			$faqCodes[] = sprintf('invite_%02d', $i);
		}

		$faqIds = (new Query())
			->select('id')
			->from('{{%faq_item}}')
			->where(['code' => $faqCodes])
			->column();

		if (!empty($faqIds)) {
			$this->delete('{{%faq_translation}}', ['faq_item_id' => $faqIds]);
		}

		$this->delete('{{%faq_item}}', ['code' => $faqCodes]);
	}
}

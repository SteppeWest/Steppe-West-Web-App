<?php

use yii\db\Migration;

class m260426_165655_update_intro_titles extends Migration
{
	public function safeUp(): void
	{
		$rows = [
			1 => [
				'title' => 'Steppe West: Stories from Central Asia, Shared with the World',
				'subtitle' => 'Exploring life, culture, and stories from Central Asia — together',
			],
			2 => [
				'title' => 'Steppe West: Истории из Центральной Азии, рассказанные миру',
				'subtitle' => 'Открывая жизнь, культуру и истории Центральной Азии — вместе',
			],
			3 => [
				'title' => 'Steppe West: Орталық Азиядан шыққан оқиғалар, әлеммен бөлісілген',
				'subtitle' => 'Орталық Азияның өмірін, мәдениетін және оқиғаларын бірге зерттеу',
			],
			4 => [
				'title' => 'Steppe West: Борбор Азиядан чыккан окуялар, дүйнө менен бөлүшүлгөн',
				'subtitle' => 'Борбор Азиянын жашоосун, маданиятын жана окуяларын бирге изилдөө',
			],
			5 => [
				'title' => 'Steppe West: Ҳикояҳо аз Осиёи Марказӣ, ки ба ҷаҳон пешниҳод мешаванд',
				'subtitle' => 'Кашфи зиндагӣ, фарҳанг ва ҳикояҳои Осиёи Марказӣ — якҷо',
			],
			6 => [
				'title' => 'Steppe West: Merkezi Aziýadan hekaýalar, dünýä bilen paýlaşylýar',
				'subtitle' => 'Merkezi Aziýanyň durmuşy, medeniýeti we hekaýalaryny bilelikde öwrenmek',
			],
			7 => [
				'title' => 'Steppe West: Markaziy Osiyodan hikoyalar, dunyo bilan bo‘lishiladi',
				'subtitle' => 'Markaziy Osiyoning hayoti, madaniyati va hikoyalarini birga o‘rganish',
			],
			8 => [
				'title' => 'Steppe West: Mərkəzi Asiyadan hekayələr, dünya ilə paylaşılır',
				'subtitle' => 'Mərkəzi Asiyanın həyatını, mədəniyyətini və hekayələrini birlikdə kəşf edirik',
			],
			9 => [
				'title' => 'Steppe West: Төв Азиас түүхүүд, дэлхийтэй хуваалцагдсан',
				'subtitle' => 'Төв Азийн амьдрал, соёл, түүхийг хамтдаа нээцгээе',
			],
			10 => [
				'title' => 'Steppe West: Orta Asya’dan hikâyeler, dünyayla paylaşılıyor',
				'subtitle' => 'Orta Asya’nın yaşamını, kültürünü ve hikâyelerini birlikte keşfediyoruz',
			],
		];

		foreach ($rows as $id => $data) {
			$this->update('{{%page_translation}}', $data, ['id' => $id]);
		}
	}

	public function safeDown(): bool
	{
		echo "m260426_165655_update_intro_titles cannot be reverted.\n";

		return false;
	}
}

<?php

use yii\db\Migration;
use yii\db\Query;

class m260410_174735_seed_page_content extends Migration
{
	public function safeUp()
	{
		$pageBodies = require __DIR__ . '/../data/seed-page-bodies.php';

		if (
			!isset($pageBodies['intro'], $pageBodies['invite']) ||
			!is_array($pageBodies['intro']) ||
			!is_array($pageBodies['invite'])
		) {
			throw new \RuntimeException('seed-page-bodies.php is missing intro or invite page data.');
		}

		$requiredCodes = ['en', 'ru', 'kk', 'ky', 'tg', 'tk', 'uz', 'az', 'mn', 'tr'];

		foreach (['intro', 'invite'] as $pageCode) {
			foreach ($requiredCodes as $languageCode) {
				if (!isset($pageBodies[$pageCode][$languageCode])) {
					throw new \RuntimeException("Missing body content for page '{$pageCode}' language '{$languageCode}'.");
				}
			}
		}

		$languageIds = (new Query())
			->select(['id', 'code'])
			->from('{{%language}}')
			->indexBy('code')
			->column();

		foreach ($requiredCodes as $code) {
			if (!isset($languageIds[$code])) {
				throw new \RuntimeException("Language code '{$code}' not found in sw_language.");
			}
		}

		$now = time();

		$this->batchInsert('{{%page}}', [
			'code',
			'view_key',
			'is_active',
			'is_home',
			'sort_order',
			'created_at',
			'updated_at',
			'created_by',
			'updated_by',
		], [
			['intro',     'static-page', 1, 1, 10, $now, $now, null, null],
			['invite',    'static-page', 1, 0, 20, $now, $now, null, null],
			['travel',    'static-page', 0, 0, 30, $now, $now, null, null],
			['education', 'static-page', 0, 0, 40, $now, $now, null, null],
			['calendar',  'static-page', 0, 0, 50, $now, $now, null, null],
			['contact',   'static-page', 0, 0, 60, $now, $now, null, null],
		]);

		$pageIds = (new Query())
			->select(['id', 'code'])
			->from('{{%page}}')
			->indexBy('code')
			->column();

		$this->batchInsert('{{%page_route}}', [
			'page_id',
			'slug',
			'is_primary',
			'is_active',
		], [
			[$pageIds['intro'],     'intro',     1, 1],
			[$pageIds['invite'],    'invite',    1, 1],
			[$pageIds['travel'],    'travel',    1, 0],
			[$pageIds['education'], 'education', 1, 0],
			[$pageIds['calendar'],  'calendar',  1, 0],
			[$pageIds['contact'],   'contact',   1, 0],
		]);

		$this->batchInsert('{{%page_translation}}', [
			'page_id',
			'language_id',
			'title',
			'subtitle',
			'meta_description',
			'meta_keywords',
			'origin_label',
			'origin_url',
			'body_content',
			'status',
			'created_at',
			'updated_at',
			'created_by',
			'updated_by',
		], [
			[
				$pageIds['intro'], $languageIds['en'],
				'Discover Steppe West: Bringing Central Asia to the World',
				null,
				'Showcasing the rich and diverse music and cultures of Central Asia to the English speaking world.',
				'Central Asia, Kazakhstan, Kyrgyzstan, Tajikistan, Turkmenistan, Uzbekistan, Azerbaijan, Mongolia, Turks, Yakut, Sahaka, Tuva, Siberia, Mongols, Azeri Music, Kazakh Music, Kyrgyz Music, Mongolian Music, Tajik Music, Turkmen Music, Uzbek Music, Central Asian Music, Turkic Music, Mongol Music, Yakut Music, Sahaka Music, Tuvan Music, Siberian Music, Azeri Culture, Kazakh Culture, Kyrgyz Culture, Mongolian Culture, Tajik Culture, Turkmen Culture, Uzbek Culture, Central Asian Culture, Turkic Culture, Mongol Culture, Yakut Culture, Sahaka Culture, Tuvan Culture, Siberian Culture, Central Asian News, Azeri News, Kazakh News, Kyrgyz News, Mongolian News, Tajik News, Turkmen News, Uzbek News, Turkic News, Mongol News, Yakut News, Sahaka News, Tuvan News, Siberian News, Azeri Art, Kazakh Art, Kyrgyz Art, Mongolian Art, Tajik Art, Turkmen Art, Uzbek Art, Central Asian Art, Turkic Art, Mongol Art, Yakut Art, Sahaka Art, Tuvan Art, Siberian Art, Girls’ Education in Central Asia, Education for Girls in Central Asia, Tech for Girls in Central Asia, Laptops for Girls in Central Asia, Tablets for Girls in Central Asia, Phones for Girls in Central Asia, Educational Technology in Central Asia, Girls’ Empowerment in Central Asia, Nonprofit for Girls in Central Asia',
				null, null,
				$pageBodies['intro']['en'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['intro'], $languageIds['ru'],
				'Откройте для себя Steppe West: Приближая Центральную Азию к миру',
				null,
				'Представляя богатую и разнообразную музыку и культуры Центральной Азии англоязычному миру.',
				'Центральная Азия, Казахстан, Кыргызстан, Таджикистан, Туркменистан, Узбекистан, Азербайджан, Монголия, тюрки, якуты, саха, тувинцы, Сибирь, монголы, азербайджанская музыка, казахская музыка, кыргызская музыка, монгольская музыка, таджикская музыка, туркменская музыка, узбекская музыка, музыка Центральной Азии, тюркская музыка, монгольская музыка, якутская музыка, музыка саха, тувинская музыка, сибирская музыка, азербайджанская культура, казахская культура, кыргызская культура, монгольская культура, таджикская культура, туркменская культура, узбекская культура, культура Центральной Азии, тюркская культура, монгольская культура, якутская культура, культура саха, тувинская культура, сибирская культура, новости Центральной Азии, новости Азербайджана, новости Казахстана, новости Кыргызстана, новости Монголии, новости Таджикистана, новости Туркменистана, новости Узбекистана, тюркские новости, монгольские новости, якутские новости, новости саха, тувинские новости, сибирские новости, азербайджанское искусство, казахское искусство, кыргызское искусство, монгольское искусство, таджикское искусство, туркменское искусство, узбекское искусство, искусство Центральной Азии, тюркское искусство, монгольское искусство, якутское искусство, искусство саха, тувинское искусство, сибирское искусство, образование девочек в Центральной Азии, обучение девочек в Центральной Азии, технологии для девочек в Центральной Азии, ноутбуки для девочек в Центральной Азии, планшеты для девочек в Центральной Азии, телефоны для девочек в Центральной Азии, образовательные технологии в Центральной Азии, расширение прав и возможностей девочек в Центральной Азии, некоммерческая организация для девочек в Центральной Азии',
				null, null,
				$pageBodies['intro']['ru'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['intro'], $languageIds['kk'],
				'Steppe West-пен танысыңыз: Орталық Азияны әлемге жақындату',
				null,
				'Орталық Азияның бай әрі алуан түрлі музыкасы мен мәдениеттерін ағылшын тілді әлемге көрсету.',
				'Орталық Азия, Қазақстан, Қырғызстан, Тәжікстан, Түрікменстан, Өзбекстан, Әзербайжан, Моңғолия, түріктер, якуттар, сахалар, тувалар, Сібір, моңғолдар, әзербайжан музыкасы, қазақ музыкасы, қырғыз музыкасы, моңғол музыкасы, тәжік музыкасы, түрікмен музыкасы, өзбек музыкасы, Орталық Азия музыкасы, түркі музыкасы, моңғол музыкасы, якут музыкасы, саха музыкасы, тувалық музыка, сібір музыкасы, әзербайжан мәдениеті, қазақ мәдениеті, қырғыз мәдениеті, моңғол мәдениеті, тәжік мәдениеті, түрікмен мәдениеті, өзбек мәдениеті, Орталық Азия мәдениеті, түркі мәдениеті, моңғол мәдениеті, якут мәдениеті, саха мәдениеті, тувалық мәдениет, сібір мәдениеті, Орталық Азия жаңалықтары, Әзербайжан жаңалықтары, Қазақстан жаңалықтары, Қырғызстан жаңалықтары, Моңғолия жаңалықтары, Тәжікстан жаңалықтары, Түрікменстан жаңалықтары, Өзбекстан жаңалықтары, түркі жаңалықтары, моңғол жаңалықтары, якут жаңалықтары, саха жаңалықтары, тувалық жаңалықтар, сібір жаңалықтары, әзербайжан өнері, қазақ өнері, қырғыз өнері, моңғол өнері, тәжік өнері, түрікмен өнері, өзбек өнері, Орталық Азия өнері, түркі өнері, моңғол өнері, якут өнері, саха өнері, тувалық өнер, сібір өнері, Орталық Азиядағы қыздар білім беруі, Орталық Азиядағы қыздарға арналған білім, Орталық Азиядағы қыздарға арналған технология, Орталық Азиядағы қыздарға арналған ноутбуктер, Орталық Азиядағы қыздарға арналған планшеттер, Орталық Азиядағы қыздарға арналған ұялы телефондар, Орталық Азиядағы білім беру технологиясы, Орталық Азиядағы қыздарды қолдау, Орталық Азиядағы қыздарға арналған коммерциялық емес ұйым',
				null, null,
				$pageBodies['intro']['kk'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['intro'], $languageIds['ky'],
				'Steppe West менен таанышып кетиңиз: Борбордук Азияны дүйнөгө жакындатуу',
				null,
				'Борбордук Азиянын бай жана ар түрдүү музыкасын жана маданияттарын англис тилдүү дүйнөгө көрсөтүү.',
				'Борбордук Азия, Казакстан, Кыргызстан, Тажикстан, Түркмөнстан, Өзбекстан, Азербайжан, Монголия, түрк элдери, якуттар, сахалар, тувалар, Сибирь, монголдор, азери музыкасы, казак музыкасы, кыргыз музыкасы, монгол музыкасы, тажик музыкасы, түркмөн музыкасы, өзбек музыкасы, Борбор Азия музыкасы, түрк музыкасы, монгол музыкасы, якут музыкасы, саха музыкасы, тувалык музыка, сибир музыкасы, азери маданияты, казак маданияты, кыргыз маданияты, монгол маданияты, тажик маданияты, түркмөн маданияты, өзбек маданияты, Борбор Азия маданияты, түрк маданияты, монгол маданияты, якут маданияты, саха маданияты, тувалык маданият, сибир маданияты, Борбор Азия жаңылыктары, Азербайжан жаңылыктары, Казакстан жаңылыктары, Кыргызстан жаңылыктары, Монголия жаңылыктары, Тажикстан жаңылыктары, Түркмөнстан жаңылыктары, Өзбекстан жаңылыктары, түрк жаңылыктары, монгол жаңылыктары, якут жаңылыктары, саха жаңылыктары, тувалык жаңылыктар, сибир жаңылыктары, азери өнөрү, казак өнөрү, кыргыз өнөрү, монгол өнөрү, тажик өнөрү, түркмөн өнөрү, өзбек өнөрү, Борбор Азия өнөрү, түрк өнөрү, монгол өнөрү, якут өнөрү, саха өнөрү, тувалык өнөр, сибир өнөрү, Борбор Азиядагы кыздар билим берүүсү, Борбор Азиядагы кыздар үчүн билим берүү, Борбор Азиядагы кыздар үчүн технология, Борбор Азиядагы кыздар үчүн ноутбуктар, Борбор Азиядагы кыздар үчүн планшеттер, Борбор Азиядагы кыздар үчүн телефон, Борбор Азиядагы билим берүү технологиясы, Борбор Азиядагы кыздарды колдоо, Борбор Азиядагы кыздар үчүн коммерциялык эмес уюм',
				null, null,
				$pageBodies['intro']['ky'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['intro'], $languageIds['tg'],
				'Steppe West-ро кашф кунед: Наздик кардани Осиёи Марказӣ ба ҷаҳон',
				null,
				'Намоиш додани мусиқӣ ва фарҳангҳои ғанӣ ва гуногуни Осиёи Марказӣ ба ҷаҳони англисзабон.',
				'Осиёи Марказӣ, Қазоқистон, Қирғизистон, Тоҷикистон, Туркманистон, Ӯзбекистон, Озарбойҷон, Муғулистон, туркҳо, яқутҳо, саҳо, тӯваҳо, Сибир, муғулҳо, мусиқии озарӣ, мусиқии қазоқӣ, мусиқии қирғизӣ, мусиқии муғулӣ, мусиқии тоҷикӣ, мусиқии туркманӣ, мусиқии ӯзбекӣ, мусиқии Осиёи Марказӣ, мусиқии туркӣ, мусиқии муғулӣ, мусиқии яқутӣ, мусиқии саҳа, мусиқии тӯва, мусиқии сибирӣ, фарҳанги озарӣ, фарҳанги қазоқӣ, фарҳанги қирғизӣ, фарҳанги муғулӣ, фарҳанги тоҷикӣ, фарҳанги туркманӣ, фарҳанги ӯзбекӣ, фарҳанги Осиёи Марказӣ, фарҳанги туркӣ, фарҳанги муғулӣ, фарҳанги яқутӣ, фарҳанги саҳа, фарҳанги тӯва, фарҳанги сибирӣ, хабарҳои Осиёи Марказӣ, хабарҳои Озарбойҷон, хабарҳои Қазоқистон, хабарҳои Қирғизистон, хабарҳои Муғулистон, хабарҳои Тоҷикистон, хабарҳои Туркманистон, хабарҳои Ӯзбекистон, хабарҳои туркӣ, хабарҳои муғулӣ, хабарҳои яқутӣ, хабарҳои саҳа, хабарҳои тӯва, хабарҳои сибирӣ, санъати озарӣ, санъати қазоқӣ, санъати қирғизӣ, санъати муғулӣ, санъати тоҷикӣ, санъати туркманӣ, санъати ӯзбекӣ, санъати Осиёи Марказӣ, санъати туркӣ, санъати муғулӣ, санъати яқутӣ, санъати саҳа, санъати тӯва, санъати сибирӣ, таҳсилоти духтарон дар Осиёи Марказӣ, маориф барои духтарон дар Осиёи Марказӣ, технология барои духтарон дар Осиёи Марказӣ, ноутбукҳо барои духтарон дар Осиёи Марказӣ, планшетҳо барои духтарон дар Осиёи Марказӣ, телефонҳо барои духтарон дар Осиёи Марказӣ, технологияи таълимӣ дар Осиёи Марказӣ, тавонмандсозии духтарон дар Осиёи Марказӣ, ташкилоти ғайритиҷоратӣ барои духтарон дар Осиёи Марказӣ',
				null, null,
				$pageBodies['intro']['tg'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['intro'], $languageIds['tk'],
				'Steppe West bilen tanyşyň: Merkezi Aziýany dünýä ýakynlaşdyrmak',
				null,
				'Merkezi Aziýanyň baý we dürli-dürli aýdym-sazlaryny we medeniýetlerini iňlis dilinde gürleýän dünýä görkezmek.',
				'Merkezi Aziýa, Gazagystan, Gyrgyzystan, Täjigistan, Türkmenistan, Özbegistan, Azerbaýjan, Mongoliýa, türkmenler, Ýakutlar, Sahalar, Tuwa, Sibir, mongollar, azeri aýdym-sazlary, gazak aýdym-sazlary, gyrgyz aýdym-sazlary, mongol aýdym-sazlary, täjik aýdym-sazlary, türkmen aýdym-sazlary, özbek aýdym-sazlary, Merkezi Aziýa aýdym-sazlary, türk aýdym-sazlary, mongol aýdym-sazlary, ýakut aýdym-sazlary, saha aýdym-sazlary, tuwa aýdym-sazlary, sibir aýdym-sazlary, azeri medeniýeti, gazak medeniýeti, gyrgyz medeniýeti, mongol medeniýeti, täjik medeniýeti, türkmen medeniýeti, özbek medeniýeti, Merkezi Aziýa medeniýeti, türk medeniýeti, mongol medeniýeti, ýakut medeniýeti, saha medeniýeti, tuwa medeniýeti, sibir medeniýeti, Merkezi Aziýa täzelikleri, azeri täzelikleri, gazak täzelikleri, gyrgyz täzelikleri, mongol täzelikleri, täjik täzelikleri, türkmen täzelikleri, özbek täzelikleri, türk täzelikleri, mongol täzelikleri, ýakut täzelikleri, saha täzelikleri, tuwa täzelikleri, sibir täzelikleri, azeri sungaty, gazak sungaty, gyrgyz sungaty, mongol sungaty, täjik sungaty, türkmen sungaty, özbek sungaty, Merkezi Aziýa sungaty, türk sungaty, mongol sungaty, ýakut sungaty, saha sungaty, tuwa sungaty, sibir sungaty, Merkezi Aziýada gyzlaryň bilimi, Merkezi Aziýada gyzlar üçin bilim, Merkezi Aziýada gyzlar üçin tehnologiýa, Merkezi Aziýada gyzlar üçin noutbuklar, Merkezi Aziýada gyzlar üçin planşetler, Merkezi Aziýada gyzlar üçin telefonlar, Merkezi Aziýada bilim tehnologiýasy, Merkezi Aziýada gyzlaryň hukuklaryny güýçlendirmek, Merkezi Aziýada gyzlar üçin haýyr-sahawat guramasy',
				null, null,
				$pageBodies['intro']['tk'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['intro'], $languageIds['uz'],
				'Steppe West bilan tanishing: Markaziy Osiyoni dunyoga tanitish',
				null,
				'Markaziy Osiyoning boy va rang-barang musiqasi va madaniyatlarini ingliz tilida so’zlashuvchi dunyoga namoyish qilish.',
				'Markaziy Osiyo, Qozog‘iston, Qirg‘iziston, Tojikiston, Turkmaniston, O‘zbekiston, Ozarbayjon, Mo‘g‘uliston, turklar, Yakut, Saxa, Tuva, Sibir, mo‘g‘ullar, ozar musiqa, qozoq musiqa, qirg‘iz musiqa, mo‘g‘ul musiqa, tojik musiqa, turkman musiqa, o‘zbek musiqa, Markaziy Osiyo musiqasi, turkiy musiqa, mo‘g‘ul musiqa, yakut musiqa, saha musiqa, tuva musiqa, sibir musiqa, ozar madaniyati, qozoq madaniyati, qirg‘iz madaniyati, mo‘g‘ul madaniyati, tojik madaniyati, turkman madaniyati, o‘zbek madaniyati, Markaziy Osiyo madaniyati, turkiy madaniyat, mo‘g‘ul madaniyati, yakut madaniyati, saha madaniyati, tuva madaniyati, sibir madaniyati, Markaziy Osiyo yangiliklari, ozar yangiliklari, qozoq yangiliklari, qirg‘iz yangiliklari, mo‘g‘ul yangiliklari, tojik yangiliklari, turkman yangiliklari, o‘zbek yangiliklari, turkiy yangiliklar, mo‘g‘ul yangiliklari, yakut yangiliklari, saha yangiliklari, tuva yangiliklari, sibir yangiliklari, ozar san’ati, qozoq san’ati, qirg‘iz san’ati, mo‘g‘ul san’ati, tojik san’ati, turkman san’ati, o‘zbek san’ati, Markaziy Osiyo san’ati, turkiy san’at, mo‘g‘ul san’ati, yakut san’ati, saha san’ati, tuva san’ati, sibir san’ati, Markaziy Osiyoda qizlar ta’limi, Markaziy Osiyoda qizlar uchun ta’lim, Markaziy Osiyoda qizlar uchun texnologiya, Markaziy Osiyoda qizlar uchun noutbuklar, Markaziy Osiyoda qizlar uchun planshetlar, Markaziy Osiyoda qizlar uchun telefonlar, Markaziy Osiyoda ta’lim texnologiyasi, Markaziy Osiyoda qizlar huquqlarini kengaytirish, Markaziy Osiyoda qizlar uchun notijorat tashkilot',
				null, null,
				$pageBodies['intro']['uz'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['intro'], $languageIds['az'],
				'Steppe West ilə tanış olun: Orta Asiyanı dünyaya tanıtmaq',
				null,
				'Mərkəzi Asiyanın zəngin və müxtəlif musiqi və mədəniyyətlərini ingilisdilli dünyaya təqdim etmək.',
				'Mərkəzi Asiya, Qazaxıstan, Qırğızıstan, Tacikistan, Türkmənistan, Özbəkistan, Azərbaycan, Monqolustan, türklər, Yakut, Saha, Tuva, Sibir, monqollar, azəri musiqisi, qazax musiqisi, qırğız musiqisi, monqol musiqisi, tacik musiqisi, türkmən musiqisi, özbək musiqisi, Mərkəzi Asiya musiqisi, türk musiqisi, monqol musiqisi, yakut musiqisi, saha musiqisi, tuva musiqisi, sibir musiqisi, azəri mədəniyyəti, qazax mədəniyyəti, qırğız mədəniyyəti, monqol mədəniyyəti, tacik mədəniyyəti, türkmən mədəniyyəti, özbək mədəniyyəti, Mərkəzi Asiya mədəniyyəti, türk mədəniyyəti, monqol mədəniyyəti, yakut mədəniyyəti, saha mədəniyyəti, tuva mədəniyyəti, sibir mədəniyyəti, Mərkəzi Asiya xəbərləri, azəri xəbərləri, qazax xəbərləri, qırğız xəbərləri, monqol xəbərləri, tacik xəbərləri, türkmən xəbərləri, özbək xəbərləri, türk xəbərləri, monqol xəbərləri, yakut xəbərləri, saha xəbərləri, tuva xəbərləri, sibir xəbərləri, azəri sənəti, qazax sənəti, qırğız sənəti, monqol sənəti, tacik sənəti, türkmən sənəti, özbək sənəti, Mərkəzi Asiya sənəti, türk sənəti, monqol sənəti, yakut sənəti, saha sənəti, tuva sənəti, sibir sənəti, Mərkəzi Asiyada qızların təhsili, Mərkəzi Asiyada qızlar üçün təhsil, Mərkəzi Asiyada qızlar üçün texnologiya, Mərkəzi Asiyada qızlar üçün noutbuklar, Mərkəzi Asiyada qızlar üçün planşetlər, Mərkəzi Asiyada qızlar üçün telefonlar, Mərkəzi Asiyada təhsil texnologiyası, Mərkəzi Asiyada qızların gücləndirilməsi, Mərkəzi Asiyada qızlar üçün qeyri-kommersiya təşkilatı',
				null, null,
				$pageBodies['intro']['az'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['intro'], $languageIds['mn'],
				'Steppe West-тэй танилцана уу: Төв Азийг дэлхийд ойртуу',
				null,
				'Төв Азийн баян, олон янзын хөгжим болон соёлыг англи хэлээр ярьдаг дэлхийд танилцуулах.',
				'Төв Ази, Казахстан, Кыргызстан, Тажикистан, Туркменистан, Узбекистан, Азербайжан, Монгол, Түрэг, Якут, Саха, Тува, Сибирь, Монголчууд, Азербайжаны хөгжим, Казахстаны хөгжим, Кыргызстаны хөгжим, Монголын хөгжим, Тажикистаны хөгжим, Туркмены хөгжим, Узбекын хөгжим, Төв Азийн хөгжим, Түрэг хөгжим, Монгол хөгжим, Якут хөгжим, Саха хөгжим, Тува хөгжим, Сибирийн хөгжим, Азербайжаны соёл, Казахстаны соёл, Кыргызстаны соёл, Монголын соёл, Тажикистаны соёл, Туркмены соёл, Узбекын соёл, Төв Азийн соёл, Түрэг соёл, Монгол соёл, Якут соёл, Саха соёл, Тува соёл, Сибирийн соёл, Төв Азийн мэдээ, Азербайжаны мэдээ, Казахстаны мэдээ, Кыргызстаны мэдээ, Монголын мэдээ, Тажикистаны мэдээ, Туркмены мэдээ, Узбекын мэдээ, Түрэг мэдээ, Монгол мэдээ, Якут мэдээ, Саха мэдээ, Тува мэдээ, Сибирийн мэдээ, Азербайжаны урлаг, Казахстаны урлаг, Кыргызстаны урлаг, Монголын урлаг, Тажикистаны урлаг, Туркмены урлаг, Узбекын урлаг, Төв Азийн урлаг, Түрэг урлаг, Монгол урлаг, Якут урлаг, Саха урлаг, Тува урлаг, Сибирийн урлаг, Төв Азид охидын боловсрол, Төв Азид охидын боловсролын боломжууд, Төв Азид охидын технологи, Төв Азид охидод зориулсан зөөврийн компьютер, Төв Азид охидод зориулсан таблет, Төв Азид охидод зориулсан гар утас, Төв Азийн боловсролын технологи, Төв Азид охидыг чадавхижуулах, Төв Азид охидын боловсролыг дэмжих ашгийн бус байгууллага',
				null, null,
				$pageBodies['intro']['mn'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['intro'], $languageIds['tr'],
				'Steppe West’i Keşfedin: Orta Asya’yı Dünyaya Taşımak',
				null,
				'Orta Asya’nın zengin ve çeşitli müziklerini ve kültürlerini İngilizce konuşan dünyaya tanıtmak.',
				'Orta Asya, Kazakistan, Kırgızistan, Tacikistan, Türkmenistan, Özbekistan, Azerbaycan, Moğolistan, Türkler, Yakut, Sahaka, Tuva, Sibirya, Moğollar, Azeri Müziği, Kazak Müziği, Kırgız Müziği, Moğol Müziği, Tacik Müziği, Türkmen Müziği, Özbek Müziği, Orta Asya Müziği, Türk Müziği, Moğol Müziği, Yakut Müziği, Sahaka Müziği, Tuva Müziği, Sibirya Müziği, Azeri Kültürü, Kazak Kültürü, Kırgız Kültürü, Moğol Kültürü, Tacik Kültürü, Türkmen Kültürü, Özbek Kültürü, Orta Asya Kültürü, Türk Kültürü, Moğol Kültürü, Yakut Kültürü, Sahaka Kültürü, Tuva Kültürü, Sibirya Kültürü, Orta Asya Haberleri, Azeri Haberleri, Kazak Haberleri, Kırgız Haberleri, Moğol Haberleri, Tacik Haberleri, Türkmen Haberleri, Özbek Haberleri, Türk Haberleri, Moğol Haberleri, Yakut Haberleri, Sahaka Haberleri, Tuva Haberleri, Sibirya Haberleri, Azeri Sanatı, Kazak Sanatı, Kırgız Sanatı, Moğol Sanatı, Tacik Sanatı, Türkmen Sanatı, Özbek Sanatı, Orta Asya Sanatı, Türk Sanatı, Moğol Sanatı, Yakut Sanatı, Sahaka Sanatı, Tuva Sanatı, Sibirya Sanatı, Orta Asya’da Kızların Eğitimi, Orta Asya’da Kız Çocukları için Eğitim, Orta Asya’da Kızlar için Teknoloji, Orta Asya’da Kızlar için Dizüstü Bilgisayarlar, Orta Asya’da Kızlar için Tabletler, Orta Asya’da Kızlar için Telefonlar, Orta Asya’da Eğitim Teknolojisi, Orta Asya’da Kızların Güçlendirilmesi, Orta Asya’da Kızlar için Kar Amacı Gütmeyen Kuruluş',
				null, null,
				$pageBodies['intro']['tr'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['invite'], $languageIds['en'],
				'An Invitation to Share Your Stories with the World',
				'We publish and promote stories from Central Asia for English-speaking audiences',
				'Showcasing the rich and diverse music and cultures of Central Asia to the English speaking world.',
				'Central Asia, Kazakhstan, Kyrgyzstan, Tajikistan, Turkmenistan, Uzbekistan, Azerbaijan, Mongolia, Turks, Yakut, Sahaka, Tuva, Siberia, Mongols, Azeri Music, Kazakh Music, Kyrgyz Music, Mongolian Music, Tajik Music, Turkmen Music, Uzbek Music, Central Asian Music, Turkic Music, Mongol Music, Yakut Music, Sahaka Music, Tuvan Music, Siberian Music, Azeri Culture, Kazakh Culture, Kyrgyz Culture, Mongolian Culture, Tajik Culture, Turkmen Culture, Uzbek Culture, Central Asian Culture, Turkic Culture, Mongol Culture, Yakut Culture, Sahaka Culture, Tuvan Culture, Siberian Culture, Central Asian News, Azeri News, Kazakh News, Kyrgyz News, Mongolian News, Tajik News, Turkmen News, Uzbek News, Turkic News, Mongol News, Yakut News, Sahaka News, Tuvan News, Siberian News, Azeri Art, Kazakh Art, Kyrgyz Art, Mongolian Art, Tajik Art, Turkmen Art, Uzbek Art, Central Asian Art, Turkic Art, Mongol Art, Yakut Art, Sahaka Art, Tuvan Art, Siberian Art, Girls’ Education in Central Asia, Education for Girls in Central Asia, Tech for Girls in Central Asia, Laptops for Girls in Central Asia, Tablets for Girls in Central Asia, Phones for Girls in Central Asia, Educational Technology in Central Asia, Girls’ Empowerment in Central Asia, Nonprofit for Girls in Central Asia',
				'SubstackOrigin01', 'https://steppewest.substack.com/p/steppe-wests-invitation',
				$pageBodies['invite']['en'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['invite'], $languageIds['ru'],
				'Соединяя культуры: Приглашение от Steppe West в Центральную Азию',
				'Присоединяйтесь к нам в путешествии культурного обмена и открытий',
				'Представляя богатую и разнообразную музыку и культуры Центральной Азии англоязычному миру.',
				'Центральная Азия, Казахстан, Кыргызстан, Таджикистан, Туркменистан, Узбекистан, Азербайджан, Монголия, тюрки, якуты, саха, тувинцы, Сибирь, монголы, азербайджанская музыка, казахская музыка, кыргызская музыка, монгольская музыка, таджикская музыка, туркменская музыка, узбекская музыка, музыка Центральной Азии, тюркская музыка, монгольская музыка, якутская музыка, музыка саха, тувинская музыка, сибирская музыка, азербайджанская культура, казахская культура, кыргызская культура, монгольская культура, таджикская культура, туркменская культура, узбекская культура, культура Центральной Азии, тюркская культура, монгольская культура, якутская культура, культура саха, тувинская культура, сибирская культура, новости Центральной Азии, новости Азербайджана, новости Казахстана, новости Кыргызстана, новости Монголии, новости Таджикистана, новости Туркменистана, новости Узбекистана, тюркские новости, монгольские новости, якутские новости, новости саха, тувинские новости, сибирские новости, азербайджанское искусство, казахское искусство, кыргызское искусство, монгольское искусство, таджикское искусство, туркменское искусство, узбекское искусство, искусство Центральной Азии, тюркское искусство, монгольское искусство, якутское искусство, искусство саха, тувинское искусство, сибирское искусство, образование девочек в Центральной Азии, обучение девочек в Центральной Азии, технологии для девочек в Центральной Азии, ноутбуки для девочек в Центральной Азии, планшеты для девочек в Центральной Азии, телефоны для девочек в Центральной Азии, образовательные технологии в Центральной Азии, расширение прав и возможностей девочек в Центральной Азии, некоммерческая организация для девочек в Центральной Азии',
				'SubstackOrigin01', 'https://steppewest.substack.com/p/steppe-wests-invitation',
				$pageBodies['invite']['ru'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['invite'], $languageIds['kk'],
				'Мәдениеттерді байланыстыру: Орталық Азияға Steppe West шақыруы',
				'Мәдени алмасу мен ашулар саяхатына қосылыңыздар',
				'Орталық Азияның бай әрі алуан түрлі музыкасы мен мәдениеттерін ағылшын тілді әлемге көрсету.',
				'Орталық Азия, Қазақстан, Қырғызстан, Тәжікстан, Түрікменстан, Өзбекстан, Әзербайжан, Моңғолия, түріктер, якуттар, сахалар, тувалар, Сібір, моңғолдар, әзербайжан музыкасы, қазақ музыкасы, қырғыз музыкасы, моңғол музыкасы, тәжік музыкасы, түрікмен музыкасы, өзбек музыкасы, Орталық Азия музыкасы, түркі музыкасы, моңғол музыкасы, якут музыкасы, саха музыкасы, тувалық музыка, сібір музыкасы, әзербайжан мәдениеті, қазақ мәдениеті, қырғыз мәдениеті, моңғол мәдениеті, тәжік мәдениеті, түрікмен мәдениеті, өзбек мәдениеті, Орталық Азия мәдениеті, түркі мәдениеті, моңғол мәдениеті, якут мәдениеті, саха мәдениеті, тувалық мәдениет, сібір мәдениеті, Орталық Азия жаңалықтары, Әзербайжан жаңалықтары, Қазақстан жаңалықтары, Қырғызстан жаңалықтары, Моңғолия жаңалықтары, Тәжікстан жаңалықтары, Түрікменстан жаңалықтары, Өзбекстан жаңалықтары, түркі жаңалықтары, моңғол жаңалықтары, якут жаңалықтары, саха жаңалықтары, тувалық жаңалықтар, сібір жаңалықтары, әзербайжан өнері, қазақ өнері, қырғыз өнері, моңғол өнері, тәжік өнері, түрікмен өнері, өзбек өнері, Орталық Азия өнері, түркі өнері, моңғол өнері, якут өнері, саха өнері, тувалық өнер, сібір өнері, Орталық Азиядағы қыздар білім беруі, Орталық Азиядағы қыздарға арналған білім, Орталық Азиядағы қыздарға арналған технология, Орталық Азиядағы қыздарға арналған ноутбуктер, Орталық Азиядағы қыздарға арналған планшеттер, Орталық Азиядағы қыздарға арналған ұялы телефондар, Орталық Азиядағы білім беру технологиясы, Орталық Азиядағы қыздарды қолдау, Орталық Азиядағы қыздарға арналған коммерциялық емес ұйым',
				'SubstackOrigin01', 'https://steppewest.substack.com/p/steppe-wests-invitation',
				$pageBodies['invite']['kk'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['invite'], $languageIds['ky'],
				'Маданияттарды бириктирүү: Борбордук Азияга Steppe Westтин чакыруусу',
				'Маданий алмашуу жана ачылыш саякатына кошулуңуздар',
				'Борбордук Азиянын бай жана ар түрдүү музыкасын жана маданияттарын англис тилдүү дүйнөгө көрсөтүү.',
				'Борбордук Азия, Казакстан, Кыргызстан, Тажикстан, Түркмөнстан, Өзбекстан, Азербайжан, Монголия, түрк элдери, якуттар, сахалар, тувалар, Сибирь, монголдор, азери музыкасы, казак музыкасы, кыргыз музыкасы, монгол музыкасы, тажик музыкасы, түркмөн музыкасы, өзбек музыкасы, Борбор Азия музыкасы, түрк музыкасы, монгол музыкасы, якут музыкасы, саха музыкасы, тувалык музыка, сибир музыкасы, азери маданияты, казак маданияты, кыргыз маданияты, монгол маданияты, тажик маданияты, түркмөн маданияты, өзбек маданияты, Борбор Азия маданияты, түрк маданияты, монгол маданияты, якут маданияты, саха маданияты, тувалык маданият, сибир маданияты, Борбор Азия жаңылыктары, Азербайжан жаңылыктары, Казакстан жаңылыктары, Кыргызстан жаңылыктары, Монголия жаңылыктары, Тажикстан жаңылыктары, Түркмөнстан жаңылыктары, Өзбекстан жаңылыктары, түрк жаңылыктары, монгол жаңылыктары, якут жаңылыктары, саха жаңылыктары, тувалык жаңылыктар, сибир жаңылыктары, азери өнөрү, казак өнөрү, кыргыз өнөрү, монгол өнөрү, тажик өнөрү, түркмөн өнөрү, өзбек өнөрү, Борбор Азия өнөрү, түрк өнөрү, монгол өнөрү, якут өнөрү, саха өнөрү, тувалык өнөр, сибир өнөрү, Борбор Азиядагы кыздар билим берүүсү, Борбор Азиядагы кыздар үчүн билим берүү, Борбор Азиядагы кыздар үчүн технология, Борбор Азиядагы кыздар үчүн ноутбуктар, Борбор Азиядагы кыздар үчүн планшеттер, Борбор Азиядагы кыздар үчүн телефон, Борбор Азиядагы билим берүү технологиясы, Борбор Азиядагы кыздарды колдоо, Борбор Азиядагы кыздар үчүн коммерциялык эмес уюм',
				'SubstackOrigin01', 'https://steppewest.substack.com/p/steppe-wests-invitation',
				$pageBodies['invite']['ky'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['invite'], $languageIds['tg'],
				'Пайвастани фарҳангҳо: Даъвати Steppe West ба Осиёи Марказӣ',
				'Ба сафаре аз табодули фарҳангӣ ва кашфиёт ҳамроҳ шавед',
				'Намоиш додани мусиқӣ ва фарҳангҳои ғанӣ ва гуногуни Осиёи Марказӣ ба ҷаҳони англисзабон.',
				'Осиёи Марказӣ, Қазоқистон, Қирғизистон, Тоҷикистон, Туркманистон, Ӯзбекистон, Озарбойҷон, Муғулистон, туркҳо, яқутҳо, саҳо, тӯваҳо, Сибир, муғулҳо, мусиқии озарӣ, мусиқии қазоқӣ, мусиқии қирғизӣ, мусиқии муғулӣ, мусиқии тоҷикӣ, мусиқии туркманӣ, мусиқии ӯзбекӣ, мусиқии Осиёи Марказӣ, мусиқии туркӣ, мусиқии муғулӣ, мусиқии яқутӣ, мусиқии саҳа, мусиқии тӯва, мусиқии сибирӣ, фарҳанги озарӣ, фарҳанги қазоқӣ, фарҳанги қирғизӣ, фарҳанги муғулӣ, фарҳанги тоҷикӣ, фарҳанги туркманӣ, фарҳанги ӯзбекӣ, фарҳанги Осиёи Марказӣ, фарҳанги туркӣ, фарҳанги муғулӣ, фарҳанги яқутӣ, фарҳанги саҳа, фарҳанги тӯва, фарҳанги сибирӣ, хабарҳои Осиёи Марказӣ, хабарҳои Озарбойҷон, хабарҳои Қазоқистон, хабарҳои Қирғизистон, хабарҳои Муғулистон, хабарҳои Тоҷикистон, хабарҳои Туркманистон, хабарҳои Ӯзбекистон, хабарҳои туркӣ, хабарҳои муғулӣ, хабарҳои яқутӣ, хабарҳои саҳа, хабарҳои тӯва, хабарҳои сибирӣ, санъати озарӣ, санъати қазоқӣ, санъати қирғизӣ, санъати муғулӣ, санъати тоҷикӣ, санъати туркманӣ, санъати ӯзбекӣ, санъати Осиёи Марказӣ, санъати туркӣ, санъати муғулӣ, санъати яқутӣ, санъати саҳа, санъати тӯва, санъати сибирӣ, таҳсилоти духтарон дар Осиёи Марказӣ, маориф барои духтарон дар Осиёи Марказӣ, технология барои духтарон дар Осиёи Марказӣ, ноутбукҳо барои духтарон дар Осиёи Марказӣ, планшетҳо барои духтарон дар Осиёи Марказӣ, телефонҳо барои духтарон дар Осиёи Марказӣ, технологияи таълимӣ дар Осиёи Марказӣ, тавонмандсозии духтарон дар Осиёи Марказӣ, ташкилоти ғайритиҷоратӣ барои духтарон дар Осиёи Марказӣ',
				'SubstackOrigin01', 'https://steppewest.substack.com/p/steppe-wests-invitation',
				$pageBodies['invite']['tg'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['invite'], $languageIds['tk'],
				'Medeniýetleri birleşdirmek: Steppe Westiň Merkezi Aziýa çakylygy',
				'Medeni alyş-çalşyklaryň we açyşlaryň syýahatyna goşulyň',
				'Merkezi Aziýanyň baý we dürli-dürli aýdym-sazlaryny we medeniýetlerini iňlis dilinde gürleýän dünýä görkezmek.',
				'Merkezi Aziýa, Gazagystan, Gyrgyzystan, Täjigistan, Türkmenistan, Özbegistan, Azerbaýjan, Mongoliýa, türkmenler, Ýakutlar, Sahalar, Tuwa, Sibir, mongollar, azeri aýdym-sazlary, gazak aýdym-sazlary, gyrgyz aýdym-sazlary, mongol aýdym-sazlary, täjik aýdym-sazlary, türkmen aýdym-sazlary, özbek aýdym-sazlary, Merkezi Aziýa aýdym-sazlary, türk aýdym-sazlary, mongol aýdym-sazlary, ýakut aýdym-sazlary, saha aýdym-sazlary, tuwa aýdym-sazlary, sibir aýdym-sazlary, azeri medeniýeti, gazak medeniýeti, gyrgyz medeniýeti, mongol medeniýeti, täjik medeniýeti, türkmen medeniýeti, özbek medeniýeti, Merkezi Aziýa medeniýeti, türk medeniýeti, mongol medeniýeti, ýakut medeniýeti, saha medeniýeti, tuwa medeniýeti, sibir medeniýeti, Merkezi Aziýa täzelikleri, azeri täzelikleri, gazak täzelikleri, gyrgyz täzelikleri, mongol täzelikleri, täjik täzelikleri, türkmen täzelikleri, özbek täzelikleri, türk täzelikleri, mongol täzelikleri, ýakut täzelikleri, saha täzelikleri, tuwa täzelikleri, sibir täzelikleri, azeri sungaty, gazak sungaty, gyrgyz sungaty, mongol sungaty, täjik sungaty, türkmen sungaty, özbek sungaty, Merkezi Aziýa sungaty, türk sungaty, mongol sungaty, ýakut sungaty, saha sungaty, tuwa sungaty, sibir sungaty, Merkezi Aziýada gyzlaryň bilimi, Merkezi Aziýada gyzlar üçin bilim, Merkezi Aziýada gyzlar üçin tehnologiýa, Merkezi Aziýada gyzlar üçin noutbuklar, Merkezi Aziýada gyzlar üçin planşetler, Merkezi Aziýada gyzlar üçin telefonlar, Merkezi Aziýada bilim tehnologiýasy, Merkezi Aziýada gyzlaryň hukuklaryny güýçlendirmek, Merkezi Aziýada gyzlar üçin haýyr-sahawat guramasy',
				'SubstackOrigin01', 'https://steppewest.substack.com/p/steppe-wests-invitation',
				$pageBodies['invite']['tk'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['invite'], $languageIds['uz'],
				'Madaniyatlarni o’zaro bo’glash: Steppe Westning Markaziy Osiyoga taklifnomasi',
				'Bizning madaniyatlar almashinuvi va yangiliklarga boy sayohatimizga qo’shiling',
				'Markaziy Osiyoning boy va rang-barang musiqasi va madaniyatlarini ingliz tilida so’zlashuvchi dunyoga namoyish qilish.',
				'Markaziy Osiyo, Qozog‘iston, Qirg‘iziston, Tojikiston, Turkmaniston, O‘zbekiston, Ozarbayjon, Mo‘g‘uliston, turklar, Yakut, Saxa, Tuva, Sibir, mo‘g‘ullar, ozar musiqa, qozoq musiqa, qirg‘iz musiqa, mo‘g‘ul musiqa, tojik musiqa, turkman musiqa, o‘zbek musiqa, Markaziy Osiyo musiqasi, turkiy musiqa, mo‘g‘ul musiqa, yakut musiqa, saha musiqa, tuva musiqa, sibir musiqa, ozar madaniyati, qozoq madaniyati, qirg‘iz madaniyati, mo‘g‘ul madaniyati, tojik madaniyati, turkman madaniyati, o‘zbek madaniyati, Markaziy Osiyo madaniyati, turkiy madaniyat, mo‘g‘ul madaniyati, yakut madaniyati, saha madaniyati, tuva madaniyati, sibir madaniyati, Markaziy Osiyo yangiliklari, ozar yangiliklari, qozoq yangiliklari, qirg‘iz yangiliklari, mo‘g‘ul yangiliklari, tojik yangiliklari, turkman yangiliklari, o‘zbek yangiliklari, turkiy yangiliklar, mo‘g‘ul yangiliklari, yakut yangiliklari, saha yangiliklari, tuva yangiliklari, sibir yangiliklari, ozar san’ati, qozoq san’ati, qirg‘iz san’ati, mo‘g‘ul san’ati, tojik san’ati, turkman san’ati, o‘zbek san’ati, Markaziy Osiyo san’ati, turkiy san’at, mo‘g‘ul san’ati, yakut san’ati, saha san’ati, tuva san’ati, sibir san’ati, Markaziy Osiyoda qizlar ta’limi, Markaziy Osiyoda qizlar uchun ta’lim, Markaziy Osiyoda qizlar uchun texnologiya, Markaziy Osiyoda qizlar uchun noutbuklar, Markaziy Osiyoda qizlar uchun planshetlar, Markaziy Osiyoda qizlar uchun telefonlar, Markaziy Osiyoda ta’lim texnologiyasi, Markaziy Osiyoda qizlar huquqlarini kengaytirish, Markaziy Osiyoda qizlar uchun notijorat tashkilot',
				'SubstackOrigin01', 'https://steppewest.substack.com/p/steppe-wests-invitation',
				$pageBodies['invite']['uz'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['invite'], $languageIds['az'],
				'Mədəniyyətləri birləşdirmək: Steppe West-in Orta Asiyaya dəvəti',
				'Mədəni mübadilə və kəşfiyyat səyahətinə qoşulun',
				'Mərkəzi Asiyanın zəngin və müxtəlif musiqi və mədəniyyətlərini ingilisdilli dünyaya təqdim etmək.',
				'Mərkəzi Asiya, Qazaxıstan, Qırğızıstan, Tacikistan, Türkmənistan, Özbəkistan, Azərbaycan, Monqolustan, türklər, Yakut, Saha, Tuva, Sibir, monqollar, azəri musiqisi, qazax musiqisi, qırğız musiqisi, monqol musiqisi, tacik musiqisi, türkmən musiqisi, özbək musiqisi, Mərkəzi Asiya musiqisi, türk musiqisi, monqol musiqisi, yakut musiqisi, saha musiqisi, tuva musiqisi, sibir musiqisi, azəri mədəniyyəti, qazax mədəniyyəti, qırğız mədəniyyəti, monqol mədəniyyəti, tacik mədəniyyəti, türkmən mədəniyyəti, özbək mədəniyyəti, Mərkəzi Asiya mədəniyyəti, türk mədəniyyəti, monqol mədəniyyəti, yakut mədəniyyəti, saha mədəniyyəti, tuva mədəniyyəti, sibir mədəniyyəti, Mərkəzi Asiya xəbərləri, azəri xəbərləri, qazax xəbərləri, qırğız xəbərləri, monqol xəbərləri, tacik xəbərləri, türkmən xəbərləri, özbək xəbərləri, türk xəbərləri, monqol xəbərləri, yakut xəbərləri, saha xəbərləri, tuva xəbərləri, sibir xəbərləri, azəri sənəti, qazax sənəti, qırğız sənəti, monqol sənəti, tacik sənəti, türkmən sənəti, özbək sənəti, Mərkəzi Asiya sənəti, türk sənəti, monqol sənəti, yakut sənəti, saha sənəti, tuva sənəti, sibir sənəti, Mərkəzi Asiyada qızların təhsili, Mərkəzi Asiyada qızlar üçün təhsil, Mərkəzi Asiyada qızlar üçün texnologiya, Mərkəzi Asiyada qızlar üçün noutbuklar, Mərkəzi Asiyada qızlar üçün planşetlər, Mərkəzi Asiyada qızlar üçün telefonlar, Mərkəzi Asiyada təhsil texnologiyası, Mərkəzi Asiyada qızların gücləndirilməsi, Mərkəzi Asiyada qızlar üçün qeyri-kommersiya təşkilatı',
				'SubstackOrigin01', 'https://steppewest.substack.com/p/steppe-wests-invitation',
				$pageBodies['invite']['az'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['invite'], $languageIds['mn'],
				'Соёлыг холбох нь: Steppe West-ийн Төв Азид уриалга',
				'Соёлын солилцоо, нээлтийн аялалд нэгдээрэй',
				'Төв Азийн баян, олон янзын хөгжим болон соёлыг англи хэлээр ярьдаг дэлхийд танилцуулах.',
				'Төв Ази, Казахстан, Кыргызстан, Тажикистан, Туркменистан, Узбекистан, Азербайжан, Монгол, Түрэг, Якут, Саха, Тува, Сибирь, Монголчууд, Азербайжаны хөгжим, Казахстаны хөгжим, Кыргызстаны хөгжим, Монголын хөгжим, Тажикистаны хөгжим, Туркмены хөгжим, Узбекын хөгжим, Төв Азийн хөгжим, Түрэг хөгжим, Монгол хөгжим, Якут хөгжим, Саха хөгжим, Тува хөгжим, Сибирийн хөгжим, Азербайжаны соёл, Казахстаны соёл, Кыргызстаны соёл, Монголын соёл, Тажикистаны соёл, Туркмены соёл, Узбекын соёл, Төв Азийн соёл, Түрэг соёл, Монгол соёл, Якут соёл, Саха соёл, Тува соёл, Сибирийн соёл, Төв Азийн мэдээ, Азербайжаны мэдээ, Казахстаны мэдээ, Кыргызстаны мэдээ, Монголын мэдээ, Тажикистаны мэдээ, Туркмены мэдээ, Узбекын мэдээ, Түрэг мэдээ, Монгол мэдээ, Якут мэдээ, Саха мэдээ, Тува мэдээ, Сибирийн мэдээ, Азербайжаны урлаг, Казахстаны урлаг, Кыргызстаны урлаг, Монголын урлаг, Тажикистаны урлаг, Туркмены урлаг, Узбекын урлаг, Төв Азийн урлаг, Түрэг урлаг, Монгол урлаг, Якут урлаг, Саха урлаг, Тува урлаг, Сибирийн урлаг, Төв Азид охидын боловсрол, Төв Азид охидын боловсролын боломжууд, Төв Азид охидын технологи, Төв Азид охидод зориулсан зөөврийн компьютер, Төв Азид охидод зориулсан таблет, Төв Азид охидод зориулсан гар утас, Төв Азийн боловсролын технологи, Төв Азид охидыг чадавхижуулах, Төв Азид охидын боловсролыг дэмжих ашгийн бус байгууллага',
				'SubstackOrigin01', 'https://steppewest.substack.com/p/steppe-wests-invitation',
				$pageBodies['invite']['mn'],
				'published', $now, $now, null, null
			],
			[
				$pageIds['invite'], $languageIds['tr'],
				'Kültürleri Birleştirme: Steppe West’ten Orta Asya’ya Davet',
				'Kültürel alışveriş ve keşif yolculuğumuza katılın',
				'Orta Asya’nın zengin ve çeşitli müziklerini ve kültürlerini İngilizce konuşan dünyaya tanıtmak.',
				'Orta Asya, Kazakistan, Kırgızistan, Tacikistan, Türkmenistan, Özbekistan, Azerbaycan, Moğolistan, Türkler, Yakut, Sahaka, Tuva, Sibirya, Moğollar, Azeri Müziği, Kazak Müziği, Kırgız Müziği, Moğol Müziği, Tacik Müziği, Türkmen Müziği, Özbek Müziği, Orta Asya Müziği, Türk Müziği, Moğol Müziği, Yakut Müziği, Sahaka Müziği, Tuva Müziği, Sibirya Müziği, Azeri Kültürü, Kazak Kültürü, Kırgız Kültürü, Moğol Kültürü, Tacik Kültürü, Türkmen Kültürü, Özbek Kültürü, Orta Asya Kültürü, Türk Kültürü, Moğol Kültürü, Yakut Kültürü, Sahaka Kültürü, Tuva Kültürü, Sibirya Kültürü, Orta Asya Haberleri, Azeri Haberleri, Kazak Haberleri, Kırgız Haberleri, Moğol Haberleri, Tacik Haberleri, Türkmen Haberleri, Özbek Haberleri, Türk Haberleri, Moğol Haberleri, Yakut Haberleri, Sahaka Haberleri, Tuva Haberleri, Sibirya Haberleri, Azeri Sanatı, Kazak Sanatı, Kırgız Sanatı, Moğol Sanatı, Tacik Sanatı, Türkmen Sanatı, Özbek Sanatı, Orta Asya Sanatı, Türk Sanatı, Moğol Sanatı, Yakut Sanatı, Sahaka Sanatı, Tuva Sanatı, Sibirya Sanatı, Orta Asya’da Kızların Eğitimi, Orta Asya’da Kız Çocukları için Eğitim, Orta Asya’da Kızlar için Teknoloji, Orta Asya’da Kızlar için Dizüstü Bilgisayarlar, Orta Asya’da Kızlar için Tabletler, Orta Asya’da Kızlar için Telefonlar, Orta Asya’da Eğitim Teknolojisi, Orta Asya’da Kızların Güçlendirilmesi, Orta Asya’da Kızlar için Kar Amacı Gütmeyen Kuruluş',
				'SubstackOrigin01', 'https://steppewest.substack.com/p/steppe-wests-invitation',
				$pageBodies['invite']['tr'],
				'published', $now, $now, null, null
			],
		]);
	}

	public function safeDown()
	{
		$pageIds = (new Query())
			->select('id')
			->from('{{%page}}')
			->where(['code' => ['intro', 'invite', 'travel', 'education', 'calendar', 'contact']])
			->column();

		if (!empty($pageIds)) {
			$this->delete('{{%page_translation}}', ['page_id' => $pageIds]);
			$this->delete('{{%page_route}}', ['page_id' => $pageIds]);
		}

		$this->delete('{{%page}}', [
			'code' => ['intro', 'invite', 'travel', 'education', 'calendar', 'contact'],
		]);
	}
}

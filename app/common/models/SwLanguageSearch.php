<?php
/**
 * SwLanguageSearch.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SwLanguage;

/**
 * SwLanguageSearch represents the model behind the search form of `common\models\SwLanguage`.
 */
class SwLanguageSearch extends SwLanguage
{
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['pk', 'menu_position', 'active'], 'integer'],
			[['lang_code', 'prev_code', 'lang_name', 'native_name', 'flag_icon', 'ui_label', 'locale', 'html_lang', 'footer_json'], 'safe'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = SwLanguage::find();

		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		// grid filtering conditions
		$query->andFilterWhere([
			'pk' => $this->pk,
			'menu_position' => $this->menu_position,
			'active' => $this->active,
		]);

		$query->andFilterWhere(['like', 'lang_code', $this->lang_code])
			->andFilterWhere(['like', 'prev_code', $this->prev_code])
			->andFilterWhere(['like', 'lang_name', $this->lang_name])
			->andFilterWhere(['like', 'native_name', $this->native_name])
			->andFilterWhere(['like', 'flag_icon', $this->flag_icon])
			->andFilterWhere(['like', 'ui_label', $this->ui_label])
			->andFilterWhere(['like', 'locale', $this->locale])
			->andFilterWhere(['like', 'html_lang', $this->html_lang])
			->andFilterWhere(['like', 'footer_json', $this->footer_json]);

		return $dataProvider;
	}
}

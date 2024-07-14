<?php
/**
 * SWLanguageSearch.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SWLanguage;

/**
 * SWLanguageSearch represents the model behind the search form of `common\models\SWLanguage`.
 */
class SWLanguageSearch extends SWLanguage
{
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['pk', 'position'], 'integer'],
			[['code', 'name', 'native', 'locale', 'lang', 'flag', 'label', 'description', 'keywords', 'origin', 'footer_yaml'], 'safe'],
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
		$query = SWLanguage::find();

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
			'position' => $this->position,
		]);

		$query->andFilterWhere(['like', 'code', $this->code])
			->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'native', $this->native])
			->andFilterWhere(['like', 'locale', $this->locale])
			->andFilterWhere(['like', 'lang', $this->lang])
			->andFilterWhere(['like', 'flag', $this->flag])
			->andFilterWhere(['like', 'label', $this->label])
			->andFilterWhere(['like', 'description', $this->description])
			->andFilterWhere(['like', 'keywords', $this->keywords])
			->andFilterWhere(['like', 'origin', $this->origin])
			->andFilterWhere(['like', 'footer_yaml', $this->footer_yaml]);

		return $dataProvider;
	}
}

<?php
/**
 * SWLanguageCodeSearch.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace letter\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use letter\models\SWLanguageCode;

/**
 * SWLanguageCodeSearch represents the model behind the search form of `letter\models\SWLanguageCode`.
 */
class SWLanguageCodeSearch extends SWLanguageCode
{
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['pk', 'position'], 'integer'],
			[['code', 'prev', 'name', 'native', 'flag', 'label'], 'safe'],
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
		$query = SWLanguageCode::find();

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
			->andFilterWhere(['like', 'prev', $this->prev])
			->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'native', $this->native])
			->andFilterWhere(['like', 'flag', $this->flag])
			->andFilterWhere(['like', 'label', $this->label]);

		return $dataProvider;
	}
}

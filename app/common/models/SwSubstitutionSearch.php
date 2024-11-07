<?php
/**
 * SwSubstitutionSearch.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SwSubstitution;

/**
 * SwSubstitutionSearch represents the model behind the search form of `common\models\SwSubstitution`.
 */
class SwSubstitutionSearch extends SwSubstitution
{
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['pk'], 'integer'],
			[['name', 'value', 'description'], 'safe'],
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
		$query = SwSubstitution::find();

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
		]);

		$query->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'value', $this->value])
			->andFilterWhere(['like', 'description', $this->description]);

		return $dataProvider;
	}
}

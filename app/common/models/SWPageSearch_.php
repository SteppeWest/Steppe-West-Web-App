<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SWPage;

/**
 * SWPageSearch represents the model behind the search form of `common\models\SWPage`.
 */
class SWPageSearch extends SWPage
{
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['pk', 'key_pk'], 'integer'],
			[['code', 'page', 'title', 'subtitle', 'body_yaml'], 'safe'],
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
		$query = SWPage::find();

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
			'key_pk' => $this->key_pk,
		]);

		$query->andFilterWhere(['like', 'code', $this->code])
			->andFilterWhere(['like', 'page', $this->page])
			->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['like', 'subtitle', $this->subtitle])
			->andFilterWhere(['like', 'body_yaml', $this->body_yaml]);

		return $dataProvider;
	}
}

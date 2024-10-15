<?php
/**
 * SWLanguageExtraSearch.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace letter\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use letter\models\SWLanguageExtra;

/**
 * SWLanguageExtraSearch represents the model behind the search form of `letter\models\SWLanguageExtra`.
 */
class SWLanguageExtraSearch extends SWLanguageExtra
{
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['pk'], 'integer'],
			[['code', 'locale', 'lang', 'footer_yaml'], 'safe'],
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
		$query = SWLanguageExtra::find();

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

		$query->andFilterWhere(['like', 'code', $this->code])
			->andFilterWhere(['like', 'locale', $this->locale])
			->andFilterWhere(['like', 'lang', $this->lang])
			->andFilterWhere(['like', 'footer_yaml', $this->footer_yaml]);

		return $dataProvider;
	}
}

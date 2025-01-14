<?php
/**
 * LanguagePageSearch.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LanguagePage;

/**
 * LanguagePageSearch represents the model behind the search form of `common\models\LanguagePage`.
 */
class LanguagePageSearch extends LanguagePage
{
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['pk', 'lang_pk'], 'integer'],
			[['page_lang', 'slug', 'title', 'subtitle', 'description', 'keywords', 'lead', 'origin', 'origin_link', 'body_content'], 'safe'],
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
		$query = LanguagePage::find();

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
			'lang_pk' => $this->lang_pk,
		]);

		$query->andFilterWhere(['like', 'page_lang', $this->page_lang])
			->andFilterWhere(['like', 'slug', $this->slug])
			->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['like', 'subtitle', $this->subtitle])
			->andFilterWhere(['like', 'description', $this->description])
			->andFilterWhere(['like', 'keywords', $this->keywords])
			->andFilterWhere(['like', 'lead', $this->lead])
			->andFilterWhere(['like', 'origin', $this->origin])
			->andFilterWhere(['like', 'origin_link', $this->origin_link])
			->andFilterWhere(['like', 'body_content', $this->body_content]);

		return $dataProvider;
	}
}

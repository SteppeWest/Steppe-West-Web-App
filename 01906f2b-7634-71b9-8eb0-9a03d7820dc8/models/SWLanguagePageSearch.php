<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SWLanguagePage;

/**
 * SWLanguagePageSearch represents the model behind the search form of `app\models\SWLanguagePage`.
 */
class SWLanguagePageSearch extends SWLanguagePage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pk'], 'integer'],
            [['code', 'page', 'title', 'subtitle', 'description', 'keywords', 'lead', 'body_yaml'], 'safe'],
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
        $query = SWLanguagePage::find();

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
            ->andFilterWhere(['like', 'page', $this->page])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'subtitle', $this->subtitle])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'lead', $this->lead])
            ->andFilterWhere(['like', 'body_yaml', $this->body_yaml]);

        return $dataProvider;
    }
}

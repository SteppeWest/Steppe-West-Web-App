<?php

namespace language\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use language\models\SWLanguageBase;

/**
 * SWLanguageBaseSearch represents the model behind the search form of `language\models\SWLanguageBase`.
 */
class SWLanguageBaseSearch extends SWLanguageBase
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['base_pk', 'position'], 'integer'],
            [['base_code', 'prev_code', 'name', 'native', 'flag_icon', 'ui_label'], 'safe'],
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
        $query = SWLanguageBase::find();

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
            'base_pk' => $this->base_pk,
            'position' => $this->position,
        ]);

        $query->andFilterWhere(['like', 'base_code', $this->base_code])
            ->andFilterWhere(['like', 'prev_code', $this->prev_code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'native', $this->native])
            ->andFilterWhere(['like', 'flag_icon', $this->flag_icon])
            ->andFilterWhere(['like', 'ui_label', $this->ui_label]);

        return $dataProvider;
    }
}

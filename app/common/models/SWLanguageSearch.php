<?php

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
            ->andFilterWhere(['like', 'prev', $this->prev])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'native', $this->native])
            ->andFilterWhere(['like', 'flag', $this->flag])
            ->andFilterWhere(['like', 'label', $this->label]);

        return $dataProvider;
    }
}

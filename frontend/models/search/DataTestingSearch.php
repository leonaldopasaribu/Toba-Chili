<?php

namespace frontend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\DataTesting;

/**
 * DataTestingSearch represents the model behind the search form of `frontend\models\DataTesting`.
 */
class DataTestingSearch extends DataTesting
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idTesting'], 'integer'],
            [['suhu_min', 'kelembabanUdara_maximum', 'kelembabanUdara_minimum', 'kelembabanUdara_avg'], 'number'],
            [['kondisi_actual', 'kondisi_predict'], 'safe'],
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
        $query = DataTesting::find();

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
            'idTesting' => $this->idTesting,
            'suhu_min' => $this->suhu_min,
            'kelembabanUdara_maximum' => $this->kelembabanUdara_maximum,
            'kelembabanUdara_minimum' => $this->kelembabanUdara_minimum,
            'kelembabanUdara_avg' => $this->kelembabanUdara_avg,
        ]);

        $query->andFilterWhere(['like', 'kondisi_actual', $this->kondisi_actual])
            ->andFilterWhere(['like', 'kondisi_predict', $this->kondisi_predict]);

        return $dataProvider;
    }
}

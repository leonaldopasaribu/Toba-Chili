<?php

namespace frontend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\DataTraining;

/**
 * DataTrainingSearch represents the model behind the search form of `frontend\models\DataTraining`.
 */
class DataTrainingSearch extends DataTraining
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idTraining', 'idTanaman', 'idZonaWaktu', 'kondisiDaun', 'deleted'], 'integer'],
            [['phMin', 'phMax', 'suhuMin', 'suhuMax', 'kelembabanUdaraMin', 'kelembabanUdaraMax', 'kelembabanTanahMin', 'kelembabanTanahMax'], 'number'],
            [['deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = DataTraining::find();

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
            'idTraining' => $this->idTraining,
            'idTanaman' => $this->idTanaman,
            'idZonaWaktu' => $this->idZonaWaktu,
            'phMin' => $this->phMin,
            'phMax' => $this->phMax,
            'suhuMin' => $this->suhuMin,
            'suhuMax' => $this->suhuMax,
            'kelembabanUdaraMin' => $this->kelembabanUdaraMin,
            'kelembabanUdaraMax' => $this->kelembabanUdaraMax,
            'kelembabanTanahMin' => $this->kelembabanTanahMin,
            'kelembabanTanahMax' => $this->kelembabanTanahMax,
            'kondisiDaun' => $this->kondisiDaun,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}

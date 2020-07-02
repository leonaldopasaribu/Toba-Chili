<?php

namespace frontend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\KondisiDaun;

/**
 * KondisiDaunSearch represents the model behind the search form of `frontend\models\KondisiDaun`.
 */
class KondisiDaunSearch extends KondisiDaun
{
    public $label;
    public $namaZona;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idKondisi', 'idTanaman', 'idZonaWaktu', 'deleted'], 'integer'],
            [['label', 'namaZona', 'tanggalPencatatan', 'kondisiDaun', 'gambar', 'deleted_at', 'deleted_by', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = KondisiDaun::find();
        $query->joinWith('tanaman');
        $query->joinWith('zonaWaktu');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
        ]);


        $dataProvider->sort->attributes['label'] = [
            'asc' => ['tanaman.labelTanaman' => SORT_ASC],
            'desc' => ['tanaman.labelTanaman' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['namaZona'] = [
            'asc' => ['zonaWaktu.namaZonaWaktu' => SORT_ASC],
            'desc' => ['zonaWaktu.namaZonaWaktu' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idKondisi' => $this->idKondisi,
            'idTanaman' => $this->idTanaman,
            'idZonaWaktu' => $this->idZonaWaktu,
            'waktuPencatatan' => $this->waktuPencatatan,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'kondisiDaun', $this->kondisiDaun])
            ->andFilterWhere(['like', 'tanaman.labelTanaman', $this->label])
            ->andFilterWhere(['like', 'zonaWaktu.namaZonaWaktu', $this->namaZona])
            ->andFilterWhere(['like', 'gambar', $this->gambar])
            ->andFilterWhere(['like', 'deleted_by', $this->deleted_by])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}

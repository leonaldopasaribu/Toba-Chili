<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "data_testing".
 *
 * @property int $idTesting
 * @property float|null $suhu_min
 * @property float|null $kelembabanUdara_maximum
 * @property float|null $kelembabanUdara_minimum
 * @property float|null $kelembabanUdara_avg
 * @property string|null $kondisi_actual
 * @property string|null $kondisi_predict
 */
class DataTesting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_testing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['suhu_min', 'kelembabanUdara_maximum', 'kelembabanUdara_minimum', 'kelembabanUdara_avg'], 'number'],
            [['kondisi_actual', 'kondisi_predict'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTesting' => 'Id Testing',
            'suhu_min' => 'Suhu Min',
            'kelembabanUdara_maximum' => 'Kelembaban Udara Maximum',
            'kelembabanUdara_minimum' => 'Kelembaban Udara Minimum',
            'kelembabanUdara_avg' => 'Kelembaban Udara Avg',
            'kondisi_actual' => 'Kondisi Actual',
            'kondisi_predict' => 'Kondisi Predict',
        ];
    }
}

<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "data_training_feature".
 *
 * @property int $idTraining
 * @property float|null $suhu_min
 * @property float|null $kelembabanUdara_maximum
 * @property float|null $kelembabanUdara_minimum
 * @property float|null $kelembabanUdara_avg
 * @property string|null $kondisi_actual
 */
class DataTrainingFeature extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_training_feature';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['suhu_min', 'kelembabanUdara_maximum', 'kelembabanUdara_minimum', 'kelembabanUdara_avg'], 'number'],
            [['kondisi_actual'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTraining' => 'Id Training',
            'suhu_min' => 'Suhu Min',
            'kelembabanUdara_maximum' => 'Kelembaban Udara Maximum',
            'kelembabanUdara_minimum' => 'Kelembaban Udara Minimum',
            'kelembabanUdara_avg' => 'Kelembaban Udara Avg',
            'kondisi_actual' => 'Kondisi Actual',
        ];
    }
}

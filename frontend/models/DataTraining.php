<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "data_training".
 *
 * @property int $idTraining
 * @property float|null $ph_maximum
 * @property float|null $ph_minimum
 * @property float|null $ph_avg
 * @property float|null $kelembabanTanah_maximum
 * @property float|null $kelembabanTanah_minimum
 * @property float|null $kelembabanTanah_avg
 * @property float|null $suhu_max
 * @property float|null $suhu_min
 * @property float|null $suhu_avg
 * @property float|null $kelembabanUdara_maximum
 * @property float|null $kelembabanUdara_minimum
 * @property float|null $kelembabanUdara_avg
 * @property string|null $kondisi_actual
 */
class DataTraining extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_training';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ph_maximum', 'ph_minimum', 'ph_avg', 'kelembabanTanah_maximum', 'kelembabanTanah_minimum', 'kelembabanTanah_avg', 'suhu_max', 'suhu_min', 'suhu_avg', 'kelembabanUdara_maximum', 'kelembabanUdara_minimum', 'kelembabanUdara_avg'], 'number'],
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
            'ph_maximum' => 'Ph Maximum',
            'ph_minimum' => 'Ph Minimum',
            'ph_avg' => 'Ph Avg',
            'kelembabanTanah_maximum' => 'Kelembaban Tanah Maximum',
            'kelembabanTanah_minimum' => 'Kelembaban Tanah Minimum',
            'kelembabanTanah_avg' => 'Kelembaban Tanah Avg',
            'suhu_max' => 'Suhu Max',
            'suhu_min' => 'Suhu Min',
            'suhu_avg' => 'Suhu Avg',
            'kelembabanUdara_maximum' => 'Kelembaban Udara Maximum',
            'kelembabanUdara_minimum' => 'Kelembaban Udara Minimum',
            'kelembabanUdara_avg' => 'Kelembaban Udara Avg',
            'kondisi_actual' => 'Kondisi Actual',
        ];
    }
}

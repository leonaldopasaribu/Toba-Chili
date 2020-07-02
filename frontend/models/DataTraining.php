<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "data_training".
 *
 * @property int $idTraining
 * @property int|null $idTanaman
 * @property int|null $idZonaWaktu
 * @property string|null $waktuPencatatan
 * @property float|null $phMin
 * @property float|null $phMax
 * @property float|null $suhuMin
 * @property float|null $suhuMax
 * @property float|null $kelembabanUdaraMin
 * @property float|null $kelembabanUdaraMax
 * @property float|null $kelembabanTanahMin
 * @property float|null $kelembabanTanahMax
 * @property int|null $kondisiDaun
 * @property int|null $deleted
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 *
 * @property Tanaman $idTanaman0
 * @property Zonawaktu $idZonaWaktu0
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
            [['idTanaman', 'idZonaWaktu', 'kondisiDaun', 'deleted'], 'integer'],
            [['phMin', 'phMax', 'suhuMin', 'suhuMax', 'suhuRata', 'kelembabanUdaraMin', 'kelembabanUdaraMax', 'kelembabanUdaraRata', 'kelembabanTanahMin', 'kelembabanTanahMax', 'kelembabanTanahRata'], 'number'],
            [['waktuPencatatan', 'deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['idTanaman'], 'exist', 'skipOnError' => true, 'targetClass' => Tanaman::className(), 'targetAttribute' => ['idTanaman' => 'idTanaman']],
            [['idZonaWaktu'], 'exist', 'skipOnError' => true, 'targetClass' => Zonawaktu::className(), 'targetAttribute' => ['idZonaWaktu' => 'idZonaWaktu']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTraining' => 'Id Training',
            'idTanaman' => 'Id Tanaman',
            'idZonaWaktu' => 'Id Zona Waktu',
            'waktuPencatatan' => 'Waktu Pencatatan',
            'phMin' => 'Ph Min',
            'phMax' => 'Ph Max',
            'suhuMin' => 'Suhu Min',
            'suhuMax' => 'Suhu Max',
            'suhuRata' => 'Suhu Rata-rata',
            'kelembabanUdaraMin' => 'Kelembaban Udara Min',
            'kelembabanUdaraMax' => 'Kelembaban Udara Max',
            'kelembabanUdaraRata' => 'Kelembaban Udara Rata-rata',
            'kelembabanTanahMin' => 'Kelembaban Tanah Min',
            'kelembabanTanahMax' => 'Kelembaban Tanah Max',
            'kelembabanTanahRata' => 'Kelembaban Tanah Rata-rata',
            'kondisiDaun' => 'Kondisi Daun',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[IdTanaman0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTanaman()
    {
        return $this->hasOne(Tanaman::className(), ['idTanaman' => 'idTanaman']);
    }

    /**
     * Gets query for [[IdZonaWaktu0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getZonaWaktu()
    {
        return $this->hasOne(Zonawaktu::className(), ['idZonaWaktu' => 'idZonaWaktu']);
    }
}
